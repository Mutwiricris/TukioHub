<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Ticket;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()
            ->with(['orderItems.ticket.event', 'payments'])
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Ensure user can only view their own orders
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['orderItems.ticket.event.venue', 'payments']);

        return view('orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tickets' => 'required|array',
            'tickets.*.ticket_id' => 'required|exists:tickets,id',
            'tickets.*.quantity' => 'required|integer|min:1',
            'promo_code' => 'nullable|string|exists:promo_codes,code'
        ]);

        DB::beginTransaction();

        try {
            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'payment_status' => 'pending',
                'currency' => 'KES',
                'total_amount' => 0
            ]);

            $totalAmount = 0;
            $promoCode = null;

            // Apply promo code if provided
            if ($request->filled('promo_code')) {
                $promoCode = PromoCode::where('code', $request->promo_code)
                    ->where('is_active', true)
                    ->where('valid_from', '<=', now())
                    ->where('valid_until', '>=', now())
                    ->first();
            }

            // Create order items
            foreach ($validated['tickets'] as $ticketData) {
                $ticket = Ticket::findOrFail($ticketData['ticket_id']);

                // Check availability
                if ($ticket->remaining_quantity < $ticketData['quantity']) {
                    throw new \Exception("Not enough tickets available for {$ticket->event->name}");
                }

                $itemPrice = $ticket->price * $ticketData['quantity'];

                // Apply promo code discount
                if ($promoCode) {
                    if ($promoCode->discount_type === 'percentage') {
                        $discount = ($itemPrice * $promoCode->discount_value) / 100;
                    } else {
                        $discount = min($promoCode->discount_value, $itemPrice);
                    }
                    $itemPrice -= $discount;
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'ticket_id' => $ticket->id,
                    'quantity' => $ticketData['quantity'],
                    'unit_price' => $ticket->price,
                    'total_price' => $itemPrice
                ]);

                $totalAmount += $itemPrice;
            }

            // Update order total and promo code
            $order->update([
                'total_amount' => $totalAmount,
                'promo_code_id' => $promoCode?->id
            ]);

            DB::commit();

            return redirect()->route('checkout', $order->id)
                ->with('success', 'Order created successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function checkout(Order $order)
    {
        // Ensure user can only checkout their own orders
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'pending') {
            return redirect()->route('orders.show', $order)
                ->with('error', 'This order has already been processed.');
        }

        $order->load(['orderItems.ticket.event', 'promoCode']);

        return view('checkout.checkout', compact('order'));
    }

    public function confirm(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if (!$order->isPaid()) {
            return redirect()->route('checkout', $order)
                ->with('error', 'Payment is required to confirm this order.');
        }

        $order->update(['status' => 'confirmed']);

        // Generate bookings for each order item
        foreach ($order->orderItems as $item) {
            for ($i = 0; $i < $item->quantity; $i++) {
                \App\Models\Booking::create([
                    'user_id' => $order->user_id,
                    'ticket_id' => $item->ticket_id,
                    'order_id' => $order->id,
                    'booking_reference' => 'BK-' . strtoupper(uniqid()),
                    'status' => 'confirmed'
                ]);
            }
        }

        return redirect()->route('confirmation.confirmation', $order)
            ->with('success', 'Order confirmed successfully!');
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status === 'confirmed') {
            return back()->with('error', 'Cannot cancel a confirmed order.');
        }

        $order->update(['status' => 'cancelled']);

        return back()->with('success', 'Order cancelled successfully.');
    }
}
