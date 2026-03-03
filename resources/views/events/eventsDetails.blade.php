@extends('layouts.app')

@section('content')
{{-- Include Authentication Modal --}}
@include('components.auth-modal')
<div class="min-h-screen bg-gray-900 text-gray-200">
    <!-- Enhanced Hero Section -->
    <div class="relative h-[85vh] overflow-hidden">
        <img src="{{ $event->image_url ?? 'https://images.unsplash.com/photo-1527261834078-9b37d35a4a32?q=80&w=2070&auto=format&fit=crop' }}"
             alt="Hero image for {{ $event->name }}"
             class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-gray-900/40"></div>

        <div class="relative flex h-full items-end pb-16">
            <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl">
                    <div class="mb-6 flex flex-wrap items-center gap-3">
                        <span class="inline-flex items-center gap-x-2 rounded-xl bg-gradient-to-r from-primary-500/20 to-emerald-500/20 border border-primary-500/30 px-4 py-2 text-sm font-bold text-primary-300 backdrop-blur-sm shadow-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            {{ $event->eventType->name ?? 'Event' }}
                        </span>
                        @include('components.organizer-badge', ['event' => $event])
                    </div>

                    <h1 class="text-5xl font-bold tracking-tight text-white sm:text-6xl lg:text-7xl mb-6 leading-tight">
                        {{ $event->name }}
                    </h1>

                    <p class="text-xl text-gray-300 mb-10 max-w-3xl leading-relaxed">
                        {{ Str::limit($event->description, 150) }}
                    </p>

                    <div class="flex flex-col gap-4 sm:flex-row">
                        <button onclick="@guest showAuthModal(); @else ticket_modal.showModal(); @endguest"
                                class="group inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-primary-500 to-emerald-500 px-10 py-5 text-lg font-bold text-white shadow-2xl shadow-primary-500/30 transition-all duration-300 hover:shadow-primary-500/40 hover:scale-105 active:scale-100">
                            <svg class="mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                            </svg>
                            Get Tickets
                            <svg class="ml-3 h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>

                        <button class="group inline-flex items-center justify-center rounded-2xl border-2 border-white/20 bg-white/5 px-10 py-5 text-lg font-bold text-white backdrop-blur-md transition-all duration-300 hover:bg-white/10 hover:border-white/30">
                            <svg class="mr-3 h-6 w-6 text-pink-400 transition-transform group-hover:scale-110" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                            Save Event
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 -mt-16">
        <div class="grid grid-cols-1 gap-y-12 gap-x-16 lg:grid-cols-3">
            <div class="lg:col-span-2 space-y-12">
                <!-- Enhanced Info Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex items-center gap-4 rounded-2xl bg-gradient-to-br from-gray-800/60 to-gray-800/40 border border-gray-700/50 p-6 backdrop-blur-md shadow-xl hover:shadow-2xl hover:border-primary-500/30 transition-all duration-300">
                        <div class="rounded-xl bg-gradient-to-br from-primary-500/20 to-emerald-500/20 p-4 border border-primary-500/30 shadow-lg">
                            <svg class="h-7 w-7 text-primary-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-400 mb-1">Date & Time</p>
                            <p class="text-white font-bold text-lg">{{ \Carbon\Carbon::parse($event->date)->format('M j, Y • g:i A') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 rounded-2xl bg-gradient-to-br from-gray-800/60 to-gray-800/40 border border-gray-700/50 p-6 backdrop-blur-md shadow-xl hover:shadow-2xl hover:border-primary-500/30 transition-all duration-300">
                        <div class="rounded-xl bg-gradient-to-br from-primary-500/20 to-emerald-500/20 p-4 border border-primary-500/30 shadow-lg">
                             <svg class="h-7 w-7 text-primary-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-400 mb-1">Location</p>
                            <p class="text-white font-bold text-lg">{{ $event->venue->name ?? 'TBA' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Enhanced About Section -->
                <div class="rounded-2xl bg-gradient-to-br from-gray-800/60 to-gray-800/40 p-8 backdrop-blur-md border border-gray-700/50 shadow-2xl">
                    <h2 class="text-3xl font-bold text-white mb-6 flex items-center gap-3">
                        <div class="h-1 w-1 rounded-full bg-primary-500"></div>
                        About This Event
                    </h2>
                    <div class="prose prose-invert prose-lg max-w-none prose-p:text-gray-300 prose-headings:text-white prose-a:text-primary-400">
                        {!! $event->description !!}
                    </div>
                </div>

                @if($event->performers && $event->performers->count() > 0)
                <!-- Enhanced Lineup Section -->
                <div class="rounded-2xl bg-gradient-to-br from-gray-800/60 to-gray-800/40 p-8 backdrop-blur-md border border-gray-700/50 shadow-2xl">
                    <h2 class="text-3xl font-bold text-white mb-6 flex items-center gap-3">
                        <div class="h-1 w-1 rounded-full bg-primary-500"></div>
                        Lineup
                    </h2>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @foreach($event->performers as $performer)
                        <div class="group rounded-xl bg-gray-700/30 border border-gray-600/30 p-4 transition-all duration-300 hover:bg-gray-700/50 hover:border-primary-500/50 hover:shadow-lg">
                            <h3 class="text-lg font-bold text-white group-hover:text-primary-400 transition-colors">{{ $performer->name }}</h3>
                            <p class="text-sm text-primary-400 font-medium">{{ $performer->type ?? 'Artist' }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Enhanced Sidebar -->
            <div class="space-y-8">
                <!-- Tickets Widget -->
                <div class="sticky top-8 rounded-2xl bg-gradient-to-br from-gray-800/60 to-gray-800/40 p-6 backdrop-blur-md border border-gray-700/50 shadow-2xl">
                    <div class="flex items-center gap-2 mb-6">
                        <svg class="w-6 h-6 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                        <h2 class="text-2xl font-bold text-white">Tickets</h2>
                    </div>
                    @if($event->tickets && $event->tickets->count() > 0)
                        <div class="space-y-3 mb-6">
                            @foreach($event->tickets->take(3) as $ticket)
                            <div class="rounded-xl bg-gray-700/40 border border-gray-600/40 p-4 hover:bg-gray-700/60 hover:border-primary-500/50 transition-all duration-300">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-white">{{ $ticket->ticketType->name ?? 'General' }}</span>
                                    <span class="font-bold text-xl text-primary-400">KES {{ number_format($ticket->price, 0) }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button onclick="@guest showAuthModal(); @else ticket_modal.showModal(); @endguest"
                                class="w-full rounded-xl bg-gradient-to-r from-primary-500 to-emerald-500 py-4 text-base font-bold text-white shadow-lg transition-all hover:shadow-xl hover:shadow-primary-500/30 hover:scale-[1.02]">
                            Select Tickets
                        </button>
                    @else
                        <div class="text-center py-8">
                             <p class="text-gray-400 mb-4">Tickets not available yet.</p>
                            <button onclick="@guest showAuthModal(); @endguest" class="rounded-xl border-2 border-primary-500/50 bg-primary-500/10 px-6 py-3 text-primary-400 font-bold transition-all hover:bg-primary-500 hover:text-white">
                                Join Waitlist
                            </button>
                        </div>
                    @endif>
                </div>

                 <!-- Enhanced Stats Widget -->
                 <div class="rounded-2xl bg-gradient-to-br from-gray-800/60 to-gray-800/40 p-6 backdrop-blur-md border border-gray-700/50 shadow-2xl">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between p-4 rounded-xl bg-gray-700/30 border border-gray-600/30">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-lg bg-primary-500/20 border border-primary-500/30">
                                    <svg class="w-5 h-5 text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-gray-300 font-medium">Interested</span>
                            </div>
                            <span class="text-2xl font-bold text-primary-400">{{ rand(50, 500) }}+</span>
                        </div>
                        <div class="flex items-center justify-between p-4 rounded-xl bg-gray-700/30 border border-gray-600/30">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-lg bg-emerald-500/20 border border-emerald-500/30">
                                    <svg class="w-5 h-5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-gray-300 font-medium">Going</span>
                            </div>
                            <span class="text-2xl font-bold text-emerald-400">{{ rand(20, 200) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<dialog id="ticket_modal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box max-w-3xl bg-gray-900/95 backdrop-blur-2xl border-2 border-gray-700/50 shadow-2xl shadow-black/50 rounded-3xl">
        <div class="flex items-start justify-between pb-6 border-b border-gray-700/50">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-6 h-6 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                    <h3 class="text-2xl font-bold text-white">Select Your Tickets</h3>
                </div>
                <p class="text-gray-400 mt-1">for {{ $event->name }}</p>
            </div>
            <form method="dialog">
                <button class="p-2 rounded-xl text-gray-400 hover:text-white hover:bg-gray-700/50 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </form>
        </div>

        @if($event->tickets && $event->tickets->count() > 0)
            <div class="space-y-4 my-6 max-h-[50vh] overflow-y-auto pr-2">
                @foreach($event->tickets as $ticket)
                <div class="ticket-tier group relative rounded-2xl bg-gradient-to-br from-gray-800/60 to-gray-800/40 p-6 border-2 border-gray-700/50 transition-all duration-300 hover:border-primary-500/70 hover:shadow-xl hover:shadow-primary-500/10"
                     data-ticket-id="{{ $ticket->id }}" data-price="{{ $ticket->price }}" data-available="{{ $ticket->quantity ?? 10 }}">

                    <div class="flex flex-col sm:flex-row justify-between sm:items-start gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h4 class="text-xl font-bold text-white group-hover:text-primary-400 transition-colors">
                                    {{ $ticket->ticketType->name ?? 'General Admission' }}
                                </h4>
                                @if($ticket->quantity !== null && $ticket->quantity > 0 && $ticket->quantity <= 10)
                                <span class="px-3 py-1 text-xs font-bold bg-amber-500/20 text-amber-400 rounded-full border border-amber-500/30">
                                    {{ $ticket->quantity }} left!
                                </span>
                                @endif
                            </div>
                            <p class="text-gray-400 text-sm mb-3">{{ $ticket->description ?? 'Standard access to the event.' }}</p>
                        </div>

                        <div class="text-right flex-shrink-0">
                            <div class="text-3xl font-bold bg-gradient-to-r from-primary-400 to-emerald-400 bg-clip-text text-transparent mb-1">KES {{ number_format($ticket->price, 0) }}</div>
                            @if($ticket->quantity !== null && $ticket->quantity > 0)
                            <div class="text-sm text-gray-400">{{ $ticket->quantity }} available</div>
                            @endif
                        </div>
                    </div>

                    @if($ticket->quantity == 0)
                        <div class="mt-4 flex items-center justify-center gap-2 px-6 py-3 bg-red-500/20 text-red-400 rounded-lg font-semibold">
                            SOLD OUT
                        </div>
                    @else
                        <div class="mt-4 pt-4 border-t border-white/10 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <button type="button" class="quantity-btn decrease flex h-9 w-9 items-center justify-center rounded-full bg-zinc-700 text-zinc-400 font-bold transition-all hover:bg-zinc-600 hover:text-white disabled:opacity-50 disabled:cursor-not-allowed" data-ticket-id="{{ $ticket->id }}" disabled>–</button>
                                <span class="quantity-display text-xl font-bold text-white w-12 text-center">0</span>
                                <button type="button" class="quantity-btn increase flex h-9 w-9 items-center justify-center rounded-full bg-zinc-700 text-green-400 font-bold transition-all hover:bg-green-500/20 hover:text-green-300" data-ticket-id="{{ $ticket->id }}">+</button>
                            </div>
                            <div class="ticket-subtotal text-2xl font-bold text-green-400 transition-all duration-300">KES 0</div>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>

            <div class="sticky bottom-0 bg-gray-900/95 backdrop-blur-xl border-t border-gray-700/50 pt-6 -mx-6 px-6 -mb-6 pb-6">
                <div class="rounded-2xl bg-gradient-to-br from-gray-800/60 to-gray-800/40 border border-gray-700/50 p-5 mb-4">
                    <div class="space-y-3">
                        <div class="flex justify-between text-gray-300">
                            <span class="font-medium">Subtotal</span>
                            <span class="subtotal-display font-mono font-bold">KES 0.00</span>
                        </div>
                        <!-- Service fee removed -->
                        <div class="border-t border-gray-700/50 my-2"></div>
                        <div class="flex justify-between text-2xl font-bold">
                            <span class="text-white">Total</span>
                            <span id="final-total" class="bg-gradient-to-r from-primary-400 to-emerald-400 bg-clip-text text-transparent font-mono">KES 0.00</span>
                        </div>
                    </div>
                </div>

                <button class="checkout-btn w-full rounded-2xl bg-gradient-to-r from-primary-500 to-emerald-500 py-5 text-lg font-bold text-white transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:from-gray-700 disabled:to-gray-800 shadow-2xl hover:shadow-primary-500/30 transform hover:scale-[1.02] active:scale-[1]" disabled>
                    <span class="flex items-center justify-center gap-3">
                        <span class="checkout-text">Select tickets to continue</span>
                        <div class="checkout-loader hidden">
                            <div class="w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
                        </div>
                    </span>
                </button>
            </div>
        @else
             <div class="text-center py-16">
                <h4 class="text-xl font-semibold text-white mb-3">Tickets Coming Soon</h4>
                <p class="text-zinc-400 mb-6 max-w-sm mx-auto">Tickets for this event are not available yet. Join the waitlist to be notified.</p>
                <button class="inline-flex items-center gap-3 rounded-lg border border-green-500/50 bg-green-500/10 px-6 py-3 text-green-400 font-semibold transition-all hover:bg-green-500 hover:text-white hover:border-green-500">
                    Join Waitlist
                </button>
            </div>
        @endif
    </div>
    <form method="dialog" class="modal-backdrop bg-black/60 backdrop-blur-sm">
        <button>close</button>
    </form>
</dialog>

<!-- Enhanced Mobile Sticky Bar -->
<div class="fixed bottom-0 left-0 right-0 z-40 lg:hidden p-3 bg-gradient-to-t from-gray-900 via-gray-900 to-transparent pointer-events-none">
    <div class="bg-gradient-to-br from-gray-800/90 to-gray-800/70 backdrop-blur-xl border-2 border-gray-700/50 rounded-2xl p-4 shadow-2xl shadow-black/50 pointer-events-auto">
        <div class="flex items-center justify-between gap-3">
             <div class="pl-2">
                 <p class="text-xs font-medium text-gray-400 mb-1">Tickets from</p>
                 <p class="font-bold bg-gradient-to-r from-primary-400 to-emerald-400 bg-clip-text text-transparent text-2xl">KES {{ number_format($event->tickets->min('price') ?? 0, 0) }}</p>
             </div>
             <button onclick="ticket_modal.showModal()"
                    class="flex-1 rounded-xl bg-gradient-to-r from-primary-500 to-emerald-500 py-4 px-6 text-center font-bold text-white shadow-lg transition-all hover:shadow-xl hover:shadow-primary-500/30 active:scale-95">
                Get Tickets
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ticketState = {
        tickets: [
            @foreach($event->tickets as $ticket)
            { id: {{ $ticket->id }}, price: {{ $ticket->price }}, max_quantity: {{ $ticket->quantity ?? 99 }}, selected_quantity: 0 },
            @endforeach
        ]
    };

    const modal = document.getElementById('ticket_modal');
    if (!modal) return;

    function animateValue(element, start, end, duration = 300) {
        if (!element || start === end) return;
        const startTime = performance.now();
        const animate = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const value = start + (end - start) * progress;
            element.textContent = `KES ${Math.round(value).toLocaleString()}`;
            if (progress < 1) requestAnimationFrame(animate);
        };
        requestAnimationFrame(animate);
    }

    function updateTotal() {
        let subtotal = ticketState.tickets.reduce((acc, ticket) => acc + (ticket.price * ticket.selected_quantity), 0);
        const total = subtotal; // No service fee

        // Update displays with animation
        const subtotalEl = document.querySelector('.subtotal-display');
        if (subtotalEl) {
            animateValue(subtotalEl, parseFloat(subtotalEl.textContent.replace('KES', '')), subtotal);
        }

        const totalEl = document.getElementById('final-total');
        if (totalEl) {
            animateValue(totalEl, parseFloat(totalEl.textContent.replace('KES', '')), total);
        }

        document.querySelectorAll('.ticket-tier').forEach(tierEl => {
            const ticketId = parseInt(tierEl.dataset.ticketId);
            const ticket = ticketState.tickets.find(t => t.id === ticketId);
            if (!ticket) return;

            const ticketSubtotalEl = tierEl.querySelector('.ticket-subtotal');
            if (ticketSubtotalEl) {
                const currentTicketSubtotal = parseFloat(ticketSubtotalEl.textContent.replace('KES', ''));
                animateValue(ticketSubtotalEl, currentTicketSubtotal, ticket.price * ticket.selected_quantity);
            }

            const quantityDisplay = tierEl.querySelector('.quantity-display');
            const decreaseBtn = tierEl.querySelector('.quantity-btn.decrease');
            const increaseBtn = tierEl.querySelector('.quantity-btn.increase');

            if (quantityDisplay) quantityDisplay.textContent = ticket.selected_quantity;
            if (decreaseBtn) decreaseBtn.disabled = ticket.selected_quantity === 0;
            if (increaseBtn) increaseBtn.disabled = ticket.selected_quantity >= ticket.max_quantity;

            if (ticket.selected_quantity > 0) {
                tierEl.classList.add('ring-2', 'ring-green-500/70', 'border-green-500/70');
            } else {
                tierEl.classList.remove('ring-2', 'ring-green-500/70', 'border-green-500/70');
            }
        });

        const checkoutBtn = document.querySelector('.checkout-btn');
        const checkoutText = document.querySelector('.checkout-text');
        const hasTickets = subtotal > 0;

        if (checkoutBtn) {
            checkoutBtn.disabled = !hasTickets;
        }
        if (checkoutText) {
            checkoutText.textContent = hasTickets ? `Proceed to Checkout • KES ${Math.round(total).toLocaleString()}` : 'Select tickets to continue';
        }
    }

    modal.addEventListener('click', function(e) {
        const btn = e.target.closest('.quantity-btn');
        if (!btn) return;

        const ticketId = parseInt(btn.dataset.ticketId);
        const ticket = ticketState.tickets.find(t => t.id === ticketId);
        if (!ticket) return;

        if (btn.classList.contains('increase') && ticket.selected_quantity < ticket.max_quantity) {
            ticket.selected_quantity++;
        } else if (btn.classList.contains('decrease') && ticket.selected_quantity > 0) {
            ticket.selected_quantity--;
        }
        updateTotal();
    });

    const checkoutBtn = document.querySelector('.checkout-btn');
    if(checkoutBtn) {
        checkoutBtn.addEventListener('click', function() {
            const selectedTickets = ticketState.tickets.filter(t => t.selected_quantity > 0);
            if (selectedTickets.length > 0) {
                // Create a form and submit via POST
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/checkout';

                // Add CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);

                // Add event ID
                const eventInput = document.createElement('input');
                eventInput.type = 'hidden';
                eventInput.name = 'event_id';
                eventInput.value = {{ $event->id }};
                form.appendChild(eventInput);

                // Add ticket data
                selectedTickets.forEach((ticket, index) => {
                    const ticketIdInput = document.createElement('input');
                    ticketIdInput.type = 'hidden';
                    ticketIdInput.name = `tickets[${ticket.id}][id]`;
                    ticketIdInput.value = ticket.id;
                    form.appendChild(ticketIdInput);

                    const ticketQuantityInput = document.createElement('input');
                    ticketQuantityInput.type = 'hidden';
                    ticketQuantityInput.name = `tickets[${ticket.id}][quantity]`;
                    ticketQuantityInput.value = ticket.selected_quantity;
                    form.appendChild(ticketQuantityInput);

                    const ticketPriceInput = document.createElement('input');
                    ticketPriceInput.type = 'hidden';
                    ticketPriceInput.name = `tickets[${ticket.id}][price]`;
                    ticketPriceInput.value = ticket.price;
                    form.appendChild(ticketPriceInput);

                    const ticketNameInput = document.createElement('input');
                    ticketNameInput.type = 'hidden';
                    ticketNameInput.name = `tickets[${ticket.id}][name]`;
                    ticketNameInput.value = ticket.name;
                    form.appendChild(ticketNameInput);
                });

                // Submit form
                document.body.appendChild(form);
                form.submit();
            } else {
                alert('Please select at least one ticket.');
            }
        });
    }

    modal.addEventListener('show', function() {
        updateTotal();
    });

    // Initialize on page load
    updateTotal();
});
</script>
@endsection
