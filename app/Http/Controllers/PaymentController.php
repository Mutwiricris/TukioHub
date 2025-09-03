<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\UserTicket;
use App\Models\PaymentTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function show(Request $request)
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
            $customerData = session('checkout_customer', []);
            $paymentMethod = session('checkout_payment_method', 'mpesa');

            if (!$eventId || !$validatedTickets || !$totalAmount) {
                return redirect()->route('Browse')
                    ->with('error', 'Invalid checkout session. Please start over.');
            }

            $event = Event::with(['venue', 'tickets.ticketType'])->find($eventId);
            
            if (!$event) {
                return redirect()->route('Browse')
                    ->with('error', 'Event not found.');
            }

            return view('payment.payment', compact(
                'event', 
                'validatedTickets', 
                'customerData', 
                'paymentMethod'
            ))->with('orderTotal', $totalAmount);

        } catch (\Exception $e) {
            \Log::error('Payment show error: ' . $e->getMessage());
            return redirect()->route('Browse')
                ->with('error', 'An error occurred loading payment page. Please try again.');
        }
    }

    public function process(Request $request)
    {
        try {
            \Log::info('Payment process started', ['request_data' => $request->all()]);
            
            // Validate session data
            $checkoutTimestamp = session('checkout_timestamp');
            if (!$checkoutTimestamp || (now()->timestamp - $checkoutTimestamp) > 1800) {
                \Log::error('Payment session expired', ['timestamp' => $checkoutTimestamp]);
                return redirect()->route('Browse')
                    ->with('error', 'Payment session expired. Please start over.');
            }

            $eventId = session('checkout_event_id');
            $validatedTickets = session('checkout_tickets');
            $totalAmount = session('checkout_total');
            $customerData = session('checkout_customer', []);

            \Log::info('Session data retrieved', [
                'event_id' => $eventId,
                'tickets_count' => count($validatedTickets ?? []),
                'total_amount' => $totalAmount
            ]);

            if (!$eventId || !$validatedTickets || !$totalAmount) {
                \Log::error('Invalid payment session data', [
                    'event_id' => $eventId,
                    'tickets' => $validatedTickets,
                    'total' => $totalAmount
                ]);
                return redirect()->route('Browse')
                    ->with('error', 'Invalid payment session. Please start over.');
            }

            // Validate payment data
            $validator = Validator::make($request->all(), [
                'payment_method' => 'required|in:mpesa,cash,card,bank_transfer',
                'phone_number' => 'required_if:payment_method,mpesa|string|max:20'
            ]);

            if ($validator->fails()) {
                \Log::error('Payment validation failed: ' . json_encode($validator->errors()->toArray()));
                return back()->withErrors($validator)->withInput();
            }

            $event = Event::find($eventId);
            if (!$event) {
                return redirect()->route('Browse')
                    ->with('error', 'Event not found.');
            }

            // Generate payment references
            $paymentMethod = $request->input('payment_method');
            $paymentReference = $this->generatePaymentReference($paymentMethod);
            $reservationReference = 'RSV-' . strtoupper(uniqid());

            // Simulate payment processing
            $status = 'success'; // In real implementation, this would come from payment gateway

            // Create payment transaction record
            $paymentTransaction = PaymentTransaction::create([
                'user_id' => auth()->id(),
                'event_id' => $eventId,
                'reference_number' => $paymentReference,
                'payment_method' => $paymentMethod,
                'status' => $this->getPaymentStatusForMethod($paymentMethod),
                'amount' => $totalAmount,
                'payment_details' => [
                    'customer' => $customerData,
                    'tickets' => $validatedTickets
                ],
                'confirmed_at' => $this->shouldAutoConfirm($paymentMethod) ? now() : null
            ]);

            // Store tickets for authenticated users
            if (auth()->check()) {
                foreach ($validatedTickets as $ticketData) {
                    UserTicket::create([
                        'user_id' => auth()->id(),
                        'event_id' => $eventId,
                        'ticket_id' => $ticketData['id'],
                        'reference_number' => $paymentReference . '-' . $ticketData['id'],
                        'price' => $ticketData['price'],
                        'status' => 'not_scanned',
                        'purchased_at' => now(),
                        'payment_reference' => $paymentReference
                    ]);
                }
            }

            // Store confirmation data in session for confirmation page
            session([
                'confirmation_timestamp' => now()->timestamp,
                'confirmation_event_id' => $eventId,
                'confirmation_payment_method' => $paymentMethod,
                'confirmation_payment_reference' => $paymentReference,
                'confirmation_reservation_reference' => $reservationReference,
                'confirmation_status' => $status,
                'confirmation_amount' => $totalAmount,
                'confirmation_tickets' => $validatedTickets,
                'confirmation_customer' => $customerData
            ]);

            return redirect()->route('confirmation');

        } catch (\Exception $e) {
            \Log::error('Payment process error: ' . $e->getMessage());
            return back()->with('error', 'Payment processing failed. Please try again.');
        }
    }

    private function generatePaymentReference($paymentMethod)
    {
        $prefix = match($paymentMethod) {
            'mpesa' => 'MP',
            'card' => 'CD',
            'cash' => 'CSH',
            'bank_transfer' => 'BT',
            default => 'PAY'
        };
        
        return $prefix . '-' . strtoupper(uniqid());
    }

    private function getPaymentStatusForMethod(string $method): string
    {
        return match($method) {
            'cash' => 'pending',
            'bank_transfer' => 'pending', 
            'mpesa' => 'confirmed', // Auto-confirm for demo, would be updated by callback
            'card' => 'confirmed', // Auto-confirm for demo, would be updated by callback
            default => 'pending'
        };
    }

    private function shouldAutoConfirm(string $method): bool
    {
        return in_array($method, ['mpesa', 'card']);
    }
}
