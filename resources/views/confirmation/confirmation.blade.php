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
{{--    <header class="border-b border-white/10 bg-gray-900/80 backdrop-blur-lg sticky top-0 z-20">--}}
{{--        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4">--}}
{{--            <a href="/" class="flex items-center gap-2">--}}
{{--                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary-500 text-white">--}}
{{--                    <i data-lucide="ticket" class="h-5 w-5"></i>--}}
{{--                </div>--}}
{{--                <span class="text-lg font-semibold">Tukio <span class="text-primary-400">Hub</span></span>--}}
{{--            </a>--}}
{{--            <a href="/account/tickets" class="text-xs text-gray-300 hover:text-white flex items-center gap-2">--}}
{{--                My Tickets <i data-lucide="arrow-right" class="h-4 w-4"></i>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </header>--}}

    {{-- Steps Indicator --}}
    <div class="bg-gray-800/50 border-b mt-6 border-white/10">
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
    <main class="mx-auto max-w-7xl px-4 py-8 sm:py-12">
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
            <div class="rounded-2xl border-2 border-dashed border-gray-600/50 bg-gray-800/30 p-1 shadow-2xl backdrop-blur-lg relative overflow-hidden max-w-5xl mx-auto">
                 <!-- Ticket perforations -->
                 <div class="absolute -top-4 left-1/2 -ml-4 h-8 w-8 rounded-full bg-gray-900"></div>
                 <div class="absolute -bottom-4 left-1/2 -ml-4 h-8 w-8 rounded-full bg-gray-900"></div>

                 <!-- Side perforations -->
                 <div class="absolute -left-2 top-1/4 h-4 w-4 rounded-full bg-gray-900"></div>
                 <div class="absolute -right-2 top-1/4 h-4 w-4 rounded-full bg-gray-900"></div>
                 <div class="absolute -left-2 top-3/4 h-4 w-4 rounded-full bg-gray-900"></div>
                 <div class="absolute -right-2 top-3/4 h-4 w-4 rounded-full bg-gray-900"></div>

                 <div class="rounded-xl bg-gradient-to-br from-gray-800/80 to-gray-900/80 p-6 xl:p-8 border border-gray-700/30 ticket-container">
                    <div class="gap-6 lg:gap-8 xl:gap-10 sm:flex">
                        <div class="flex-shrink-0 text-center sm:border-r sm:border-dashed sm:border-gray-600/50 sm:pr-6">
                            <p class="text-xs text-primary-400 font-medium mb-2">Scan at Entry</p>
                            <div class="flex justify-center">
                                <div id="qr-code" class="mt-2 rounded-lg border-2 border-gray-600/30 mx-auto bg-white p-4 xl:p-6">
                                    <div class="w-48 h-48 lg:w-56 lg:h-56 xl:w-64 xl:h-64 2xl:w-72 2xl:h-72 flex items-center justify-center text-gray-500 text-sm">
                                        Loading QR Code...
                                    </div>
                                </div>
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
                                <div class="bg-primary-500/10 border border-primary-500/20 rounded-lg p-4 xl:p-6">
                                    <div class="text-center">
                                        <div class="text-xs sm:text-sm text-primary-300/70 font-medium uppercase tracking-wide mb-2">Total Amount</div>
                                        <div class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-bold text-primary-400 mb-2">
                                            KES {{ number_format($amount, 0) }}
                                        </div>
                                        <div class="flex items-center justify-center space-x-2">
                                            <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-xs sm:text-sm text-emerald-400 font-medium">
                                                @if($paymentMethod === 'cash' && $status === 'reserved')
                                                    Reserved Successfully
                                                @else
                                                    Payment Confirmed
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 border-t border-dashed border-gray-600/50 pt-4 text-center bg-gray-700/10 rounded-lg p-4 xl:p-6">
                        <p class="text-xs xl:text-sm text-gray-400 mb-3 font-medium uppercase tracking-wide">Ticket Barcode</p>
                        <div class="bg-white/5 rounded-lg p-4 xl:p-6 inline-block min-w-[300px] xl:min-w-[400px]">
                            <svg id="barcode" class="mx-auto"></svg>
                        </div>
                        <p id="barcode-number" class="text-xs xl:text-sm text-gray-400 mt-3 font-mono tracking-wider"></p>
                    </div>
                 </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-3 xl:gap-6 max-w-4xl mx-auto">
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

    // Create QR code data
    const baseUrl = window.location.origin;
    const qrText = `ORDER:{{ $paymentReference ?? "CONF" }}:{{ $event->id }}:{{ auth()->id() ?? "GUEST" }}`;

    // Generate QR Code using external service
    const qrCodeElement = document.getElementById('qr-code');
    if (qrCodeElement) {
        const qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' + encodeURIComponent(qrText);
        qrCodeElement.innerHTML = '<img src="' + qrUrl + '" alt="QR Code" style="width: 100%; height: 100%; object-fit: contain;" onerror="this.outerHTML=\'<div style=\\\"padding: 20px; text-align: center; font-size: 14px; color: #666;\\\">QR Code<br>{{ $paymentReference ?? "CONF" }}</div>\'">';
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
    if (downloadPdfBtn) {
        downloadPdfBtn.addEventListener('click', (e) => {
            e.preventDefault();
            
            // Create a new window for the printable ticket
            const printWindow = window.open('', '_blank');
            const qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' + encodeURIComponent(qrText);
            
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Event Ticket - {{ $event->name ?? 'Event' }}</title>
                    <style>
                        * { margin: 0; padding: 0; box-sizing: border-box; }
                        body { 
                            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                            background: #f8fafc;
                            padding: 20px;
                            color: #1f2937;
                        }
                        .ticket {
                            max-width: 600px;
                            margin: 0 auto;
                            background: white;
                            border-radius: 20px;
                            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                            overflow: hidden;
                            position: relative;
                        }
                        .ticket::before {
                            content: '';
                            position: absolute;
                            top: 50%;
                            left: -10px;
                            width: 20px;
                            height: 20px;
                            background: #f8fafc;
                            border-radius: 50%;
                            transform: translateY(-50%);
                        }
                        .ticket::after {
                            content: '';
                            position: absolute;
                            top: 50%;
                            right: -10px;
                            width: 20px;
                            height: 20px;
                            background: #f8fafc;
                            border-radius: 50%;
                            transform: translateY(-50%);
                        }
                        .header {
                            background: linear-gradient(135deg, #10b981, #059669);
                            color: white;
                            padding: 30px;
                            text-align: center;
                        }
                        .event-title {
                            font-size: 28px;
                            font-weight: bold;
                            margin-bottom: 8px;
                        }
                        .ticket-type {
                            font-size: 16px;
                            opacity: 0.9;
                        }
                        .content {
                            padding: 30px;
                        }
                        .qr-section {
                            text-align: center;
                            margin-bottom: 30px;
                        }
                        .qr-code {
                            display: inline-block;
                            padding: 20px;
                            background: white;
                            border: 3px solid #e5e7eb;
                            border-radius: 15px;
                            margin-bottom: 15px;
                        }
                        .qr-code img {
                            width: 200px;
                            height: 200px;
                        }
                        .qr-label {
                            font-size: 14px;
                            color: #6b7280;
                            font-weight: 600;
                        }
                        .details {
                            display: grid;
                            grid-template-columns: 1fr 1fr;
                            gap: 20px;
                            margin-bottom: 30px;
                        }
                        .detail-item {
                            text-align: center;
                            padding: 20px;
                            background: #f9fafb;
                            border-radius: 12px;
                        }
                        .detail-label {
                            font-size: 12px;
                            color: #6b7280;
                            font-weight: 600;
                            text-transform: uppercase;
                            letter-spacing: 0.5px;
                            margin-bottom: 8px;
                        }
                        .detail-value {
                            font-size: 16px;
                            font-weight: bold;
                            color: #1f2937;
                        }
                        .barcode-section {
                            text-align: center;
                            padding: 20px;
                            background: #f9fafb;
                            border-radius: 12px;
                            margin-bottom: 20px;
                        }
                        .barcode-label {
                            font-size: 12px;
                            color: #6b7280;
                            font-weight: 600;
                            margin-bottom: 10px;
                        }
                        .barcode-number {
                            font-family: 'Courier New', monospace;
                            font-size: 18px;
                            font-weight: bold;
                            color: #1f2937;
                            letter-spacing: 2px;
                        }
                        .footer {
                            text-align: center;
                            padding: 20px;
                            border-top: 2px dashed #e5e7eb;
                            color: #6b7280;
                            font-size: 14px;
                        }
                        .amount {
                            font-size: 24px;
                            font-weight: bold;
                            color: #10b981;
                            margin-bottom: 5px;
                        }
                        @media print {
                            body { background: white; }
                            .ticket { box-shadow: none; border: 2px solid #e5e7eb; }
                        }
                    </style>
                </head>
                <body>
                    <div class="ticket">
                        <div class="header">
                            <div class="event-title">{{ $event->name ?? 'Event Name' }}</div>
                            <div class="ticket-type">
                                @if(isset($validatedTickets) && count($validatedTickets) > 0)
                                    {{ $validatedTickets[0]['type_name'] ?? 'General Admission' }}
                                @else
                                    General Admission
                                @endif
                            </div>
                        </div>
                        
                        <div class="content">
                            <div class="qr-section">
                                <div class="qr-code">
                                    <img src="${qrUrl}" alt="QR Code" onerror="this.style.display='none'">
                                </div>
                                <div class="qr-label">Present this QR code at the entrance</div>
                            </div>
                            
                            <div class="details">
                                <div class="detail-item">
                                    <div class="detail-label">Date</div>
                                    <div class="detail-value">
                                        @if($event && $event->date)
                                            {{ \Carbon\Carbon::parse($event->date)->format('M j, Y') }}
                                        @else
                                            TBA
                                        @endif
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Time</div>
                                    <div class="detail-value">
                                        @if($event && $event->date)
                                            {{ \Carbon\Carbon::parse($event->date)->format('g:i A') }}
                                        @else
                                            TBA
                                        @endif
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Venue</div>
                                    <div class="detail-value">
                                        @if($event && $event->venue)
                                            {{ $event->venue->name }}
                                        @else
                                            TBA
                                        @endif
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Reference</div>
                                    <div class="detail-value">{{ $paymentReference ?? 'N/A' }}</div>
                                </div>
                            </div>
                            
                            <div class="barcode-section">
                                <div class="barcode-label">Ticket Barcode</div>
                                <div class="barcode-number">${barcodeNumber}</div>
                            </div>
                            
                            <div class="footer">
                                @if($amount > 0)
                                <div class="amount">KES {{ number_format($amount, 0) }}</div>
                                @endif
                                <div>
                                    @if($paymentMethod === 'cash' && $status === 'reserved')
                                        Reserved on {{ now()->format('M j, Y') }}
                                    @else
                                        Purchased on {{ now()->format('M j, Y') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </body>
                </html>
            `);
            
            printWindow.document.close();
            printWindow.focus();
            
            // Wait for images to load then print
            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 1000);
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
