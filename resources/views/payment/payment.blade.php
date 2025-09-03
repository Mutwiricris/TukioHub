@extends('layouts.app')

@section('head')
<script src="https://unpkg.com/lucide@latest"></script>
@endsection

@section('content')
<div class="bg-gray-900 text-white min-h-screen">
    {{-- Header --}}
    <header class="border-b border-white/10 bg-gray-900/80 backdrop-blur-lg sticky top-0 z-20">
        <div class="mx-auto flex max-w-7xl items-center justify-end px-4 py-4 mx-2">

            <div class="flex items-center gap-2 text-xs text-gray-300">
                <i data-lucide="shield-check" class="h-4 w-4 text-emerald-400"></i>
                Secure Checkout
            </div>
        </div>
    </header>

    {{-- Steps Indicator --}}
    <div class="bg-gray-800/50 border-b border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-3">
            <ol class="flex items-center justify-center gap-3 text-xs sm:gap-6">
                <li class="flex items-center gap-2 text-gray-400">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500 text-xs font-bold text-white">
                        <i data-lucide="check" class="h-4 w-4"></i>
                    </span>
                    <span class="font-medium">Details</span>
                </li>
                <li class="flex items-center gap-2">
                     <span class="flex h-6 w-6 items-center justify-center rounded-full bg-primary-500 text-xs font-bold text-white">2</span>
                    <span class="font-medium text-white">Payment</span>
                </li>
                <li class="flex items-center gap-2 text-gray-500">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-gray-700 text-xs font-bold">3</span>
                    <span class="font-medium">Confirmation</span>
                </li>
            </ol>
        </div>
    </div>

    {{-- Main Content --}}
    <section class="mx-auto max-w-7xl px-4 py-8 sm:py-12">
        <div class="grid gap-8 lg:grid-cols-3">

            {{-- Left Column: Payment Form --}}
            <div class="lg:col-span-2">
                <div class="rounded-2xl border border-white/10 bg-gray-500/10 p-4 sm:p-6 shadow-2xl backdrop-blur-lg">
                    <h2 class="text-lg font-semibold text-white">Choose Payment Method</h2>

                    {{-- Payment Tabs --}}
                    <div class="mt-4 border-b border-white/10">
                        <nav id="payment-tabs" class="-mb-px flex space-x-6" aria-label="Tabs">
                            <button class="payment-tab active whitespace-nowrap border-b-2 border-primary-500 text-primary-400 px-1 py-3 text-sm font-medium flex items-center gap-2" data-tab="mpesa">
                                <i data-lucide="smartphone" class="h-5 w-5"></i> M-Pesa
                            </button>
                            <button class="payment-tab whitespace-nowrap border-b-2 border-transparent px-1 py-3 text-sm font-medium text-gray-400 transition-colors hover:border-gray-300 hover:text-white flex items-center gap-2" data-tab="card">
                                <i data-lucide="credit-card" class="h-5 w-5"></i> Card
                            </button>
                            <button class="payment-tab whitespace-nowrap border-b-2 border-transparent px-1 py-3 text-sm font-medium text-gray-400 transition-colors hover:border-gray-300 hover:text-white flex items-center gap-2" data-tab="bank_transfer">
                                <i data-lucide="building-2" class="h-5 w-5"></i> Bank Transfer
                            </button>
                            <button class="payment-tab whitespace-nowrap border-b-2 border-transparent px-1 py-3 text-sm font-medium text-gray-400 transition-colors hover:border-gray-300 hover:text-white flex items-center gap-2" data-tab="cash">
                                <i data-lucide="banknote" class="h-5 w-5"></i> Cash
                            </button>
                        </nav>
                    </div>

                    {{-- Tab Panels --}}
                    <div class="mt-6">
                        {{-- M-Pesa Panel --}}
                        <div id="tab-panel-mpesa" class="payment-tab-panel">
                            <p class="text-sm text-gray-300">Enter your M-Pesa registered phone number. You will receive an STK push to complete the payment.</p>
                            <div class="mt-4">
                                <label for="phone" class="text-xs font-medium text-gray-300">Phone Number</label>
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <span class="text-gray-400 sm:text-sm">+254</span>
                                    </div>
                                    <input id="phone" name="phone" type="tel" class="w-full rounded-lg border border-white/10 bg-white/5 pl-14 pr-3 py-2 text-sm text-white placeholder-gray-400 focus:border-primary-500 focus:ring-1 focus:ring-primary-500" placeholder="712 345 678" />
                                </div>
                            </div>
                        </div>

                        {{-- Card Panel --}}
                        <div id="tab-panel-card" class="payment-tab-panel hidden">
                             <p class="text-sm text-gray-300">Enter your Visa or Mastercard details below.</p>
                             <div class="mt-4 space-y-4">
                                <div>
                                    <label for="card-number" class="text-xs font-medium text-gray-300">Card Number</label>
                                    <input id="card-number" class="mt-1 w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm text-white placeholder-gray-400 focus:border-primary-500 focus:ring-1 focus:ring-primary-500" placeholder="0000 0000 0000 0000" />
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="expiry-date" class="text-xs font-medium text-gray-300">Expiry Date</label>
                                        <input id="expiry-date" class="mt-1 w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm text-white placeholder-gray-400 focus:border-primary-500 focus:ring-1 focus:ring-primary-500" placeholder="MM / YY" />
                                    </div>
                                    <div>
                                        <label for="cvc" class="text-xs font-medium text-gray-300">CVC</label>
                                        <input id="cvc" class="mt-1 w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm text-white placeholder-gray-400 focus:border-primary-500 focus:ring-1 focus:ring-primary-500" placeholder="123" />
                                    </div>
                                </div>
                             </div>
                        </div>

                        {{-- Bank Transfer Panel --}}
                        <div id="tab-panel-bank_transfer" class="payment-tab-panel hidden">
                            <div class="bg-blue-500/10 border border-blue-500/20 rounded-lg p-4 mb-4">
                                <div class="flex items-center gap-2 text-blue-400 mb-2">
                                    <i data-lucide="info" class="h-4 w-4"></i>
                                    <span class="text-sm font-medium">Bank Transfer Instructions</span>
                                </div>
                                <p class="text-sm text-gray-300">
                                    Your tickets will be reserved for 48 hours. Transfer the exact amount to our bank account and upload proof of payment.
                                </p>
                            </div>
                            
                            <div class="space-y-4">
                                <div class="bg-gray-700/30 rounded-lg p-4">
                                    <h4 class="text-sm font-medium text-white mb-3">Bank Details:</h4>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-gray-400">Bank Name:</span>
                                            <span class="text-white font-mono">Equity Bank Kenya</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-400">Account Name:</span>
                                            <span class="text-white font-mono">TukioHub Limited</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-400">Account Number:</span>
                                            <span class="text-white font-mono">1234567890</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-400">Reference:</span>
                                            <span class="text-primary-400 font-mono" id="bank-reference">Will be generated</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="payment-proof" class="text-xs font-medium text-gray-300">Upload Payment Proof (Optional)</label>
                                    <input id="payment-proof" type="file" accept="image/*,.pdf" class="mt-1 w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm text-white file:mr-4 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-primary-500 file:text-white hover:file:bg-primary-600" />
                                </div>
                            </div>
                        </div>

                        {{-- Cash Panel --}}
                        <div id="tab-panel-cash" class="payment-tab-panel hidden">
                            <div class="bg-amber-500/10 border border-amber-500/20 rounded-lg p-4 mb-4">
                                <div class="flex items-center gap-2 text-amber-400 mb-2">
                                    <i data-lucide="info" class="h-4 w-4"></i>
                                    <span class="text-sm font-medium">Cash Payment Instructions</span>
                                </div>
                                <p class="text-sm text-gray-300">
                                    Your tickets will be reserved for 24 hours. Please visit our office or authorized agent to complete payment with cash.
                                </p>
                            </div>
                            
                            <div class="space-y-4">
                                <div class="bg-gray-700/30 rounded-lg p-4">
                                    <h4 class="text-sm font-medium text-white mb-2">Payment Locations:</h4>
                                    <div class="space-y-2 text-sm text-gray-300">
                                        <div class="flex items-start gap-2">
                                            <i data-lucide="map-pin" class="h-4 w-4 mt-0.5 text-primary-400"></i>
                                            <div>
                                                <p class="font-medium">TukioHub Main Office</p>
                                                <p class="text-xs">Westlands, Nairobi - Mon-Fri 9AM-6PM</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-2">
                                            <i data-lucide="map-pin" class="h-4 w-4 mt-0.5 text-primary-400"></i>
                                            <div>
                                                <p class="font-medium">Sarit Centre Outlet</p>
                                                <p class="text-xs">Sarit Centre, Westlands - Daily 10AM-8PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-700/30 rounded-lg p-4">
                                    <h4 class="text-sm font-medium text-white mb-2">What to bring:</h4>
                                    <ul class="space-y-1 text-sm text-gray-300">
                                        <li class="flex items-center gap-2">
                                            <i data-lucide="check" class="h-3 w-3 text-green-400"></i>
                                            Your reservation reference number
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <i data-lucide="check" class="h-3 w-3 text-green-400"></i>
                                            Valid ID (National ID or Passport)
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <i data-lucide="check" class="h-3 w-3 text-green-400"></i>
                                            Exact cash amount
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button id="pay-button" class="mt-8 w-full rounded-lg bg-primary-500 px-4 py-3 text-sm font-bold text-white transition hover:bg-primary-600 disabled:opacity-50 disabled:cursor-not-allowed" type="button">
                        <span id="pay-button-text">Pay</span> <span id="pay-amount">KES {{ $orderTotal ? number_format($orderTotal, 0) : '0' }}</span>
                    </button>
                </div>
            </div>

            {{-- Right Column: Order Summary --}}
            <aside>
                <div class="sticky top-28 space-y-6">
                    <div class="rounded-2xl border border-white/10 bg-gray-500/10 p-4 sm:p-6 shadow-2xl backdrop-blur-lg">
                        <h2 class="text-lg font-semibold text-white">Order Summary</h2>
                        <div class="mt-4 space-y-4 text-sm">
                            <div class="flex items-center gap-4">
                                @if($event)
                                <img src="{{ $event->image_url ?? 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=400' }}" alt="Event cover" class="h-16 w-24 rounded-lg object-cover" />
                                <div>
                                    <p class="font-medium text-white">{{ $event->name }}</p>
                                    <p class="text-xs text-gray-400">
                                        @if($event->date)
                                            {{ \Carbon\Carbon::parse($event->date)->format('D, M j, Y • g:i A') }}
                                        @else
                                            Date TBA
                                        @endif
                                        @if($event->venue)
                                            • {{ $event->venue->name }}
                                        @endif
                                    </p>
                                </div>
                                @else
                                <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=400" alt="Event cover" class="h-16 w-24 rounded-lg object-cover" />
                                <div>
                                    <p class="font-medium text-white">Event Details</p>
                                    <p class="text-xs text-gray-400">Please select an event</p>
                                </div>
                                @endif
                            </div>
                            <div id="order-items" class="space-y-2 border-t border-white/10 pt-4">
                                @if($event && $validatedTickets && count($validatedTickets) > 0)
                                    @foreach($validatedTickets as $selectedTicket)
                                        @php
                                            $ticket = $event->tickets->find($selectedTicket['id']);
                                        @endphp
                                        @if($ticket)
                                        <div class="order-item flex justify-between text-gray-200" data-quantity="{{ $selectedTicket['quantity'] }}" data-price="{{ $ticket->price }}">
                                            <span>{{ $ticket->ticketType->name ?? 'General Admission' }} × {{ $selectedTicket['quantity'] }}</span>
                                            <span>KES {{ number_format($ticket->price * $selectedTicket['quantity'], 0) }}</span>
                                        </div>
                                        @endif
                                    @endforeach
                                @else
                                <div class="order-item flex justify-between text-gray-200" data-quantity="1" data-price="3500">
                                    <span>Sample Ticket × 1</span>
                                    <span>KES 3,500</span>
                                </div>
                                @endif
                                <div class="flex justify-between text-gray-400">
                                    <span>Service fees</span>
                                    <span id="service-fee">KES 0</span>
                                </div>
                            </div>
                             <div id="discount-line" class="hidden justify-between text-emerald-400">
                                <span>Discount (SAVE10)</span>
                                <span id="discount-amount">-KES 0</span>
                            </div>
                            <div class="border-t border-white/10 pt-2 font-semibold text-white">
                                <div class="flex justify-between">
                                    <span>Total</span>
                                    <span id="total-amount">KES {{ $orderTotal ? number_format($orderTotal, 0) : '0' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();

    const orderItemsContainer = document.getElementById('order-items');
    const serviceFeeEl = document.getElementById('service-fee');
    const totalAmountEl = document.getElementById('total-amount');
    const payButton = document.getElementById('pay-button');
    const discountLineEl = document.getElementById('discount-line');
    const discountAmountEl = document.getElementById('discount-amount');

    const SERVICE_FEE_PERCENTAGE = 0.05;
    
    // Get data from server
    const orderTotal = @json($orderTotal ?? 0);
    const promoCodeApplied = @json(session('checkout_promo'));
    
    const formatCurrency = (amount) => `KES ${amount.toLocaleString()}`;

    const updateOrderSummary = () => {
        const validatedTickets = @json($validatedTickets ?? []);
        
        if (validatedTickets.length > 0) {
            orderItemsContainer.innerHTML = '';
            validatedTickets.forEach(item => {
                const orderItem = document.createElement('div');
                orderItem.className = 'order-item flex justify-between text-gray-200';
                orderItem.dataset.quantity = item.quantity;
                orderItem.innerHTML = `
                    <span>${item.name} × ${item.quantity}</span>
                    <span>${formatCurrency(item.total)}</span>
                `;
                orderItemsContainer.appendChild(orderItem);
            });
            
            const subtotal = validatedTickets.reduce((sum, item) => sum + item.total, 0);
            const serviceFee = subtotal * SERVICE_FEE_PERCENTAGE;
            const total = subtotal + serviceFee;
            
            serviceFeeEl.textContent = formatCurrency(serviceFee);
            totalAmountEl.textContent = formatCurrency(orderTotal > 0 ? orderTotal : total);
            document.getElementById('pay-amount').textContent = formatCurrency(orderTotal > 0 ? orderTotal : total);
        }
    };

    const calculateTotals = () => {
        let subtotal = 0;
        orderItemsContainer.querySelectorAll('.order-item').forEach(item => {
            subtotal += (parseFloat(item.dataset.price) || 0) * (parseInt(item.dataset.quantity) || 0);
        });

        const serviceFee = subtotal * SERVICE_FEE_PERCENTAGE;
        let total = subtotal + serviceFee;

        if (promoCodeApplied === 'SAVE10') {
            const discount = total * 0.10;
            total -= discount;
            discountAmountEl.textContent = `-${formatCurrency(discount)}`;
            discountLineEl.classList.remove('hidden');
            discountLineEl.classList.add('flex');
        } else {
            discountLineEl.classList.add('hidden');
            discountLineEl.classList.remove('flex');
        }

        // Use order total from server if available, otherwise calculate
        const finalTotal = orderTotal > 0 ? orderTotal : total;

        serviceFeeEl.textContent = formatCurrency(serviceFee);
        totalAmountEl.textContent = formatCurrency(finalTotal);
        document.getElementById('pay-amount').textContent = formatCurrency(finalTotal);
    };

    // --- Tab Switching Logic ---
    const tabContainer = document.getElementById('payment-tabs');
    if (tabContainer) {
        const tabButtons = tabContainer.querySelectorAll('.payment-tab');
        const tabPanels = document.querySelectorAll('.payment-tab-panel');
        const payButtonText = document.getElementById('pay-button-text');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const tabName = button.dataset.tab;

                tabButtons.forEach(btn => {
                    btn.classList.remove('active', 'border-primary-500', 'text-primary-400');
                    btn.classList.add('border-transparent', 'text-gray-400');
                });

                button.classList.add('active', 'border-primary-500', 'text-primary-400');
                button.classList.remove('border-transparent', 'text-gray-400');

                tabPanels.forEach(panel => {
                    panel.classList.toggle('hidden', panel.id !== `tab-panel-${tabName}`);
                });

                // Update button text based on payment method
                if (tabName === 'cash') {
                    payButtonText.textContent = 'Reserve Tickets for';
                } else if (tabName === 'bank_transfer') {
                    payButtonText.textContent = 'Reserve & Get Bank Details for';
                } else {
                    payButtonText.textContent = 'Pay';
                }
                
                // Update bank reference for bank transfer
                if (tabName === 'bank_transfer') {
                    const bankReference = document.getElementById('bank-reference');
                    if (bankReference) {
                        bankReference.textContent = 'BT-' + Math.random().toString(36).substr(2, 9).toUpperCase();
                    }
                }
            });
        });
    }

    // Payment button functionality
    payButton.addEventListener('click', function() {
        const activeTab = document.querySelector('.payment-tab.active');
        const paymentMethod = activeTab ? activeTab.dataset.tab : 'mpesa';
        
        // Validate payment method specific fields
        if (paymentMethod === 'mpesa') {
            const phoneInput = document.getElementById('phone');
            if (!phoneInput.value.trim()) {
                alert('Please enter your M-Pesa phone number');
                phoneInput.focus();
                return;
            }
        } else if (paymentMethod === 'card') {
            const cardNumber = document.getElementById('card-number');
            const expiryDate = document.getElementById('expiry-date');
            const cvc = document.getElementById('cvc');
            
            if (!cardNumber.value.trim() || !expiryDate.value.trim() || !cvc.value.trim()) {
                alert('Please fill in all card details');
                return;
            }
        } else if (paymentMethod === 'bank_transfer') {
            // No validation needed for bank transfer - just proceed to reservation
        } else if (paymentMethod === 'cash') {
            // No validation needed for cash - just proceed to reservation
        }
        
        // Show loading state
        this.disabled = true;
        let loadingText = 'Processing Payment...';
        if (paymentMethod === 'cash') {
            loadingText = 'Creating Reservation...';
        } else if (paymentMethod === 'bank_transfer') {
            loadingText = 'Creating Reservation...';
        }
        this.innerHTML = `
            <div class="flex items-center justify-center gap-2">
                <div class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
                ${loadingText}
            </div>
        `;
        
        // Prepare payment data - no need for URL params as data is in session
        const paymentData = {
            payment_method: paymentMethod,
            amount: orderTotal > 0 ? orderTotal : calculateSubtotal(),
            phone_number: paymentMethod === 'mpesa' ? document.getElementById('phone')?.value : null
        };
        
        // Create form and submit to payment processing
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/payment';
        
        // Add CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        form.appendChild(csrfInput);
        
        // Add payment method and phone number
        const paymentMethodInput = document.createElement('input');
        paymentMethodInput.type = 'hidden';
        paymentMethodInput.name = 'payment_method';
        paymentMethodInput.value = paymentMethod;
        form.appendChild(paymentMethodInput);
        
        if (paymentMethod === 'mpesa') {
            const phoneInput = document.createElement('input');
            phoneInput.type = 'hidden';
            phoneInput.name = 'phone_number';
            phoneInput.value = document.getElementById('phone')?.value || '';
            form.appendChild(phoneInput);
        }
        
        document.body.appendChild(form);
        form.submit();
    });
    
    function calculateSubtotal() {
        let subtotal = 0;
        orderItemsContainer.querySelectorAll('.order-item').forEach(item => {
            subtotal += (parseFloat(item.dataset.price) || 0) * (parseInt(item.dataset.quantity) || 0);
        });
        return subtotal;
    }

    // Initialize on page load
    updateOrderSummary();
    calculateTotals();
});
</script>
@endsection
