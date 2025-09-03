@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900">
    <!-- Header with Security Badge -->
    <div class="border-b border-gray-700/50 bg-gray-800/50 backdrop-blur-sm">
        <div class="mx-auto max-w-7xl px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="javascript:history.back()" class="flex items-center gap-2 text-gray-400 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Back to Event
                    </a>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-300">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    Secure Checkout
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Steps -->
    <div class="border-b border-gray-700/50 bg-gray-800/30">
        <div class="mx-auto max-w-7xl px-4 py-6">
            <div class="flex items-center justify-center">
                <ol class="flex items-center space-x-8">
                    <li class="flex items-center">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary-500 text-white font-bold">
                                1
                            </div>
                            <span class="text-white font-medium">Checkout</span>
                        </div>
                        <svg class="ml-4 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li class="flex items-center">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-700 text-gray-400 font-bold">
                                2
                            </div>
                            <span class="text-gray-400 font-medium">Payment</span>
                        </div>
                        <svg class="ml-4 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li class="flex items-center">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-700 text-gray-400 font-bold">
                                3
                            </div>
                            <span class="text-gray-400 font-medium">Confirmation</span>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="mx-auto max-w-7xl px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Form -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Event Summary -->
                <div class="rounded-2xl bg-gray-800/50 backdrop-blur-sm border border-gray-700/50 p-6">
                    <h2 class="text-xl font-bold text-white mb-4">Event Summary</h2>
                    <div class="flex items-center gap-4">
                        <img id="event-image" src="@if(isset($event) && $event->image_url){{ $event->image_url }}@else https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=400 @endif"
                             alt="Event cover"
                             class="h-20 w-32 rounded-xl object-cover">
                        <div class="flex-1">
                            <h3 id="event-name" class="text-lg font-semibold text-white">
                                @if(isset($event))
                                    {{ $event->name }}
                                @else
                                    Loading Event...
                                @endif
                            </h3>
                            <p id="event-date" class="text-gray-400 mt-1">
                                @if(isset($event) && $event->date)
                                    {{ \Carbon\Carbon::parse($event->date)->format('l, F j, Y • g:i A') }}
                                @else
                                    Date TBA
                                @endif
                            </p>
                            <p id="event-venue" class="text-gray-400">
                                @if(isset($event) && $event->venue)
                                    {{ $event->venue->name }}
                                @else
                                    Venue TBA
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Attendee Information -->
                <div class="rounded-2xl bg-gray-800/50 backdrop-blur-sm border border-gray-700/50 p-6">
                    <h2 class="text-xl font-bold text-white mb-6">Attendee Information</h2>
                    <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST" class="space-y-6">
                        @csrf
                        <!-- Error Message Container -->
                        <div id="error-container" class="hidden rounded-lg bg-red-500/10 border border-red-500/20 p-4">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p id="error-message" class="text-red-400 font-medium"></p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="firstName" class="block text-sm font-medium text-gray-300 mb-2">First Name</label>
                                <input type="text" id="firstName" name="first_name" required
                                       class="w-full rounded-lg bg-gray-700/50 border border-gray-600/50 px-4 py-3 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 focus:outline-none transition-all"
                                       placeholder="Enter your first name">
                                <div id="firstName-error" class="hidden text-red-400 text-sm mt-1"></div>
                            </div>
                            <div>
                                <label for="lastName" class="block text-sm font-medium text-gray-300 mb-2">Last Name</label>
                                <input type="text" id="lastName" name="last_name" required
                                       class="w-full rounded-lg bg-gray-700/50 border border-gray-600/50 px-4 py-3 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 focus:outline-none transition-all"
                                       placeholder="Enter your last name">
                                <div id="lastName-error" class="hidden text-red-400 text-sm mt-1"></div>
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full rounded-lg bg-gray-700/50 border border-gray-600/50 px-4 py-3 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 focus:outline-none transition-all"
                                   placeholder="your.email@example.com">
                            <div id="email-error" class="hidden text-red-400 text-sm mt-1"></div>
                            <p class="text-sm text-gray-400 mt-2">Tickets will be sent to this email address</p>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-300 mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone"
                                   class="w-full rounded-lg bg-gray-700/50 border border-gray-600/50 px-4 py-3 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 focus:outline-none transition-all"
                                   placeholder="+1 (555) 123-4567">
                            <div id="phone-error" class="hidden text-red-400 text-sm mt-1"></div>
                            <p class="text-sm text-gray-400 mt-2">Required for M-Pesa payments</p>
                        </div>

                        <!-- Payment Method -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-white">Payment Method</h3>
                            <!-- M-Pesa Option -->
                            <label class="relative flex cursor-pointer items-center justify-between rounded-xl border-2 border-primary-500/50 bg-primary-500/10 p-4 transition-all hover:border-primary-500 hover:bg-primary-500/20">
                                <div class="flex items-center gap-4">
                                    <input type="radio"
                                           name="payment_method"
                                           value="mpesa"
                                           checked
                                           required
                                           form="checkout-form"
                                           class="h-5 w-5 text-primary-500 bg-transparent border-primary-500 focus:ring-primary-500 focus:ring-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-green-500/20 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-white">M-Pesa</p>
                                        <p class="text-sm text-gray-400">Pay with your mobile money</p>
                                    </div>
                                </div>
                            </div>
                            <span class="rounded-full bg-green-500/20 px-3 py-1 text-xs font-semibold text-green-400">
                                Recommended
                            </span>
                        </label>

                        <!-- Card Option -->
                        <label class="relative flex cursor-pointer items-center justify-between rounded-xl border-2 border-gray-600/30 bg-gray-700/20 p-4 transition-all hover:border-gray-500/50 hover:bg-gray-700/30">
                            <div class="flex items-center gap-4">
                                <input type="radio"
                                       name="payment_method"
                                       value="card"
                                       form="checkout-form"
                                       class="h-5 w-5 text-primary-500 bg-transparent border-gray-500 focus:ring-primary-500 focus:ring-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-blue-500/20 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-white">Credit/Debit Card</p>
                                        <p class="text-sm text-gray-400">Visa, Mastercard accepted</p>
                                    </div>
                                </div>
                            </div>
                        </label>

                        <!-- Cash Option -->
                        <label class="relative flex cursor-pointer items-center justify-between rounded-xl border-2 border-gray-600/30 bg-gray-700/20 p-4 transition-all hover:border-gray-500/50 hover:bg-gray-700/30">
                            <div class="flex items-center gap-4">
                                <input type="radio"
                                       name="payment_method"
                                       value="cash"
                                       form="checkout-form"
                                       class="h-5 w-5 text-primary-500 bg-transparent border-gray-500 focus:ring-primary-500 focus:ring-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-yellow-500/20 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-white">Pay at Venue</p>
                                        <p class="text-sm text-gray-400">Cash payment at event</p>
                                    </div>
                                </div>
                            </div>
                        </label>

                    </div>
                    </form>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="space-y-6">
                <div class="rounded-2xl bg-gray-800/50 backdrop-blur-sm border border-gray-700/50 p-6 sticky top-8">
                    <h2 class="text-xl font-bold text-white mb-6">Order Summary</h2>
                    
                    <!-- Selected Tickets -->
                    <div class="space-y-4">
                        @if(isset($validatedTickets) && count($validatedTickets) > 0)
                            @foreach($validatedTickets as $ticket)
                                <div class="flex justify-between items-center p-4 rounded-xl bg-gray-700/30 border border-gray-600/20">
                                    <div class="flex-1">
                                        <p class="font-semibold text-white text-lg">{{ $ticket['name'] }}</p>
                                        <p class="text-sm text-gray-400 mt-1">
                                            KES {{ number_format($ticket['price'], 2) }} × {{ $ticket['quantity'] }} ticket{{ $ticket['quantity'] > 1 ? 's' : '' }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-white text-xl">KES {{ number_format($ticket['total'], 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8">
                                <p class="text-gray-400 mb-4">No tickets selected</p>
                                <a href="{{ route('Browse') }}" class="text-primary-400 hover:text-primary-300 underline text-sm">
                                    ← Go back to select tickets
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Promo Code -->
                    <div class="border-t border-gray-700/50 pt-6 mb-6">
                        <label for="promo-code" class="block text-sm font-medium text-gray-300 mb-3">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Promo Code
                        </label>
                        <div class="flex gap-3">
                            <input type="text" id="promo-code" placeholder="Enter promo code"
                                   class="flex-1 rounded-lg bg-gray-700/50 border border-gray-600/50 px-4 py-2 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 focus:outline-none transition-all">
                            <button type="button" id="apply-promo"
                                    class="rounded-lg bg-primary-600 hover:bg-primary-700 px-4 py-2 text-sm font-medium text-white transition-colors">
                                Apply
                            </button>
                        </div>
                        <p id="promo-message" class="text-sm mt-2 hidden"></p>
                    </div>

                    <!-- Order Totals -->
                    <div class="border-t border-gray-700/50 pt-6 space-y-3">
                        <div class="flex justify-between text-gray-300">
                            <span>Subtotal</span>
                            <span>KES {{ number_format($totalAmount ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-xl font-bold text-white border-t border-gray-700/50 pt-3">
                            <span>Total</span>
                            <span>KES {{ number_format($totalAmount ?? 0, 2) }}</span>
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <button type="submit" form="checkout-form" id="checkout-btn"
                            class="w-full mt-6 rounded-xl bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-700 hover:to-primary-600 py-4 text-lg font-bold text-white transition-all duration-300 shadow-lg hover:shadow-xl hover:shadow-primary-500/25 transform hover:scale-[1.02] active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span id="checkout-text">Complete Purchase 
                                KES {{ number_format($totalAmount ?? 0, 2) }}
                            </span>
                        </span>
                    </button>

                    <!-- Status Messages -->
                    <div id="success-message" class="hidden mt-4 rounded-lg bg-green-500/10 border border-green-500/20 p-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <p id="success-text" class="text-green-400 text-sm font-medium"></p>
                        </div>
                    </div>

                    <div id="error-message-checkout" class="hidden mt-4 rounded-lg bg-red-500/10 border border-red-500/20 p-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p id="error-text-checkout" class="text-red-400 text-sm font-medium"></p>
                        </div>
                    </div>

                    <!-- Security Notice -->
                    <div class="mt-4 rounded-lg bg-green-500/10 border border-green-500/20 p-3">
                        <p class="text-sm text-green-400 text-center">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            Secure payment • Instant ticket delivery
                        </p>
                    </div>

                    <!-- Help Link -->
                    <p class="text-center text-sm text-gray-400 mt-4">
                        Need help? <a href="#" class="text-primary-400 hover:text-primary-300 underline">Contact Support</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simple form validation and submission handling
    const form = document.getElementById('checkout-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Let the form submit normally with CSRF token
            // Basic validation can be added here if needed
            const requiredFields = form.querySelectorAll('input[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('border-red-500');
                    isValid = false;
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            
            // Check payment method
            const paymentMethod = form.querySelector('input[name="payment_method"]:checked');
            if (!paymentMethod) {
                alert('Please select a payment method');
                e.preventDefault();
                return false;
            }
            
            if (!isValid) {
                alert('Please fill in all required fields');
                e.preventDefault();
                return false;
            }
            
            // Show loading state
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                const originalText = submitButton.textContent;
                submitButton.textContent = 'Processing...';
                submitButton.disabled = true;
            }
            
            // Form will submit normally with CSRF token
            return true;
        });
    }
});
</script>
@endsection
