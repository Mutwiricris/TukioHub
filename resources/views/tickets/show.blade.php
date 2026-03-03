@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Enhanced Back button -->
        <div class="mb-8">
            <a href="{{ route('user.tickets.index') }}" class="group inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gray-800/50 border border-gray-700/50 text-gray-300 hover:text-white hover:bg-gray-800 hover:border-primary-500/30 transition-all duration-300">
                <svg class="h-5 w-5 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="font-medium">Back to My Tickets</span>
            </a>
        </div>

        <!-- Enhanced Ticket header -->
        <div class="rounded-2xl border border-gray-700/50 bg-gradient-to-br from-gray-800/60 to-gray-800/40 backdrop-blur-md shadow-2xl overflow-hidden mb-10">
            <div class="p-8">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-6">
                    <div class="flex items-start gap-4 flex-1">
                        <div class="p-3 rounded-2xl bg-gradient-to-br from-primary-500/20 to-emerald-500/20 border border-primary-500/30 flex-shrink-0">
                            <svg class="w-8 h-8 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl sm:text-4xl font-bold text-white mb-2">{{ $ticket->event->name }}</h1>
                            <p class="text-lg text-primary-400 font-semibold">{{ $ticket->ticket->ticketType->name ?? 'General Admission' }} Ticket</p>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold border {{ $ticket->status === 'active' ? 'bg-green-500/20 border-green-500/30 text-green-400' : 'bg-amber-500/20 border-amber-500/30 text-amber-400' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ ucfirst($ticket->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 xl:gap-10 2xl:gap-12">
            <!-- Ticket details -->
            <div class="xl:col-span-2 space-y-6 lg:space-y-8 xl:space-y-10">
                <!-- Enhanced Event Info Card -->
                <div class="rounded-2xl border border-gray-700/50 bg-gradient-to-br from-gray-800/60 to-gray-800/40 backdrop-blur-md shadow-2xl overflow-hidden">
                    <div class="p-6 sm:p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2 rounded-xl bg-primary-500/20 border border-primary-500/30">
                                <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-white">Event Information</h2>
                        </div>
                        <div class="space-y-5">
                            <div class="flex gap-4 p-5 rounded-xl bg-gray-700/30 border border-gray-600/50 hover:bg-gray-700/40 transition-colors">
                                <div class="flex-shrink-0">
                                    <div class="p-2.5 rounded-lg bg-primary-500/20 border border-primary-500/30">
                                        <svg class="h-6 w-6 text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wide mb-1.5">Date & Time</p>
                                    <p class="text-base text-white font-semibold mb-1">
                                        {{ $ticket->event->start_date->format('l, F j, Y') }}
                                    </p>
                                    <p class="text-sm text-gray-300">
                                        {{ $ticket->event->start_date->format('g:i A') }} - {{ $ticket->event->end_date->format('g:i A') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-4 p-5 rounded-xl bg-gray-700/30 border border-gray-600/50 hover:bg-gray-700/40 transition-colors">
                                <div class="flex-shrink-0">
                                    <div class="p-2.5 rounded-lg bg-emerald-500/20 border border-emerald-500/30">
                                        <svg class="h-6 w-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wide mb-1.5">Location</p>
                                    <p class="text-base text-white font-semibold mb-1">
                                        {{ $ticket->event->venue->name ?? 'Online Event' }}
                                    </p>
                                    @if($ticket->event->venue)
                                    <p class="text-sm text-gray-300">
                                        {{ $ticket->event->venue->address }}, {{ $ticket->event->venue->city }}, {{ $ticket->event->venue->country }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                            @if($ticket->event->description)
                            <div class="flex gap-4 p-5 rounded-xl bg-gray-700/30 border border-gray-600/50 hover:bg-gray-700/40 transition-colors">
                                <div class="flex-shrink-0">
                                    <div class="p-2.5 rounded-lg bg-blue-500/20 border border-blue-500/30">
                                        <svg class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wide mb-1.5">About the Event</p>
                                    <p class="text-sm text-gray-300 leading-relaxed">{{ $ticket->event->description }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Enhanced Ticket Actions -->
                <div class="rounded-2xl border border-gray-700/50 bg-gradient-to-br from-gray-800/60 to-gray-800/40 backdrop-blur-md shadow-2xl overflow-hidden">
                    <div class="p-6 sm:p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2 rounded-xl bg-primary-500/20 border border-primary-500/30">
                                <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-white">Quick Actions</h2>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <button id="download-ticket-pdf" class="group inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-xl bg-gradient-to-r from-primary-500 to-emerald-500 text-white font-bold shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                <span>Download PDF</span>
                                <svg class="h-4 w-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                            <button class="group inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-xl border border-gray-600/50 bg-gray-700/30 text-gray-300 font-bold hover:bg-gray-700/50 hover:border-gray-500/50 hover:text-white transition-all">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>Save to Wallet</span>
                            </button>
                            @if($ticket->status === 'active')
                            <button class="group inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-xl bg-blue-500/20 border border-blue-500/30 text-blue-400 font-bold hover:bg-blue-500/30 hover:border-blue-400/50 transition-all">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                </svg>
                                <span>Transfer Ticket</span>
                            </button>
                            @endif
                            <a href="{{ route('Eventsdetails', $ticket->event->slug) }}" class="group inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-xl border border-gray-600/50 bg-gray-700/30 text-gray-300 font-bold hover:bg-gray-700/50 hover:border-gray-500/50 hover:text-white transition-all">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <span>View Event</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Ticket Card -->
            <div class="xl:col-span-1">
                <div class="sticky top-6">
                    <div class="rounded-3xl border-2 border-gray-700/50 bg-gradient-to-br from-primary-500 via-emerald-500 to-teal-600 shadow-2xl overflow-hidden backdrop-blur-md">
                        <!-- Ticket Header -->
                        <div class="relative p-6 text-white bg-gradient-to-br from-black/20 to-transparent">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16"></div>
                            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>

                            <div class="relative">
                                <div class="flex items-start justify-between gap-3 mb-4">
                                    <div class="flex-1 min-w-0">
                                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white/20 backdrop-blur-sm border border-white/30 mb-3">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                            </svg>
                                            <span class="text-sm font-bold">E-TICKET</span>
                                        </div>
                                        <h3 class="text-xl font-bold line-clamp-2 mb-1">{{ $ticket->event->name }}</h3>
                                        <p class="text-sm opacity-90">{{ $ticket->ticket->ticketType->name ?? 'General Admission' }}</p>
                                    </div>
                                    <div class="text-right text-xs opacity-80 bg-white/10 backdrop-blur-sm px-3 py-2 rounded-lg border border-white/20">
                                        <div class="font-bold">#{{ substr($ticket->reference_number, -6) }}</div>
                                        <div class="mt-1">{{ $ticket->created_at->format('M j, Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- QR Code Section -->
                        <div class="px-6 py-8 text-center bg-gradient-to-br from-white/95 to-white/90 backdrop-blur-sm">
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gradient-to-r from-primary-500 to-emerald-500 text-white text-sm font-bold mb-4 shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                </svg>
                                <span>SCAN AT ENTRY</span>
                            </div>

                            <div class="relative inline-block">
                                <div class="absolute -inset-4 bg-gradient-to-r from-primary-500/20 via-emerald-500/20 to-teal-500/20 rounded-3xl blur-xl"></div>
                                <div class="relative bg-white p-6 rounded-2xl shadow-2xl border-4 border-primary-500/30">
                                    <div id="qrcode-{{ $ticket->id }}" class="w-52 h-52 sm:w-60 sm:h-60 lg:w-64 lg:h-64 xl:w-72 xl:h-72 flex items-center justify-center bg-gray-50 rounded-xl">
                                        <div class="text-center">
                                            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-primary-500 mb-2"></div>
                                            <div class="text-gray-500 text-sm font-medium">Loading QR Code...</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Barcode Section -->
                            <div class="mt-8 bg-white p-5 rounded-2xl shadow-lg border-2 border-gray-200/50 inline-block min-w-[280px]">
                                <div class="text-gray-600 text-xs font-bold uppercase tracking-wider mb-3">Ticket Reference</div>
                                <div id="barcode-{{ $ticket->id }}" class="text-center">
                                    <div class="text-gray-500 text-xs animate-pulse">Loading...</div>
                                </div>
                            </div>
                        </div>

                        <!-- Event Details -->
                        <div class="px-6 py-6 bg-gradient-to-br from-black/30 to-black/20 backdrop-blur-sm text-white border-t border-white/10">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between p-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20">
                                    <div class="flex items-center gap-2 text-sm opacity-80">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Date</span>
                                    </div>
                                    <span class="font-bold">{{ $ticket->event->start_date->format('M j, Y') }}</span>
                                </div>
                                <div class="flex items-center justify-between p-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20">
                                    <div class="flex items-center gap-2 text-sm opacity-80">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>Time</span>
                                    </div>
                                    <span class="font-bold">{{ $ticket->event->start_date->format('g:i A') }}</span>
                                </div>
                                <div class="flex items-center justify-between p-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20">
                                    <div class="flex items-center gap-2 text-sm opacity-80">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        </svg>
                                        <span>Venue</span>
                                    </div>
                                    <span class="font-bold text-right truncate ml-2">{{ $ticket->event->venue->name ?? 'Online' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Price Section -->
                        <div class="px-6 py-6 bg-gradient-to-br from-black/40 to-black/30 backdrop-blur-sm text-white">
                            <div class="text-center p-6 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20">
                                <div class="text-sm text-white/70 font-bold uppercase tracking-wider mb-2">Total Amount Paid</div>
                                <div class="text-4xl font-bold mb-3 bg-gradient-to-r from-white to-gray-200 bg-clip-text text-transparent">
                                    KES {{ number_format($ticket->price_paid ?? $ticket->ticket->price ?? 0, 0) }}
                                </div>
                                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-500/20 border border-green-400/30">
                                    <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm text-green-400 font-medium">
                                        @if($ticket->purchased_at)
                                            Paid {{ $ticket->purchased_at->format('M j, Y') }}
                                        @else
                                            Issued {{ $ticket->created_at->format('M j, Y') }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Support Link -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-400">
                            Need help?
                            <a href="#" class="text-primary-400 hover:text-primary-300 font-semibold inline-flex items-center gap-1 group">
                                <span>Contact support</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ticketData = '{{ $ticket->reference_number }}';
    
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
