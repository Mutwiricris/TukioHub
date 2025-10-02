@extends('layouts.app')

@section('head')
<script src="https://unpkg.com/lucide@latest"></script>
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
                <a href="{{ route('Browse') }}" class="text-primary-400 hover:text-primary-300 underline text-sm">Browse Events</a>
            </a>
            <a href="/account" class="text-xs text-gray-300 hover:text-white flex items-center gap-2">
                My Account <i data-lucide="user" class="h-4 w-4"></i>
            </a>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="mx-auto max-w-7xl px-4 py-8 sm:py-12">
        <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">My Tickets</h1>
        <p class="mt-2 text-gray-300">View your purchased tickets for upcoming and past events.</p>

        {{-- Status Filter Tabs --}}
        <div class="mt-8 border-b border-white/10">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <a href="{{ route('Tickets', ['status' => 'all']) }}" class="whitespace-nowrap border-b-2 {{ $status === 'all' ? 'border-primary-500 text-primary-400' : 'border-transparent text-gray-400 hover:border-gray-300 hover:text-white' }} px-1 py-3 text-sm font-medium transition-colors">
                    All <span class="ml-1 text-xs">({{ $statusCounts['all'] }})</span>
                </a>
                <a href="{{ route('Tickets', ['status' => 'upcoming']) }}" class="whitespace-nowrap border-b-2 {{ $status === 'upcoming' ? 'border-primary-500 text-primary-400' : 'border-transparent text-gray-400 hover:border-gray-300 hover:text-white' }} px-1 py-3 text-sm font-medium transition-colors">
                    Upcoming <span class="ml-1 text-xs">({{ $statusCounts['upcoming'] }})</span>
                </a>
                <a href="{{ route('Tickets', ['status' => 'scanned']) }}" class="whitespace-nowrap border-b-2 {{ $status === 'scanned' ? 'border-primary-500 text-primary-400' : 'border-transparent text-gray-400 hover:border-gray-300 hover:text-white' }} px-1 py-3 text-sm font-medium transition-colors">
                    Scanned <span class="ml-1 text-xs">({{ $statusCounts['scanned'] }})</span>
                </a>
                <a href="{{ route('Tickets', ['status' => 'not_scanned']) }}" class="whitespace-nowrap border-b-2 {{ $status === 'not_scanned' ? 'border-primary-500 text-primary-400' : 'border-transparent text-gray-400 hover:border-gray-300 hover:text-white' }} px-1 py-3 text-sm font-medium transition-colors">
                    Not Scanned <span class="ml-1 text-xs">({{ $statusCounts['not_scanned'] }})</span>
                </a>
                <a href="{{ route('Tickets', ['status' => 'expired']) }}" class="whitespace-nowrap border-b-2 {{ $status === 'expired' ? 'border-primary-500 text-primary-400' : 'border-transparent text-gray-400 hover:border-gray-300 hover:text-white' }} px-1 py-3 text-sm font-medium transition-colors">
                    Expired <span class="ml-1 text-xs">({{ $statusCounts['expired'] }})</span>
                </a>
            </nav>
        </div>

        {{-- Tickets Grid --}}
        <div class="mt-8">
            <div class="grid gap-6 md:grid-cols-2">
                
                @forelse($userTickets as $userTicket)
                    <div class="flex gap-4 rounded-2xl border border-white/10 bg-gray-800/50 p-4 shadow-lg">
                        <img src="{{ $userTicket->event->image_url ?? 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=400' }}" 
                             alt="Event cover" class="h-28 w-24 rounded-lg object-cover" />
                        <div class="flex-grow">
                            <p class="text-xs text-primary-400">
                                {{ $userTicket->event->date ? \Carbon\Carbon::parse($userTicket->event->date)->format('D, M j, Y @ g:i A') : 'Date TBA' }}
                            </p>
                            <h3 class="font-semibold text-white mt-1">{{ $userTicket->event->name }}</h3>
                            <p class="text-xs text-gray-400 mt-1">{{ $userTicket->event->venue->name ?? 'Venue TBA' }}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-xs text-gray-300">{{ $userTicket->quantity }}x {{ $userTicket->ticket->ticketType->name ?? 'Ticket' }}</span>
                                <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium 
                                    {{ $userTicket->status === 'confirmed' ? 'bg-green-500/10 text-green-400' : 'bg-amber-500/10 text-amber-400' }}">
                                    {{ ucfirst($userTicket->status) }}
                                </span>
                            </div>
                            <a href="/ticket/verify/{{ $userTicket->ticket_reference }}" 
                               class="mt-3 inline-block rounded-lg bg-primary-500 px-4 py-2 text-xs font-bold text-white transition hover:bg-primary-600">
                                View Ticket
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 col-span-full">
                        <i data-lucide="ticket" class="h-12 w-12 mx-auto text-gray-600"></i>
                        <h3 class="mt-2 text-sm font-medium text-gray-400">No Upcoming Tickets</h3>
                        <p class="mt-1 text-sm text-gray-500">You don't have any tickets for upcoming events.</p>
                        <a href="/Browse" class="mt-4 inline-block rounded-lg bg-primary-500 px-4 py-2 text-sm font-bold text-white transition hover:bg-primary-600">
                            Browse Events
                        </a>
                    </div>
                @endforelse
            </div>

            {{-- Past Tickets Panel --}}
            <div id="tab-panel-past" class="ticket-tab-panel hidden grid gap-6 md:grid-cols-2">
                @php
                    $pastTickets = $userTickets->filter(function($ticket) {
                        return $ticket->event->date <= now();
                    });
                @endphp
                
                @forelse($pastTickets as $userTicket)
                    <div class="flex gap-4 rounded-2xl border border-white/10 bg-gray-800/50 p-4 shadow-lg filter grayscale opacity-60">
                        <img src="{{ $userTicket->event->image_url ?? 'https://images.unsplash.com/photo-1524368535928-5b5e00ddc76b?q=80&w=400' }}" 
                             alt="Event cover" class="h-28 w-24 rounded-lg object-cover" />
                        <div class="flex-grow">
                            <p class="text-xs text-gray-400">
                                {{ $userTicket->event->date ? \Carbon\Carbon::parse($userTicket->event->date)->format('D, M j, Y @ g:i A') : 'Date TBA' }}
                            </p>
                            <h3 class="font-semibold text-gray-300 mt-1">{{ $userTicket->event->name }}</h3>
                            <p class="text-xs text-gray-500 mt-1">{{ $userTicket->event->venue->name ?? 'Venue TBA' }}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-xs text-gray-400">{{ $userTicket->ticket->ticketType->name ?? 'General Admission' }}</span>
                                <span class="text-xs text-primary-400">•</span>
                                <span class="text-xs text-gray-400">KES {{ number_format($userTicket->price, 0) }}</span>
                                <span class="text-xs text-primary-400">•</span>
                                <span class="text-xs {{ $userTicket->status_color }}">{{ $userTicket->status_label }}</span>
                            </div>
                            <div class="flex items-center gap-2 mt-3">
                                <a href="{{ route('confirmation.download', $userTicket->id) }}" 
                                   class="inline-flex items-center gap-1 rounded-lg bg-primary-500 px-3 py-1.5 text-xs font-medium text-white transition hover:bg-primary-600">
                                    <i data-lucide="download" class="h-3 w-3"></i>
                                    Download
                                </a>
                                <button class="inline-flex items-center gap-1 rounded-lg border border-gray-600 bg-transparent px-3 py-1.5 text-xs font-medium text-gray-300 transition hover:bg-gray-700">
                                    <i data-lucide="share-2" class="h-3 w-3"></i>
                                    Share
                                </button>
                                @if($userTicket->status === 'not_scanned')
                                <span class="inline-flex items-center gap-1 rounded-lg bg-blue-500/20 border border-blue-500/30 px-3 py-1.5 text-xs font-medium text-blue-400">
                                    <i data-lucide="clock" class="h-3 w-3"></i>
                                    Ready to Scan
                                </span>
                                @elseif($userTicket->status === 'scanned')
                                <span class="inline-flex items-center gap-1 rounded-lg bg-green-500/20 border border-green-500/30 px-3 py-1.5 text-xs font-medium text-green-400">
                                    <i data-lucide="check-circle" class="h-3 w-3"></i>
                                    Scanned {{ $userTicket->scanned_at ? $userTicket->scanned_at->format('M j, g:i A') : '' }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 col-span-full">
                        <i data-lucide="ticket-slash" class="h-12 w-12 mx-auto text-gray-600"></i>
                        <h3 class="mt-2 text-sm font-medium text-gray-400">No Past Tickets</h3>
                        <p class="mt-1 text-sm text-gray-500">You haven't attended any events yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();

    // --- Tab Switching Logic ---
    const tabContainer = document.getElementById('ticket-tabs');
    if (tabContainer) {
        const tabButtons = tabContainer.querySelectorAll('.ticket-tab');
        const tabPanels = document.querySelectorAll('.ticket-tab-panel');

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
            });
        });
    }
});
</script>
@endsection
