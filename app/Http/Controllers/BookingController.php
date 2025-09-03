<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Auth::user()->bookings()
            ->with(['ticket.event.venue', 'order'])
            ->latest()
            ->paginate(10);

        return view('Tickets.Tickets', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        // Ensure user can only view their own bookings
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->load(['ticket.event.venue', 'order', 'checkins']);

        return view('bookings.show', compact('booking'));
    }

    public function downloadTicket(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status !== 'confirmed') {
            return back()->with('error', 'Ticket is not confirmed yet.');
        }

        // Generate QR code for the booking
        $qrCode = QrCode::size(200)->generate($booking->booking_reference);

        return view('bookings.ticket-pdf', compact('booking', 'qrCode'));
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if cancellation is allowed (e.g., not within 24 hours of event)
        $event = $booking->ticket->event;
        $hoursUntilEvent = now()->diffInHours($event->start_date);

        if ($hoursUntilEvent < 24) {
            return back()->with('error', 'Cannot cancel booking within 24 hours of the event.');
        }

        if ($booking->status === 'cancelled') {
            return back()->with('error', 'Booking is already cancelled.');
        }

        $booking->update([
            'status' => 'cancelled',
            'cancelled_at' => now()
        ]);

        // Process refund if applicable
        $this->processRefund($booking);

        return back()->with('success', 'Booking cancelled successfully. Refund will be processed within 3-5 business days.');
    }

    public function transfer(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'recipient_email' => 'required|email|exists:users,email',
            'transfer_reason' => 'nullable|string|max:255'
        ]);

        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status !== 'confirmed') {
            return back()->with('error', 'Only confirmed bookings can be transferred.');
        }

        $recipient = \App\Models\User::where('email', $validated['recipient_email'])->first();

        if ($recipient->id === Auth::id()) {
            return back()->with('error', 'Cannot transfer booking to yourself.');
        }

        $booking->update([
            'user_id' => $recipient->id,
            'transferred_from' => Auth::id(),
            'transfer_reason' => $validated['transfer_reason'],
            'transferred_at' => now()
        ]);

        // Send notification to recipient
        // $recipient->notify(new BookingTransferredNotification($booking));

        return back()->with('success', 'Booking transferred successfully to ' . $recipient->name);
    }

    public function checkin(Booking $booking)
    {
        if ($booking->status !== 'confirmed') {
            return response()->json(['error' => 'Booking is not confirmed'], 400);
        }

        $event = $booking->ticket->event;

        // Check if event is happening today
        if (!$event->start_date->isToday()) {
            return response()->json(['error' => 'Check-in is only available on the event day'], 400);
        }

        // Check if already checked in
        if ($booking->checkins()->exists()) {
            return response()->json(['error' => 'Already checked in'], 400);
        }

        // Create check-in record
        \App\Models\Checkin::create([
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
            'event_id' => $event->id,
            'checked_in_at' => now(),
            'scanned_by_user_id' => Auth::id() // If scanned by staff
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Check-in successful',
            'booking' => $booking->load('ticket.event')
        ]);
    }

    public function validateQr(Request $request)
    {
        $validated = $request->validate([
            'booking_reference' => 'required|string'
        ]);

        $booking = Booking::where('booking_reference', $validated['booking_reference'])
            ->with(['ticket.event', 'user'])
            ->first();

        if (!$booking) {
            return response()->json(['error' => 'Invalid booking reference'], 404);
        }

        if ($booking->status !== 'confirmed') {
            return response()->json(['error' => 'Booking is not confirmed'], 400);
        }

        return response()->json([
            'success' => true,
            'booking' => $booking,
            'can_checkin' => $booking->ticket->event->start_date->isToday() && !$booking->checkins()->exists()
        ]);
    }

    private function processRefund(Booking $booking)
    {
        // Implement refund logic based on your payment gateway
        // This is a placeholder for the actual refund implementation

        $order = $booking->order;
        $refundAmount = $booking->ticket->price;

        // Create refund record
        \App\Models\Payment::create([
            'order_id' => $order->id,
            'payment_method' => 'refund',
            'amount' => -$refundAmount, // Negative amount for refund
            'currency' => $order->currency,
            'payment_reference' => 'REF-' . strtoupper(uniqid()),
            'payment_status' => 'pending',
            'payment_details' => json_encode([
                'type' => 'cancellation_refund',
                'original_booking_id' => $booking->id
            ])
        ]);
    }
}
