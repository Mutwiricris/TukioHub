<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\UserTicket;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    public function show(Request $request)
    {
        try {
            // Validate session data exists and is recent (within 1 hour)
            $confirmationTimestamp = session('confirmation_timestamp');
            if (!$confirmationTimestamp || (now()->timestamp - $confirmationTimestamp) > 3600) {
                return redirect()->route('browse')
                    ->with('error', 'Confirmation session expired. Please contact support if you completed a payment.');
            }

            // Get confirmation data from session
            $eventId = session('confirmation_event_id');
            $paymentMethod = session('confirmation_payment_method');
            $paymentReference = session('confirmation_payment_reference');
            $reservationReference = session('confirmation_reservation_reference');
            $status = session('confirmation_status');
            $amount = session('confirmation_amount');
            $validatedTickets = session('confirmation_tickets', []);
            $customerData = session('confirmation_customer', []);

            // Validate required data
            if (!$eventId || !$paymentReference || !$status) {
                return redirect()->route('browse')
                    ->with('error', 'Invalid confirmation data. Please contact support if you completed a payment.');
            }

            // Load event
            $event = Event::with(['venue', 'tickets.ticketType'])->find($eventId);
            
            if (!$event) {
                return redirect()->route('browse')
                    ->with('error', 'Event not found.');
            }

            // Get purchased tickets for authenticated users
            $purchasedTickets = [];
            if (auth()->check()) {
                $purchasedTickets = UserTicket::with(['ticket.ticketType'])
                    ->where('user_id', auth()->id())
                    ->where('event_id', $eventId)
                    ->where('reference_number', 'LIKE', $paymentReference . '%')
                    ->get();
            }

            return view('confirmation.confirmation', compact(
                'event',
                'paymentMethod',
                'paymentReference',
                'reservationReference',
                'status',
                'amount',
                'validatedTickets',
                'customerData',
                'purchasedTickets'
            ));

        } catch (\Exception $e) {
            \Log::error('Confirmation error: ' . $e->getMessage());
            return redirect()->route('Browse')
                ->with('error', 'An error occurred loading confirmation page. Please contact support if you completed a payment.');
        }
    }

    public function downloadTicket(Request $request, $ticketId)
    {
        try {
            if (!auth()->check()) {
                return redirect()->route('login')
                    ->with('error', 'Please log in to download your tickets.');
            }

            $userTicket = UserTicket::with(['event.venue', 'ticket.ticketType'])
                ->where('id', $ticketId)
                ->where('user_id', auth()->id())
                ->first();

            if (!$userTicket) {
                return redirect()->back()
                    ->with('error', 'Ticket not found or access denied.');
            }

            // Generate unique QR Code data - same format as confirmation page
            $ticketId = $userTicket->reference_number . '-' . strtotime($userTicket->created_at ?? now());
            $baseUrl = request()->getSchemeAndHttpHost();
            $qrText = $baseUrl . '/ticket/verify/' . $ticketId;

            // Generate QR code using a simple approach
            try {
                // Create a simple QR code URL using a free service for PDF generation
                $qrData = 'TICKET:' . $userTicket->reference_number . ':' . $userTicket->user_id . ':' . $userTicket->event_id;
                $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($qrData);
                
                // Get QR code image data
                $qrImageData = @file_get_contents($qrUrl);
                if ($qrImageData) {
                    $qrCodeBase64 = base64_encode($qrImageData);
                } else {
                    throw new \Exception('Failed to generate QR code from service');
                }
            } catch (\Exception $e) {
                // Fallback: create a simple placeholder image
                \Log::error('QR Code generation failed: ' . $e->getMessage());
                
                // Create a simple white square with text as fallback
                $img = imagecreate(300, 300);
                $white = imagecolorallocate($img, 255, 255, 255);
                $black = imagecolorallocate($img, 0, 0, 0);
                imagefill($img, 0, 0, $white);
                imagerectangle($img, 10, 10, 290, 290, $black);
                
                $text = 'QR: ' . substr($userTicket->reference_number, 0, 10);
                imagestring($img, 3, 120, 140, $text, $black);
                
                ob_start();
                imagepng($img);
                $qrCodeBase64 = base64_encode(ob_get_contents());
                ob_end_clean();
                imagedestroy($img);
            }

            // Get customer data from session or user
            $customerData = session('confirmation_customer', [
                'first_name' => auth()->user()->name ?? 'N/A',
                'last_name' => '',
                'email' => auth()->user()->email ?? 'N/A',
                'phone' => ''
            ]);

            // Prepare ticket data
            $ticketData = [
                'event' => $userTicket->event,
                'ticketType' => $userTicket->ticket->ticketType->name ?? 'General Admission',
                'reference' => $userTicket->reference_number,
                'qrCode' => $qrCodeBase64,
                'customerData' => $customerData,
                'paymentMethod' => session('confirmation_payment_method', 'card'),
                'amount' => $userTicket->price ?? $userTicket->ticket->price,
                'status' => $userTicket->status ?? 'confirmed'
            ];

            // Generate PDF
            $html = view('tickets.ticket-template', $ticketData)->render();
            
            $dompdf = new \Dompdf\Dompdf([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'Arial',
                'isPhpEnabled' => true
            ]);
            
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $filename = 'TukioHub-Ticket-' . $userTicket->reference_number . '.pdf';

            return response($dompdf->output(), 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->header('Content-Transfer-Encoding', 'binary')
                ->header('Accept-Ranges', 'bytes')
                ->header('Cache-Control', 'private, no-transform, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');

        } catch (\Exception $e) {
            \Log::error('Ticket download error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to download ticket. Please try again.');
        }
    }
}
