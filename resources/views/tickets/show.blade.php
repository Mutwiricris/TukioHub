@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Back button -->
        <div class="mb-6">
            <a href="{{ route('user.tickets.index') }}" class="inline-flex items-center text-green-400 hover:text-green-300">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to My Tickets
            </a>
        </div>

        <!-- Ticket header -->
        <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-white">{{ $ticket->event->name }}</h1>
                        <p class="mt-1 text-green-400">{{ $ticket->ticket->ticketType->name ?? 'General Admission' }} Ticket</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $ticket->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($ticket->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 xl:gap-10 2xl:gap-12">
            <!-- Ticket details -->
            <div class="xl:col-span-2 space-y-6 lg:space-y-8 xl:space-y-10">
                <!-- Event Info Card -->
                <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-4 sm:p-6">
                        <h2 class="text-lg font-semibold text-white mb-4">Event Information</h2>
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-400">Date & Time</p>
                                    <p class="text-sm text-white">
                                        {{ $ticket->event->start_date->format('l, F j, Y') }}<br>
                                        {{ $ticket->event->start_date->format('g:i A') }} - {{ $ticket->event->end_date->format('g:i A') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-400">Location</p>
                                    <p class="text-sm text-white">
                                        {{ $ticket->event->venue->name ?? 'Online Event' }}<br>
                                        @if($ticket->event->venue)
                                            {{ $ticket->event->venue->address }}, {{ $ticket->event->venue->city }}, {{ $ticket->event->venue->country }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @if($ticket->event->description)
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-400">About the Event</p>
                                    <p class="text-sm text-gray-300">{{ $ticket->event->description }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Ticket Actions -->
                <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-4 sm:p-6">
                        <h2 class="text-lg font-semibold text-white mb-4">Ticket Actions</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            <button id="download-ticket-pdf" class="inline-flex items-center justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download PDF
                            </button>
                            <button class="inline-flex items-center justify-center px-4 py-3 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Save to Wallet
                            </button>
                            @if($ticket->status === 'active')
                            <button class="inline-flex items-center justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                                Transfer Ticket
                            </button>
                            @endif
                            <a href="{{ route('Eventsdetails', $ticket->event->slug) }}" class="inline-flex items-center justify-center px-4 py-3 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View Event
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ticket Card -->
            <div class="xl:col-span-1">
                <div class="bg-gradient-to-br from-green-500 to-teal-600 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-4 sm:p-6 text-white">
                        <div class="flex justify-between items-start">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base sm:text-lg font-bold truncate">{{ $ticket->event->name }}</h3>
                                <p class="text-xs sm:text-sm opacity-80 truncate">{{ $ticket->ticket->ticketType->name ?? 'General Admission' }}</p>
                            </div>
                            <div class="text-right flex-shrink-0 ml-2">
                                <div class="text-xs opacity-80">Ticket #{{ $ticket->ticket_number ?? substr($ticket->reference_number, -6) }}</div>
                                <div class="text-xs opacity-80">{{ $ticket->created_at->format('M j, Y') }}</div>
                            </div>
                        </div>
                        
                        <div class="mt-6 text-center">
                            <!-- QR Code Section -->
                            <div class="bg-white p-6 rounded-2xl shadow-xl border-4 border-white/20 inline-block backdrop-blur-sm">
                                <div class="mb-3">
                                    <div class="text-gray-800 font-bold text-sm uppercase tracking-wider">Entry Pass</div>
                                </div>
                                <div id="qrcode-{{ $ticket->id }}" class="w-40 h-40 sm:w-48 sm:h-48 lg:w-56 lg:h-56 xl:w-64 xl:h-64 2xl:w-72 2xl:h-72 flex items-center justify-center bg-gray-50 rounded-xl border-2 border-gray-200">
                                    <div class="text-gray-500 text-xs sm:text-sm animate-pulse">Loading QR Code...</div>
                                </div>
                                <div class="mt-3 text-gray-600 text-xs font-medium">
                                    Scan at entrance
                                </div>
                            </div>
                            
                            <!-- Barcode Section -->
                            <div class="mt-6 bg-white/90 backdrop-blur-sm p-4 xl:p-6 rounded-xl shadow-lg border border-white/30 inline-block min-w-[280px] xl:min-w-[320px] 2xl:min-w-[360px]">
                                <div class="text-gray-700 text-xs font-semibold uppercase tracking-wide mb-2">Ticket Reference</div>
                                <div id="barcode-{{ $ticket->id }}" class="text-center">
                                    <div class="text-gray-500 text-xs animate-pulse">Loading Reference...</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 sm:mt-6 pt-4 border-t border-white/20">
                            <div class="flex justify-between text-xs sm:text-sm">
                                <span class="opacity-80">Date</span>
                                <span class="font-medium">{{ $ticket->event->start_date->format('M j, Y') }}</span>
                            </div>
                            <div class="flex justify-between text-xs sm:text-sm mt-2">
                                <span class="opacity-80">Time</span>
                                <span class="font-medium">{{ $ticket->event->start_date->format('g:i A') }}</span>
                            </div>
                            <div class="flex justify-between text-xs sm:text-sm mt-2">
                                <span class="opacity-80">Location</span>
                                <span class="font-medium text-right truncate ml-2">{{ $ticket->event->venue->name ?? 'Online' }}</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 sm:mt-6 pt-4 border-t border-white/20">
                            <div class="text-center">
                                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 sm:p-6 xl:p-8 border border-white/20">
                                    <div class="text-xs sm:text-sm text-white/70 font-medium uppercase tracking-wide mb-2">Total Amount</div>
                                    <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-2">
                                        Ksh {{ number_format($ticket->price_paid ?? $ticket->ticket->price ?? 0, 2) }}
                                    </div>
                                    <div class="flex items-center justify-center space-x-2">
                                        <svg class="w-4 h-4 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <p class="text-xs sm:text-sm text-green-300 font-medium">
                                            @if($ticket->purchased_at)
                                                Paid on {{ $ticket->purchased_at->format('M j, Y') }}
                                            @else
                                                Issued on {{ $ticket->created_at->format('M j, Y') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 text-center">
                    <p class="text-xs text-gray-400">Need help? <a href="#" class="text-green-400 hover:text-green-300">Contact support</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ticketData = 'TICKET:{{ $ticket->reference_number }}:{{ $ticket->user_id }}:{{ $ticket->event_id }}';
    
    function generateCodes() {
        // Generate QR Code using external service
        const qrElement = document.getElementById('qrcode-{{ $ticket->id }}');
        if (qrElement) {
            const qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' + encodeURIComponent(ticketData);
            qrElement.innerHTML = '<img src="' + qrUrl + '" alt="QR Code" style="width: 100%; height: 100%; object-fit: contain;" onerror="this.outerHTML=\'<div style=\\\"padding: 20px; text-align: center; font-size: 12px; color: #666;\\\">QR Code<br>{{ $ticket->reference_number }}</div>\'">';
        }
        
        // Generate Barcode - styled text display
        const barcodeElement = document.getElementById('barcode-{{ $ticket->id }}');
        if (barcodeElement) {
            barcodeElement.innerHTML = '<div style="padding: 12px 20px; text-align: center; font-size: 14px; font-weight: 600; color: #1f2937; background: #f9fafb; border-radius: 8px; border: 2px solid #e5e7eb; font-family: \'Courier New\', monospace; letter-spacing: 2px; box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);">{{ $ticket->reference_number }}</div>';
        }
    }
    
    // Execute after DOM is ready
    generateCodes();
    
    // Download PDF functionality
    const downloadBtn = document.getElementById('download-ticket-pdf');
    if (downloadBtn) {
        downloadBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Create a new window for the printable ticket with watermark
            const printWindow = window.open('', '_blank');
            const qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' + encodeURIComponent(ticketData);
            
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>{{ $ticket->event->name }} - Ticket</title>
                    <style>
                        * { margin: 0; padding: 0; box-sizing: border-box; }
                        body { 
                            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                            background: #f8fafc;
                            padding: 20px;
                            color: #1f2937;
                            position: relative;
                        }
                        
                        /* Watermark */
                        body::before {
                            content: 'OFFICIAL TICKET - {{ strtoupper($ticket->event->name) }}';
                            position: fixed;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%) rotate(-45deg);
                            font-size: 48px;
                            font-weight: bold;
                            color: rgba(16, 185, 129, 0.1);
                            z-index: 0;
                            white-space: nowrap;
                            pointer-events: none;
                        }
                        
                        .ticket {
                            max-width: 650px;
                            margin: 0 auto;
                            background: white;
                            border-radius: 25px;
                            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                            overflow: hidden;
                            position: relative;
                            z-index: 1;
                        }
                        
                        /* Ticket perforations */
                        .ticket::before {
                            content: '';
                            position: absolute;
                            top: 50%;
                            left: -12px;
                            width: 24px;
                            height: 24px;
                            background: #f8fafc;
                            border-radius: 50%;
                            transform: translateY(-50%);
                            box-shadow: 0 0 0 3px white;
                        }
                        .ticket::after {
                            content: '';
                            position: absolute;
                            top: 50%;
                            right: -12px;
                            width: 24px;
                            height: 24px;
                            background: #f8fafc;
                            border-radius: 50%;
                            transform: translateY(-50%);
                            box-shadow: 0 0 0 3px white;
                        }
                        
                        .header {
                            background: linear-gradient(135deg, #10b981, #059669);
                            color: white;
                            padding: 40px 30px;
                            text-align: center;
                            position: relative;
                        }
                        
                        .header::before {
                            content: '';
                            position: absolute;
                            top: 0;
                            right: 0;
                            width: 100px;
                            height: 100px;
                            background: rgba(255, 255, 255, 0.1);
                            border-radius: 50%;
                            transform: translate(30px, -30px);
                        }
                        
                        .event-title {
                            font-size: 32px;
                            font-weight: bold;
                            margin-bottom: 10px;
                            position: relative;
                            z-index: 2;
                        }
                        
                        .ticket-info {
                            font-size: 18px;
                            opacity: 0.9;
                            position: relative;
                            z-index: 2;
                        }
                        
                        .ticket-number {
                            position: absolute;
                            top: 15px;
                            right: 20px;
                            background: rgba(255, 255, 255, 0.2);
                            padding: 8px 12px;
                            border-radius: 8px;
                            font-size: 12px;
                            font-weight: bold;
                        }
                        
                        .content {
                            padding: 40px 30px;
                        }
                        
                        .main-section {
                            display: grid;
                            grid-template-columns: 1fr 2fr;
                            gap: 40px;
                            margin-bottom: 40px;
                        }
                        
                        .qr-section {
                            text-align: center;
                        }
                        
                        .qr-code {
                            display: inline-block;
                            padding: 25px;
                            background: white;
                            border: 4px solid #e5e7eb;
                            border-radius: 20px;
                            margin-bottom: 15px;
                            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
                        }
                        
                        .qr-code img {
                            width: 220px;
                            height: 220px;
                        }
                        
                        .qr-label {
                            font-size: 16px;
                            color: #10b981;
                            font-weight: 700;
                            text-transform: uppercase;
                            letter-spacing: 1px;
                        }
                        
                        .details-section h3 {
                            font-size: 24px;
                            font-weight: bold;
                            color: #1f2937;
                            margin-bottom: 25px;
                            border-bottom: 3px solid #10b981;
                            padding-bottom: 10px;
                        }
                        
                        .detail-grid {
                            display: grid;
                            grid-template-columns: 1fr 1fr;
                            gap: 20px;
                        }
                        
                        .detail-item {
                            background: #f9fafb;
                            padding: 20px;
                            border-radius: 15px;
                            border-left: 4px solid #10b981;
                        }
                        
                        .detail-label {
                            font-size: 12px;
                            color: #6b7280;
                            font-weight: 700;
                            text-transform: uppercase;
                            letter-spacing: 0.5px;
                            margin-bottom: 8px;
                        }
                        
                        .detail-value {
                            font-size: 18px;
                            font-weight: bold;
                            color: #1f2937;
                        }
                        
                        .status-section {
                            text-align: center;
                            padding: 25px;
                            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
                            border-radius: 15px;
                            margin-bottom: 30px;
                            border: 2px solid #10b981;
                        }
                        
                        .status-badge {
                            display: inline-block;
                            background: #10b981;
                            color: white;
                            padding: 12px 24px;
                            border-radius: 25px;
                            font-weight: bold;
                            font-size: 16px;
                            text-transform: uppercase;
                            letter-spacing: 1px;
                        }
                        
                        .barcode-section {
                            text-align: center;
                            padding: 25px;
                            background: #f9fafb;
                            border-radius: 15px;
                            border: 2px dashed #d1d5db;
                        }
                        
                        .barcode-label {
                            font-size: 14px;
                            color: #6b7280;
                            font-weight: 600;
                            margin-bottom: 15px;
                            text-transform: uppercase;
                        }
                        
                        .barcode-number {
                            font-family: 'Courier New', monospace;
                            font-size: 20px;
                            font-weight: bold;
                            color: #1f2937;
                            letter-spacing: 3px;
                            background: white;
                            padding: 15px 25px;
                            border-radius: 8px;
                            border: 1px solid #d1d5db;
                            display: inline-block;
                        }
                        
                        .footer {
                            text-align: center;
                            padding: 30px;
                            border-top: 3px dashed #e5e7eb;
                            color: #6b7280;
                            font-size: 14px;
                            background: #f9fafb;
                        }
                        
                        .price {
                            font-size: 28px;
                            font-weight: bold;
                            color: #10b981;
                            margin-bottom: 8px;
                        }
                        
                        .anti-fraud {
                            position: absolute;
                            bottom: 10px;
                            right: 15px;
                            font-size: 10px;
                            color: #9ca3af;
                            transform: rotate(-90deg);
                            transform-origin: right bottom;
                        }
                        
                        @media print {
                            body { background: white; }
                            .ticket { box-shadow: none; border: 3px solid #e5e7eb; }
                        }
                    </style>
                </head>
                <body>
                    <div class="ticket">
                        <div class="header">
                            <div class="ticket-number">Ticket #{{ substr($ticket->reference_number, -8) }}</div>
                            <div class="event-title">{{ $ticket->event->name }}</div>
                            <div class="ticket-info">{{ $ticket->ticket->ticketType->name ?? 'General Admission' }} Ticket</div>
                        </div>
                        
                        <div class="content">
                            <div class="status-section">
                                <div class="status-badge">{{ ucfirst($ticket->status) }} Ticket</div>
                            </div>
                            
                            <div class="main-section">
                                <div class="qr-section">
                                    <div class="qr-code">
                                        <img src="${qrUrl}" alt="QR Code" onerror="this.style.display='none'">
                                    </div>
                                    <div class="qr-label">Scan at Entry</div>
                                </div>
                                
                                <div class="details-section">
                                    <h3>Event Details</h3>
                                    <div class="detail-grid">
                                        <div class="detail-item">
                                            <div class="detail-label">Date</div>
                                            <div class="detail-value">{{ $ticket->event->start_date->format('M j, Y') }}</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Time</div>
                                            <div class="detail-value">{{ $ticket->event->start_date->format('g:i A') }}</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Venue</div>
                                            <div class="detail-value">{{ $ticket->event->venue->name ?? 'TBA' }}</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Reference</div>
                                            <div class="detail-value">{{ $ticket->reference_number }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="barcode-section">
                                <div class="barcode-label">Ticket Barcode</div>
                                <div class="barcode-number">{{ $ticket->reference_number }}</div>
                            </div>
                            
                            <div class="footer">
                                <div class="price">Ksh {{ number_format($ticket->ticket->price ?? 1000, 0) }}</div>
                                <div>
                                    @if($ticket->purchased_at)
                                        Purchased on {{ $ticket->purchased_at->format('M j, Y') }}
                                    @else
                                        Issued on {{ $ticket->created_at->format('M j, Y') }}
                                    @endif
                                </div>
                                <div style="margin-top: 15px; font-size: 12px; color: #9ca3af;">
                                    This is an official ticket. Verify authenticity at our website.
                                </div>
                            </div>
                            
                            <div class="anti-fraud">
                                OFFICIAL • {{ strtoupper($ticket->reference_number) }} • VERIFIED
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
            }, 1500);
        });
    }
});
</script>
