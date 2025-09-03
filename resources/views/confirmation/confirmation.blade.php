@extends('layouts.app')

@section('head')
<script src="https://unpkg.com/lucide@latest"></script>
{{-- Simple library for generating barcodes --}}
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
{{-- Library for generating QR Codes --}}
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.1/build/qrcode.min.js"></script>
@endsection

@section('content')
<div class="bg-gray-900 text-white min-h-screen">
    {{-- Header --}}
    <header class="border-b border-white/10 bg-gray-900/80 backdrop-blur-lg sticky top-0 z-20">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4">
            <a href="/" class="flex items-center gap-2">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary-500 text-white">
                    <i data-lucide="ticket" class="h-5 w-5"></i>
                </div>
                <span class="text-lg font-semibold">Tukio <span class="text-primary-400">Hub</span></span>
            </a>
            <a href="/account/tickets" class="text-xs text-gray-300 hover:text-white flex items-center gap-2">
                My Tickets <i data-lucide="arrow-right" class="h-4 w-4"></i>
            </a>
        </div>
    </header>

    {{-- Steps Indicator --}}
    <div class="bg-gray-800/50 border-b border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-3">
            <ol class="flex items-center justify-center gap-3 text-xs sm:gap-6">
                <li class="flex items-center gap-2 text-gray-400">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500 text-xs font-bold text-white"><i data-lucide="check" class="h-4 w-4"></i></span>
                    <span class="font-medium">Details</span>
                </li>
                <li class="flex items-center gap-2 text-gray-400">
                     <span class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500 text-xs font-bold text-white"><i data-lucide="check" class="h-4 w-4"></i></span>
                    <span class="font-medium">Payment</span>
                </li>
                <li class="flex items-center gap-2">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-primary-500 text-xs font-bold text-white">3</span>
                    <span class="font-medium text-white">Confirmation</span>
                </li>
            </ol>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="mx-auto max-w-3xl px-4 py-8 sm:py-12">
        <div class="text-center">
            @if($paymentMethod === 'cash' && $status === 'reserved')
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-amber-500/10">
                <i data-lucide="clock" class="h-10 w-10 text-amber-400"></i>
            </div>
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">Tickets Reserved!</h1>
            <p class="mt-2 text-gray-300">Your tickets are reserved for 24 hours. Complete payment at our office.</p>
            <p class="mt-4 text-sm text-gray-400">Reservation Reference: <span class="font-medium text-gray-200">{{ $reservationReference ?? 'RES-UNKNOWN' }}</span></p>
            @else
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-emerald-500/10">
                <i data-lucide="check-circle-2" class="h-10 w-10 text-emerald-400"></i>
            </div>
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">Payment Successful!</h1>
            <p class="mt-2 text-gray-300">Your tickets are confirmed. See you at the festival!</p>
            <p class="mt-4 text-sm text-gray-400">Payment Reference: <span class="font-medium text-gray-200">{{ $paymentReference ?? 'PAY-UNKNOWN' }}</span></p>
            @endif
        </div>

        {{-- Digital Ticket --}}
        <div class="mt-8 sm:mt-12">
            <div class="rounded-2xl border-2 border-dashed border-gray-600/50 bg-gray-800/30 p-1 shadow-2xl backdrop-blur-lg relative overflow-hidden">
                 <!-- Ticket perforations -->
                 <div class="absolute -top-4 left-1/2 -ml-4 h-8 w-8 rounded-full bg-gray-900"></div>
                 <div class="absolute -bottom-4 left-1/2 -ml-4 h-8 w-8 rounded-full bg-gray-900"></div>
                 
                 <!-- Side perforations -->
                 <div class="absolute -left-2 top-1/4 h-4 w-4 rounded-full bg-gray-900"></div>
                 <div class="absolute -right-2 top-1/4 h-4 w-4 rounded-full bg-gray-900"></div>
                 <div class="absolute -left-2 top-3/4 h-4 w-4 rounded-full bg-gray-900"></div>
                 <div class="absolute -right-2 top-3/4 h-4 w-4 rounded-full bg-gray-900"></div>
                 
                 <div class="rounded-xl bg-gradient-to-br from-gray-800/80 to-gray-900/80 p-6 border border-gray-700/30 ticket-container">
                    <div class="gap-6 sm:flex">
                        <div class="flex-shrink-0 text-center sm:border-r sm:border-dashed sm:border-gray-600/50 sm:pr-6">
                            <p class="text-xs text-primary-400 font-medium mb-2">Scan at Entry</p>
                            <div class="flex justify-center">
                                <canvas id="qr-code" class="mt-2 rounded-lg border-2 border-gray-600/30 mx-auto"></canvas>
                            </div>
                        </div>
                        <div class="mt-6 flex-grow sm:mt-0">
                            <div class="mb-4">
                                <h2 class="text-lg font-bold text-white mb-1">Event Details</h2>
                            </div>
                            
                            <div class="space-y-3 text-sm">
                                <div class="flex items-center gap-3 text-gray-300">
                                    <i data-lucide="calendar" class="h-4 w-4 text-gray-400 flex-shrink-0"></i> 
                                    <div>
                                        <span class="text-gray-400">Event Date</span>
                                        <p class="text-white font-medium">
                                            @if($event && $event->date)
                                                {{ \Carbon\Carbon::parse($event->date)->format('l, F j, Y') }}
                                            @else
                                                TBA
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-3 text-gray-300">
                                    <i data-lucide="clock" class="h-4 w-4 text-gray-400 flex-shrink-0"></i> 
                                    <div>
                                        <span class="text-gray-400">Event Time</span>
                                        <p class="text-white font-medium">
                                            @if($event && $event->date)
                                                {{ \Carbon\Carbon::parse($event->date)->format('g:i A T') }}
                                            @else
                                                TBA
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-3 text-gray-300">
                                    <i data-lucide="map-pin" class="h-4 w-4 text-gray-400 flex-shrink-0"></i> 
                                    <div>
                                        <span class="text-gray-400">Venue</span>
                                        <p class="text-white font-medium">
                                            @if($event && $event->venue)
                                                {{ $event->venue->name }}
                                            @else
                                                TBA
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4 border-t border-dashed border-gray-600/50 pt-4">
                                <div class="bg-gray-700/20 rounded-lg p-3 mb-3">
                                    <p class="text-xs text-gray-400 mb-2 font-medium">
                                        @if($paymentMethod === 'cash' && $status === 'reserved')
                                            Tickets Reserved:
                                        @else
                                            Tickets Purchased:
                                        @endif
                                    </p>
                                    <div class="space-y-1 text-sm font-medium text-white">
                                        @if($event && $validatedTickets && count($validatedTickets) > 0)
                                            @foreach($validatedTickets as $selectedTicket)
                                                @php
                                                    $ticket = $event->tickets->find($selectedTicket['id']);
                                                @endphp
                                                @if($ticket)
                                                    <div class="flex justify-between items-center">
                                                        <span>{{ $selectedTicket['quantity'] }} × {{ $ticket->ticketType->name ?? 'General Admission' }}</span>
                                                        <span class="text-primary-400">KES {{ number_format($ticket->price * $selectedTicket['quantity'], 0) }}</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="flex justify-between items-center">
                                                <span>1 × Sample Ticket</span>
                                                <span class="text-primary-400">KES 3,500</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if($amount > 0)
                                <div class="bg-primary-500/10 border border-primary-500/20 rounded-lg p-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-300 font-medium">Total Amount:</span>
                                        <span class="text-lg font-bold text-primary-400">KES {{ number_format($amount, 0) }}</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 border-t border-dashed border-gray-600/50 pt-4 text-center bg-gray-700/10 rounded-lg p-4">
                        <p class="text-xs text-gray-400 mb-3 font-medium">Ticket Barcode</p>
                        <div class="bg-white/5 rounded-lg p-3 inline-block">
                            <svg id="barcode" class="mx-auto"></svg>
                        </div>
                        <p id="barcode-number" class="text-xs text-gray-400 mt-2 font-mono"></p>
                    </div>
                 </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-3">
            <button id="download-pdf" class="flex flex-col items-center justify-center gap-2 rounded-xl bg-white/5 p-4 text-sm font-medium text-white transition hover:bg-white/10 active:bg-white/20">
                <i data-lucide="download" class="h-6 w-6"></i> Download PDF
            </button>
            <button id="share-ticket" class="flex flex-col items-center justify-center gap-2 rounded-xl bg-white/5 p-4 text-sm font-medium text-white transition hover:bg-white/10 active:bg-white/20">
                <i data-lucide="share-2" class="h-6 w-6"></i> Share Ticket
            </button>
            <button id="add-to-calendar" class="flex flex-col items-center justify-center gap-2 rounded-xl bg-white/5 p-4 text-sm font-medium text-white transition hover:bg-white/10 active:bg-white/20">
                <i data-lucide="calendar-plus" class="h-6 w-6"></i> Add to Calendar
            </button>
        </div>

        {{-- Next Steps --}}
        <div class="mt-12 text-center">
            @if($paymentMethod === 'cash' && $status === 'reserved')
            <div class="bg-amber-500/10 border border-amber-500/20 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-amber-400 mb-4">Complete Your Payment</h3>
                <div class="space-y-3 text-sm text-gray-300">
                    <p><strong>Visit any of these locations within 24 hours:</strong></p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div class="bg-gray-700/30 rounded-lg p-4">
                            <p class="font-medium text-white">TukioHub Main Office</p>
                            <p class="text-xs text-gray-400">Westlands, Nairobi</p>
                            <p class="text-xs text-gray-400">Mon-Fri: 9AM-6PM</p>
                        </div>
                        <div class="bg-gray-700/30 rounded-lg p-4">
                            <p class="font-medium text-white">Sarit Centre Outlet</p>
                            <p class="text-xs text-gray-400">Sarit Centre, Westlands</p>
                            <p class="text-xs text-gray-400">Daily: 10AM-8PM</p>
                        </div>
                    </div>
                    <p class="mt-4"><strong>Bring:</strong> Your reservation reference, valid ID, and exact cash amount (KES {{ number_format($amount, 0) }})</p>
                </div>
            </div>
            @else
            <h3 class="text-lg font-semibold text-white">What's Next?</h3>
            <p class="mt-2 text-sm text-gray-400">A receipt has been sent to your email. You can also view and manage your tickets in your account.</p>
            @endif
            
            <a href="/account/tickets" class="mt-4 inline-block rounded-lg bg-primary-500 px-6 py-3 text-sm font-bold text-white transition hover:bg-primary-600">
                Go to My Tickets
            </a>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();

    // Generate unique ticket ID and barcode number
    const referenceNumber = '{{ $reference ?? "TKT" }}';
    const timestamp = Date.now();
    const ticketId = `${referenceNumber}-${timestamp}`;
    const barcodeNumber = (parseInt(ticketId.split('').map(c => c.charCodeAt(0)).join('').slice(0, 12)) % 1000000000000).toString().padStart(12, '0');

    // Create URL for QR code that shows full ticket details when scanned
    const baseUrl = window.location.origin;
    const qrText = `${baseUrl}/ticket/verify/${ticketId}`;

    // Generate QR Code with maximum scannability settings
    const qrCodeElement = document.getElementById('qr-code');
    if (qrCodeElement && typeof QRCode !== 'undefined') {
        QRCode.toCanvas(qrCodeElement, qrText, {
            width: 160,
            margin: 6,
            errorCorrectionLevel: 'L',
            type: 'image/png',
            quality: 1.0,
            color: {
                dark: '#FFFFFF',
                light: '#00000000'
            }
        }, function (error) {
            if (error) console.error('QR Code generation error:', error);
        });
    }

    // Generate Barcode with unique number
    try {
        const barcodeElement = document.getElementById('barcode');
        if (barcodeElement && typeof JsBarcode !== 'undefined') {
            JsBarcode(barcodeElement, barcodeNumber, {
                format: "CODE128",
                lineColor: "#fff",
                width: 2,
                height: 60,
                displayValue: false,
                background: "transparent",
                fontOptions: "bold",
                font: "monospace",
                fontSize: 16,
                margin: 10
            });
            
            // Display barcode number separately
            const barcodeNumberElement = document.getElementById('barcode-number');
            if (barcodeNumberElement) {
                barcodeNumberElement.textContent = barcodeNumber;
            }
        }
    } catch (e) {
        console.error("Barcode generation failed", e);
    }

    // Download PDF functionality
    const downloadPdfBtn = document.getElementById('download-pdf');
    if(downloadPdfBtn) {
        downloadPdfBtn.addEventListener('click', (e) => {
            e.preventDefault();
            
            // Create a printable version of the ticket
            const ticketElement = document.querySelector('.ticket-container');
            const originalContent = document.body.innerHTML;
            const ticketContent = ticketElement.outerHTML;
            
            // Create print styles
            const printStyles = `
                <style>
                    @media print {
                        body { margin: 0; padding: 20px; background: white !important; }
                        .ticket-container { background: white !important; border: 2px solid #000 !important; }
                        .bg-gray-800, .bg-gray-900 { background: white !important; color: black !important; }
                        .text-white { color: black !important; }
                        .text-gray-300, .text-gray-400 { color: #666 !important; }
                        .border-gray-700 { border-color: #ccc !important; }
                        #qr-code, #barcode { filter: invert(1); }
                    }
                </style>
            `;
            
            // Open print dialog
            document.body.innerHTML = printStyles + ticketContent;
            window.print();
            document.body.innerHTML = originalContent;
            
            // Reinitialize codes after restoring content
            setTimeout(() => {
                generateQRCode();
                generateBarcode();
            }, 100);
        });
    }

    // Share Ticket functionality
    const shareTicketBtn = document.getElementById('share-ticket');
    if(shareTicketBtn) {
        shareTicketBtn.addEventListener('click', async (e) => {
            e.preventDefault();
            
            const shareData = {
                title: 'My Event Ticket',
                text: `I have a ticket for {{ $event->name ?? 'this event' }}!`,
                url: window.location.href
            };
            
            try {
                if (navigator.share) {
                    await navigator.share(shareData);
                } else {
                    // Fallback for browsers that don't support Web Share API
                    const shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(shareData.text)}&url=${encodeURIComponent(shareData.url)}`;
                    window.open(shareUrl, '_blank');
                }
            } catch (err) {
                console.log('Error sharing:', err);
                // Copy to clipboard as fallback
                navigator.clipboard.writeText(shareData.url).then(() => {
                    alert('Ticket link copied to clipboard!');
                });
            }
        });
    }

    // Add to Calendar functionality
    const addToCalendarBtn = document.getElementById('add-to-calendar');
    if(addToCalendarBtn) {
        addToCalendarBtn.addEventListener('click', (e) => {
            e.preventDefault();
            
            @if($event && $event->date)
            const eventDate = new Date('{{ $event->date }}');
            const endDate = new Date(eventDate.getTime() + (3 * 60 * 60 * 1000)); // 3 hours later
            
            const calendarData = {
                title: '{{ $event->name ?? "Event" }}',
                start: eventDate.toISOString().replace(/[-:]/g, '').split('.')[0] + 'Z',
                end: endDate.toISOString().replace(/[-:]/g, '').split('.')[0] + 'Z',
                description: 'Event ticket confirmation',
                location: '{{ $event->venue->name ?? "Venue TBA" }}'
            };
            
            // Create Google Calendar URL
            const googleCalendarUrl = `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(calendarData.title)}&dates=${calendarData.start}/${calendarData.end}&details=${encodeURIComponent(calendarData.description)}&location=${encodeURIComponent(calendarData.location)}`;
            
            // Create ICS file content
            const icsContent = `BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//TukioHub//Event Ticket//EN
BEGIN:VEVENT
UID:${Date.now()}@tukiohub.com
DTSTAMP:${new Date().toISOString().replace(/[-:]/g, '').split('.')[0]}Z
DTSTART:${calendarData.start}
DTEND:${calendarData.end}
SUMMARY:${calendarData.title}
DESCRIPTION:${calendarData.description}
LOCATION:${calendarData.location}
END:VEVENT
END:VCALENDAR`;
            
            // Show options to user
            const userChoice = confirm('Add to Google Calendar? (OK for Google Calendar, Cancel to download ICS file)');
            
            if (userChoice) {
                window.open(googleCalendarUrl, '_blank');
            } else {
                // Download ICS file
                const blob = new Blob([icsContent], { type: 'text/calendar' });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'event-ticket.ics';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
            }
            @else
            alert('Event date not available. Cannot add to calendar.');
            @endif
        });
    }

    // Helper functions for regenerating codes after print
    function generateQRCode() {
        const qrElement = document.getElementById("qr-code");
        if (qrElement && typeof QRCode !== 'undefined') {
            const baseUrl = window.location.origin;
            const qrUrl = `${baseUrl}/ticket/verify/${ticketId}`;
            QRCode.toCanvas(qrElement, qrUrl, {
                width: 160,
                margin: 6,
                errorCorrectionLevel: 'L',
                type: 'image/png',
                quality: 1.0,
                color: {
                    dark: '#FFFFFF',
                    light: '#00000000'
                }
            }, function (error) {
                if (error) console.error('QR Code regeneration error:', error);
            });
        }
    }

    function generateBarcode() {
        const barcodeElement = document.getElementById('barcode');
        if (barcodeElement && typeof JsBarcode !== 'undefined') {
            JsBarcode(barcodeElement, barcodeNumber, {
                format: "CODE128",
                lineColor: "#fff",
                width: 2,
                height: 60,
                displayValue: false,
                background: "transparent",
                fontOptions: "bold",
                font: "monospace",
                fontSize: 16,
                margin: 10
            });
            
            const barcodeNumberElement = document.getElementById('barcode-number');
            if (barcodeNumberElement) {
                barcodeNumberElement.textContent = barcodeNumber;
            }
        }
    }
});
</script>
@endsection
