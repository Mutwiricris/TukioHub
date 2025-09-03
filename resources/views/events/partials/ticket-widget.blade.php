<h2 class="text-2xl font-bold text-white mb-6">Get Your Tickets</h2>
@if($event->tickets->count() > 0)
    <div class="space-y-4">
        @foreach($event->tickets as $ticket)
            <div class="ticket-tier p-4 rounded-xl bg-gray-700/50 {{ $ticket->available_quantity == 0 ? 'opacity-60' : '' }}" data-ticket-id="{{ $ticket->id }}" data-price="{{ $ticket->price }}" data-soldout="{{ $ticket->available_quantity == 0 ? 'true' : 'false' }}">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h3 class="font-semibold text-white">{{ $ticket->ticketType->name }}</h3>
                        <p class="text-sm text-gray-400">{{ $ticket->description }}</p>
                    </div>
                    <p class="font-bold text-white">${{ number_format($ticket->price, 2) }}</p>
                </div>

                @if($ticket->available_quantity < 0)
                    <div class="flex items-center justify-end gap-2 mt-3">
                        <span class="text-sm font-semibold text-red-400">SOLD OUT</span>
                    </div>
                @else
                    <div class="flex items-center justify-end gap-2 mt-3">
                        <button data-action="quantity-minus" class="quantity-btn minus rounded-full w-8 h-8 bg-white/10 hover:bg-white/20 transition-colors" aria-label="Decrease quantity">-</button>
                        <input type="number" value="0" min="0" class="quantity-input w-12 bg-transparent text-center font-bold outline-none appearance-none text-white" readonly aria-live="polite">
                        <button data-action="quantity-plus" class="quantity-btn plus rounded-full w-8 h-8 bg-white/10 hover:bg-white/20 transition-colors" aria-label="Increase quantity">+</button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <div class="mt-6 border-t border-white/10 pt-4">
        <div class="flex justify-between font-bold text-white mb-4">
            <p>Sub-Total:</p>
            <p class="subtotal-display">$0.00</p>
        </div>
        <button data-action="checkout" class="checkout-btn w-full rounded-xl bg-primary-500 py-4 text-base font-bold text-white shadow-lg transition hover:bg-primary-400 disabled:bg-gray-600 disabled:cursor-not-allowed" disabled aria-label="Checkout (disabled, select tickets to enable)">
            Checkout
        </button>
    </div>
@else
    <div class="text-center py-8">
        <p class="text-gray-400 mb-4">Tickets not available yet</p>
        <button data-action="join-waitlist" class="w-full rounded-xl border border-primary-600 px-6 py-3 text-primary-400 hover:bg-primary-600 hover:text-white transition-colors">
            Join Waitlist
        </button>
    </div>
@endif