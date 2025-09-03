<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        try {
            // Validate required parameters
            $validator = Validator::make($request->all(), [
                'event_id' => 'required|integer|exists:events,id',
                'tickets' => 'required|array|min:1',
                'tickets.*.id' => 'required|integer|exists:tickets,id',
                'tickets.*.quantity' => 'required|integer|min:1|max:10',
                'tickets.*.price' => 'required|numeric|min:0',
                'tickets.*.name' => 'required|string|max:255'
            ]);

            if ($validator->fails()) {
                return redirect()->route('Browse')
                    ->with('error', 'Invalid ticket selection. Please try again.');
            }

            $eventId = $request->input('event_id');
            $ticketsData = $request->input('tickets');

            // Load event with relationships
            $event = Event::with(['venue', 'tickets.ticketType'])->find($eventId);
            
            if (!$event) {
                return redirect()->route('Browse')
                    ->with('error', 'Event not found.');
            }

            // Validate tickets belong to event and prices are correct
            $validatedTickets = [];
            $totalAmount = 0;
            $eventTicketIds = $event->tickets->pluck('id')->toArray();

            foreach ($ticketsData as $ticketData) {
                // Check if ticket belongs to this event
                if (!in_array($ticketData['id'], $eventTicketIds)) {
                    return redirect()->route('Browse')
                        ->with('error', 'Invalid ticket selection for this event.');
                }

                // Get current ticket from database
                $dbTicket = Ticket::find($ticketData['id']);
                
                if (!$dbTicket) {
                    return redirect()->route('Browse')
                        ->with('error', 'One or more tickets are no longer available.');
                }

                // Validate price hasn't changed
                if ((float)$dbTicket->price !== (float)$ticketData['price']) {
                    return redirect()->route('Browse')
                        ->with('error', 'Ticket prices have changed. Please reselect your tickets.');
                }

                $itemTotal = $dbTicket->price * $ticketData['quantity'];
                $totalAmount += $itemTotal;

                $validatedTickets[] = [
                    'id' => $dbTicket->id,
                    'name' => $dbTicket->ticketType->name ?? 'General Admission',
                    'price' => $dbTicket->price,
                    'quantity' => (int)$ticketData['quantity'],
                    'total' => $itemTotal
                ];
            }

            // Store validated data in session for security
            session([
                'checkout_event_id' => $eventId,
                'checkout_tickets' => $validatedTickets,
                'checkout_total' => $totalAmount,
                'checkout_timestamp' => now()->timestamp
            ]);

            return view('checkout.checkout', compact('event', 'validatedTickets', 'totalAmount'));

        } catch (\Exception $e) {
            \Log::error('Checkout error: ' . $e->getMessage());
            return redirect()->route('Browse')
                ->with('error', 'An error occurred during checkout. Please try again.');
        }
    }

    public function processCheckout(Request $request)
    {
        try {
            // Validate session data exists and is recent (within 30 minutes)
            $checkoutTimestamp = session('checkout_timestamp');
            if (!$checkoutTimestamp || (now()->timestamp - $checkoutTimestamp) > 1800) {
                return redirect()->route('Browse')
                    ->with('error', 'Checkout session expired. Please start over.');
            }

            $eventId = session('checkout_event_id');
            $validatedTickets = session('checkout_tickets');
            $totalAmount = session('checkout_total');

            if (!$eventId || !$validatedTickets || !$totalAmount) {
                return redirect()->route('Browse')
                    ->with('error', 'Invalid checkout session. Please start over.');
            }

            // Validate customer data
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'payment_method' => 'required|in:mpesa,cash,card'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Store customer data in session
            session([
                'checkout_customer' => $request->only(['first_name', 'last_name', 'email', 'phone']),
                'checkout_payment_method' => $request->input('payment_method')
            ]);

            // Redirect to payment with clean URL (no parameters)
            return redirect()->route('payment');

        } catch (\Exception $e) {
            \Log::error('Process checkout error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred processing your information. Please try again.');
        }
    }
}
