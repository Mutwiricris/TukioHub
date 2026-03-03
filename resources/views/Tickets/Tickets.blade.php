@extends('layouts.app')

@section('head')
<script src="https://unpkg.com/lucide@latest"></script>
@endsection

@section('content')
<div class="bg-gray-900 text-white min-h-screen">
    {{-- Enhanced Main Content --}}
    <main class="mx-auto max-w-7xl px-4 py-12 sm:py-16">
        <!-- Enhanced Page Header -->
        <div class="mb-12">
            <div class="flex items-center gap-4 mb-6">
                <div class="p-3 rounded-2xl bg-gradient-to-br from-primary-500/20 to-emerald-500/20 border border-primary-500/30">
                    <svg class="w-8 h-8 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-white">My Tickets</h1>
                    <p class="mt-2 text-lg text-gray-400">View and manage your purchased tickets</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('Browse') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary-500/10 border border-primary-500/30 text-primary-400 font-medium hover:bg-primary-500/20 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Browse Events
                </a>
            </div>
        </div>

        {{-- Enhanced Status Filter Tabs --}}
        <div class="mb-10">
            <div class="rounded-2xl bg-gradient-to-br from-gray-800/60 to-gray-800/40 border border-gray-700/50 backdrop-blur-md shadow-xl p-1.5">
                <nav class="flex flex-wrap gap-2" aria-label="Tabs">
                    <a href="{{ route('Tickets', ['status' => 'all']) }}" class="flex-1 min-w-[120px] text-center whitespace-nowrap rounded-xl {{ $status === 'all' ? 'bg-gradient-to-r from-primary-500 to-emerald-500 text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-white/5' }} px-4 py-3 text-sm font-bold transition-all">
                        All <span class="ml-1 px-2 py-0.5 rounded-full {{ $status === 'all' ? 'bg-white/20' : 'bg-gray-700/50' }} text-xs">({{ $statusCounts['all'] }})</span>
                    </a>
                    <a href="{{ route('Tickets', ['status' => 'upcoming']) }}" class="flex-1 min-w-[120px] text-center whitespace-nowrap rounded-xl {{ $status === 'upcoming' ? 'bg-gradient-to-r from-primary-500 to-emerald-500 text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-white/5' }} px-4 py-3 text-sm font-bold transition-all">
                        Upcoming <span class="ml-1 px-2 py-0.5 rounded-full {{ $status === 'upcoming' ? 'bg-white/20' : 'bg-gray-700/50' }} text-xs">({{ $statusCounts['upcoming'] }})</span>
                    </a>
                    <a href="{{ route('Tickets', ['status' => 'scanned']) }}" class="flex-1 min-w-[120px] text-center whitespace-nowrap rounded-xl {{ $status === 'scanned' ? 'bg-gradient-to-r from-primary-500 to-emerald-500 text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-white/5' }} px-4 py-3 text-sm font-bold transition-all">
                        Scanned <span class="ml-1 px-2 py-0.5 rounded-full {{ $status === 'scanned' ? 'bg-white/20' : 'bg-gray-700/50' }} text-xs">({{ $statusCounts['scanned'] }})</span>
                    </a>
                    <a href="{{ route('Tickets', ['status' => 'not_scanned']) }}" class="flex-1 min-w-[120px] text-center whitespace-nowrap rounded-xl {{ $status === 'not_scanned' ? 'bg-gradient-to-r from-primary-500 to-emerald-500 text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-white/5' }} px-4 py-3 text-sm font-bold transition-all">
                        Not Scanned <span class="ml-1 px-2 py-0.5 rounded-full {{ $status === 'not_scanned' ? 'bg-white/20' : 'bg-gray-700/50' }} text-xs">({{ $statusCounts['not_scanned'] }})</span>
                    </a>
                    <a href="{{ route('Tickets', ['status' => 'expired']) }}" class="flex-1 min-w-[120px] text-center whitespace-nowrap rounded-xl {{ $status === 'expired' ? 'bg-gradient-to-r from-primary-500 to-emerald-500 text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-white/5' }} px-4 py-3 text-sm font-bold transition-all">
                        Expired <span class="ml-1 px-2 py-0.5 rounded-full {{ $status === 'expired' ? 'bg-white/20' : 'bg-gray-700/50' }} text-xs">({{ $statusCounts['expired'] }})</span>
                    </a>
                </nav>
            </div>
        </div>

        {{-- Tickets Grid --}}
        <div class="mt-8">
            <div class="grid gap-6 md:grid-cols-2">

                @forelse($userTickets as $userTicket)
                    <div class="group flex gap-5 rounded-2xl border border-gray-700/50 bg-gradient-to-br from-gray-800/60 to-gray-800/40 p-6 shadow-2xl backdrop-blur-md hover:shadow-primary-500/10 hover:border-primary-500/30 transition-all duration-300">
                        <div class="relative flex-shrink-0">
                            <img src="{{ $userTicket->event->image_url ?? 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=400' }}"
                                 alt="Event cover" class="h-32 w-28 rounded-xl object-cover border-2 border-gray-700/50 shadow-lg" />
                            <div class="absolute -top-2 -right-2 p-1.5 rounded-lg bg-gradient-to-br from-primary-500 to-emerald-500 shadow-lg border border-white/10">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-grow min-w-0">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <p class="text-xs font-bold text-primary-400 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $userTicket->event->start_date ? $userTicket->event->start_date->format('D, M j, Y @ g:i A') : 'Date TBA' }}
                                </p>
                            </div>
                            <h3 class="font-bold text-white text-lg mb-1.5 line-clamp-1 group-hover:text-primary-400 transition-colors">{{ $userTicket->event->name }}</h3>
                            <p class="text-sm text-gray-400 mb-3 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $userTicket->event->venue->name ?? 'Venue TBA' }}
                            </p>
                            <div class="flex items-center gap-2 mb-4 flex-wrap">
                                <span class="inline-flex items-center gap-1.5 text-sm text-gray-300 bg-gray-700/50 px-3 py-1 rounded-lg border border-gray-600/50">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    1x {{ $userTicket->ticket->ticketType->name ?? 'Ticket' }}
                                </span>
                                <span class="inline-flex items-center gap-1.5 rounded-lg px-3 py-1 text-sm font-bold border
                                    {{ $userTicket->status === 'confirmed' ? 'bg-green-500/20 border-green-500/30 text-green-400' : 'bg-amber-500/20 border-amber-500/30 text-amber-400' }}">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ ucfirst($userTicket->status) }}
                                </span>
                            </div>
                            <a href="{{ route('user.tickets.show', $userTicket) }}"
                               class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-emerald-500 px-5 py-2.5 text-sm font-bold text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                View Ticket
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="text-center py-16 rounded-2xl border border-gray-700/50 bg-gradient-to-br from-gray-800/40 to-gray-800/20 backdrop-blur-sm">
                            <div class="inline-flex items-center justify-center h-20 w-20 rounded-2xl bg-gradient-to-br from-gray-700/50 to-gray-800/50 border border-gray-600/50 mb-6">
                                <i data-lucide="ticket" class="h-10 w-10 text-gray-500"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-300 mb-2">No Tickets Found</h3>
                            <p class="text-sm text-gray-500 mb-6 max-w-md mx-auto">You don't have any tickets matching this filter. Start exploring events to get your first ticket!</p>
                            <a href="/Browse" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-emerald-500 px-6 py-3 text-sm font-bold text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Browse Events
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Past Tickets Panel --}}
            <div id="tab-panel-past" class="ticket-tab-panel hidden grid gap-6 md:grid-cols-2">
                @php
                    $pastTickets = $userTickets->filter(function($ticket) {
                        return $ticket->event->start_date <= now();
                    });
                @endphp

                @forelse($pastTickets as $userTicket)
                    <div class="group flex gap-5 rounded-2xl border border-gray-700/50 bg-gradient-to-br from-gray-800/60 to-gray-800/40 p-6 shadow-2xl backdrop-blur-md hover:shadow-primary-500/10 hover:border-primary-500/30 transition-all duration-300">
                        <div class="relative flex-shrink-0">
                            <img src="{{ $userTicket->event->image_url ?? 'https://images.unsplash.com/photo-1524368535928-5b5e00ddc76b?q=80&w=400' }}"
                                 alt="Event cover" class="h-32 w-28 rounded-xl object-cover border-2 border-gray-700/50 shadow-lg filter grayscale opacity-60" />
                            <div class="absolute -top-2 -right-2 p-1.5 rounded-lg bg-gray-600/80 shadow-lg border border-gray-500/30">
                                <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-grow min-w-0">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <p class="text-xs font-bold text-gray-500 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $userTicket->event->start_date ? $userTicket->event->start_date->format('D, M j, Y @ g:i A') : 'Date TBA' }}
                                </p>
                            </div>
                            <h3 class="font-bold text-gray-300 text-lg mb-1.5 line-clamp-1">{{ $userTicket->event->name }}</h3>
                            <p class="text-sm text-gray-500 mb-3 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $userTicket->event->venue->name ?? 'Venue TBA' }}
                            </p>
                            <div class="flex items-center gap-2 mb-4 flex-wrap">
                                <span class="inline-flex items-center gap-1.5 text-sm text-gray-400 bg-gray-700/50 px-3 py-1 rounded-lg border border-gray-600/50">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    {{ $userTicket->ticket->ticketType->name ?? 'General Admission' }}
                                </span>
                                <span class="inline-flex items-center gap-1.5 text-sm text-gray-400 bg-gray-700/50 px-3 py-1 rounded-lg border border-gray-600/50">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    KES {{ number_format($userTicket->price, 0) }}
                                </span>
                                @if($userTicket->status === 'not_scanned')
                                <span class="inline-flex items-center gap-1.5 rounded-lg px-3 py-1 text-sm font-bold bg-blue-500/20 border border-blue-500/30 text-blue-400">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Ready to Scan
                                </span>
                                @elseif($userTicket->status === 'scanned')
                                <span class="inline-flex items-center gap-1.5 rounded-lg px-3 py-1 text-sm font-bold bg-green-500/20 border border-green-500/30 text-green-400">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Scanned {{ $userTicket->scanned_at ? $userTicket->scanned_at->format('M j, g:i A') : '' }}
                                </span>
                                @endif
                            </div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <a href="{{ route('confirmation.download', $userTicket->id) }}"
                                   class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-emerald-500 px-4 py-2 text-sm font-bold text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    Download
                                </a>
                                <button class="inline-flex items-center gap-2 rounded-xl border border-gray-600/50 bg-gray-700/30 px-4 py-2 text-sm font-bold text-gray-300 hover:bg-gray-700/50 hover:border-gray-500/50 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                    </svg>
                                    Share
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="text-center py-16 rounded-2xl border border-gray-700/50 bg-gradient-to-br from-gray-800/40 to-gray-800/20 backdrop-blur-sm">
                            <div class="inline-flex items-center justify-center h-20 w-20 rounded-2xl bg-gradient-to-br from-gray-700/50 to-gray-800/50 border border-gray-600/50 mb-6">
                                <i data-lucide="ticket-slash" class="h-10 w-10 text-gray-500"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-300 mb-2">No Past Tickets</h3>
                            <p class="text-sm text-gray-500 mb-6 max-w-md mx-auto">You haven't attended any events yet. Your past tickets will appear here after events conclude.</p>
                        </div>
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
