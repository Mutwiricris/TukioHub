@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-zinc-900 text-zinc-200">
    <div class="relative h-[90vh] overflow-hidden">
        <img src="{{ $event->image_url ?? 'https://images.unsplash.com/photo-1527261834078-9b37d35a4a32?q=80&w=2070&auto=format&fit=crop' }}"
             alt="Hero image for {{ $event->name }}"
             class="absolute inset-0 h-full w-full object-cover transition-transform duration-1000 ease-in-out group-hover:scale-105">
        <div class="absolute inset-0 bg-gradient-to-t from-zinc-900 via-zinc-900/70 to-transparent"></div>

        <div class="relative flex h-full items-end pb-24">
            <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl text-left">
                    <div class="mb-4">
                        <span class="inline-flex items-center gap-x-2 rounded-full bg-green-500/10 px-4 py-2 text-sm font-medium text-green-300 ring-1 ring-inset ring-green-500/20">
                            {{ $event->eventType->name ?? 'Event' }}
                        </span>
                    </div>

                    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl lg:text-7xl mb-6">
                        {{ $event->name }}
                    </h1>

                    <p class="text-lg text-zinc-300 mb-8 max-w-3xl leading-8">
                        {{ Str::limit($event->description, 150) }}
                    </p>

                    <div class="flex flex-col gap-4 sm:flex-row">
                        <button onclick="ticket_modal.showModal()"
                                class="group inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-green-500 to-teal-500 px-8 py-4 text-lg font-bold text-white shadow-lg shadow-green-500/20 transition-all duration-300 hover:shadow-xl hover:shadow-green-500/30 hover:scale-105 active:scale-100">
                            <svg class="mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                            </svg>
                            Get Tickets
                        </button>

                        <button class="group inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-8 py-4 text-lg font-semibold text-white backdrop-blur-md transition-all duration-300 hover:bg-white/10 hover:border-white/20">
                            <svg class="mr-3 h-6 w-6 text-pink-400 transition-transform group-hover:scale-110" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
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
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex items-center gap-4 rounded-2xl bg-zinc-800/50 border border-white/10 p-6 backdrop-blur-sm">
                        <div class="rounded-xl bg-gradient-to-br from-green-500/20 to-teal-500/20 p-3 ring-1 ring-inset ring-white/10">
                            <svg class="h-7 w-7 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-400">Date & Time</p>
                            <p class="text-white font-semibold text-lg">{{ \Carbon\Carbon::parse($event->date)->format('M j, Y • g:i A') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 rounded-2xl bg-zinc-800/50 border border-white/10 p-6 backdrop-blur-sm">
                        <div class="rounded-xl bg-gradient-to-br from-green-500/20 to-teal-500/20 p-3 ring-1 ring-inset ring-white/10">
                             <svg class="h-7 w-7 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-400">Location</p>
                            <p class="text-white font-semibold text-lg">{{ $event->venue->name ?? 'TBA' }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-zinc-800/30 p-8 backdrop-blur-sm border border-white/10">
                    <h2 class="text-3xl font-bold text-white mb-6">About This Event</h2>
                    <div class="prose prose-invert prose-lg max-w-none prose-p:text-zinc-300">
                        {!! $event->description !!}
                    </div>
                </div>

                @if($event->performers && $event->performers->count() > 0)
                <div class="rounded-2xl bg-zinc-800/30 p-8 backdrop-blur-sm border border-white/10">
                    <h2 class="text-3xl font-bold text-white mb-6">Lineup</h2>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @foreach($event->performers as $performer)
                        <div class="rounded-xl p-4 transition-all duration-300 hover:bg-zinc-700/50">
                            <h3 class="text-lg font-semibold text-white">{{ $performer->name }}</h3>
                            <p class="text-sm text-green-400">{{ $performer->type ?? 'Artist' }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="space-y-8">
                <div class="sticky top-8 rounded-2xl bg-zinc-800/50 p-6 backdrop-blur-sm border border-white/10">
                    <h2 class="text-2xl font-bold text-white mb-6">Tickets</h2>
                    @if($event->tickets && $event->tickets->count() > 0)
                        <div class="space-y-4 mb-6">
                            @foreach($event->tickets->take(3) as $ticket)
                            <div class="rounded-lg bg-zinc-700/40 p-3">
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold text-white">{{ $ticket->ticketType->name ?? 'General' }}</span>
                                    <span class="font-bold text-lg text-white">${{ number_format($ticket->price, 2) }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button onclick="ticket_modal.showModal()"
                                class="w-full rounded-lg bg-gradient-to-r from-green-500 to-teal-500 py-3 text-base font-bold text-white transition-all hover:opacity-90">
                            Select Tickets
                        </button>
                    @else
                        <div class="text-center py-8">
                             <p class="text-zinc-400 mb-4">Tickets not available yet.</p>
                            <button class="rounded-lg border border-green-500/50 px-6 py-2 text-green-400 transition-all hover:bg-green-500/10">
                                Join Waitlist
                            </button>
                        </div>
                    @endif
                </div>

                 <div class="rounded-2xl bg-zinc-800/50 p-6 backdrop-blur-sm border border-white/10">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <span class="text-zinc-300 font-medium">Interested</span>
                            <span class="text-2xl font-bold text-green-400">{{ rand(50, 500) }}+</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-zinc-300 font-medium">Going</span>
                            <span class="text-2xl font-bold text-green-400">{{ rand(20, 200) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<dialog id="ticket_modal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box max-w-3xl bg-zinc-900/80 backdrop-blur-2xl border border-white/10 shadow-2xl shadow-black/50">
        <div class="flex items-start justify-between pb-4 border-b border-white/10">
            <div>
                <h3 class="text-2xl font-bold text-white">Select Your Tickets</h3>
                <p class="text-zinc-400 mt-1">for {{ $event->name }}</p>
            </div>
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost text-zinc-400 hover:text-white hover:bg-white/10">✕</button>
            </form>
        </div>

        @if($event->tickets && $event->tickets->count() > 0)
            <div class="space-y-4 my-6 max-h-[50vh] overflow-y-auto pr-2">
                @foreach($event->tickets as $ticket)
                <div class="ticket-tier group relative rounded-2xl bg-gradient-to-br from-zinc-800 to-zinc-800/50 p-5 border border-transparent transition-all duration-300 hover:border-green-500/50"
                     data-ticket-id="{{ $ticket->id }}" data-price="{{ $ticket->price }}" data-available="{{ $ticket->quantity ?? 10 }}">

                    <div class="flex flex-col sm:flex-row justify-between sm:items-start gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h4 class="text-xl font-bold text-white group-hover:text-green-300 transition-colors">
                                    {{ $ticket->ticketType->name ?? 'General Admission' }}
                                </h4>
                                @if($ticket->quantity !== null && $ticket->quantity > 0 && $ticket->quantity <= 10)
                                <span class="px-2 py-0.5 text-xs font-semibold bg-amber-500/20 text-amber-400 rounded-full">
                                    {{ $ticket->quantity }} left!
                                </span>
                                @endif
                            </div>
                            <p class="text-zinc-400 text-sm mb-3">{{ $ticket->description ?? 'Standard access to the event.' }}</p>
                        </div>

                        <div class="text-right flex-shrink-0">
                            <div class="text-3xl font-bold text-white mb-1">${{ number_format($ticket->price, 2) }}</div>
                            @if($ticket->quantity !== null && $ticket->quantity > 0)
                            <div class="text-sm text-zinc-400">{{ $ticket->quantity }} available</div>
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
                            <div class="ticket-subtotal text-2xl font-bold text-green-400 transition-all duration-300">$0.00</div>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>

            <div class="sticky bottom-0 bg-zinc-900/80 backdrop-blur-xl border-t border-white/10 pt-4 -mx-6 px-6 -mb-6 pb-6">
                <div class="rounded-xl bg-zinc-800/50 border border-white/10 p-4 mb-4">
                    <div class="space-y-2">
                        <div class="flex justify-between text-zinc-300">
                            <span>Subtotal</span>
                            <span class="subtotal-display font-mono font-semibold">$0.00</span>
                        </div>
                        <!-- Service fee removed -->
                        <div class="border-t border-white/10 my-2"></div>
                        <div class="flex justify-between text-xl font-bold">
                            <span class="text-white">Total</span>
                            <span id="final-total" class="text-green-400 font-mono">$0.00</span>
                        </div>
                    </div>
                </div>

                <button class="checkout-btn w-full rounded-xl bg-gradient-to-r from-green-500 to-teal-500 py-4 text-lg font-bold text-white transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:from-zinc-600 disabled:to-zinc-700 shadow-lg hover:shadow-xl hover:shadow-green-500/20 transform hover:scale-[1.02] active:scale-[1]" disabled>
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

<div class="fixed bottom-0 left-0 right-0 z-40 lg:hidden p-2 bg-gradient-to-t from-zinc-900 to-transparent">
    <div class="bg-zinc-800/80 backdrop-blur-lg border border-white/10 rounded-xl p-2 shadow-2xl shadow-black/50">
        <div class="flex items-center justify-between gap-2">
             <div class="pl-2">
                 <p class="text-sm text-zinc-400">Tickets from</p>
                 <p class="font-bold text-white text-lg">${{ number_format($event->tickets->min('price') ?? 0, 2) }}</p>
             </div>
             <button onclick="ticket_modal.showModal()"
                    class="flex-1 rounded-lg bg-gradient-to-r from-green-500 to-teal-500 py-3 text-center font-bold text-white transition-all hover:opacity-90 active:opacity-80">
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
            element.textContent = `$${value.toFixed(2)}`;
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
            animateValue(subtotalEl, parseFloat(subtotalEl.textContent.replace('$', '')), subtotal);
        }

        const totalEl = document.getElementById('final-total');
        if (totalEl) {
            animateValue(totalEl, parseFloat(totalEl.textContent.replace('$', '')), total);
        }

        document.querySelectorAll('.ticket-tier').forEach(tierEl => {
            const ticketId = parseInt(tierEl.dataset.ticketId);
            const ticket = ticketState.tickets.find(t => t.id === ticketId);
            if (!ticket) return;

            const ticketSubtotalEl = tierEl.querySelector('.ticket-subtotal');
            if (ticketSubtotalEl) {
                const currentTicketSubtotal = parseFloat(ticketSubtotalEl.textContent.replace('$', ''));
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
            checkoutText.textContent = hasTickets ? `Proceed to Checkout • $${total.toFixed(2)}` : 'Select tickets to continue';
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