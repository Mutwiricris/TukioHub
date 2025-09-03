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
            </a>
            <div class="text-xs text-gray-300">
                Ticket Verification
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="mx-auto max-w-2xl px-4 py-8 sm:py-12">
        <div class="text-center mb-8">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-emerald-500/10 mb-4">
                <i data-lucide="check-circle-2" class="h-10 w-10 text-emerald-400"></i>
            </div>
            <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Valid Ticket</h1>
            <p class="mt-2 text-gray-300">This ticket has been verified successfully</p>
        </div>

        {{-- Ticket Display --}}
        <div class="rounded-2xl border-2 border-dashed border-gray-600/50 bg-gray-800/30 p-1 shadow-2xl backdrop-blur-lg relative overflow-hidden">
            <!-- Ticket perforations -->
            <div class="absolute -top-4 left-1/2 -ml-4 h-8 w-8 rounded-full bg-gray-900"></div>
            <div class="absolute -bottom-4 left-1/2 -ml-4 h-8 w-8 rounded-full bg-gray-900"></div>
            
            <!-- Side perforations -->
            <div class="absolute -left-2 top-1/4 h-4 w-4 rounded-full bg-gray-900"></div>
            <div class="absolute -right-2 top-1/4 h-4 w-4 rounded-full bg-gray-900"></div>
            <div class="absolute -left-2 top-3/4 h-4 w-4 rounded-full bg-gray-900"></div>
            <div class="absolute -right-2 top-3/4 h-4 w-4 rounded-full bg-gray-900"></div>
            
            <div class="rounded-xl bg-gradient-to-br from-gray-800/80 to-gray-900/80 p-6 border border-gray-700/30">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-white mb-2">{{ $ticketData['event']['name'] }}</h2>
                    <p class="text-primary-400 font-medium">Event Details</p>
                </div>
                
                <div class="space-y-4 text-sm">
                    <div class="flex items-center gap-3 text-gray-300">
                        <i data-lucide="calendar" class="h-5 w-5 text-gray-400 flex-shrink-0"></i> 
                        <div class="flex-1">
                            <span class="text-gray-400 block">Event Date</span>
                            <p class="text-white font-medium text-lg">{{ $ticketData['event']['date'] }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 text-gray-300">
                        <i data-lucide="clock" class="h-5 w-5 text-gray-400 flex-shrink-0"></i> 
                        <div class="flex-1">
                            <span class="text-gray-400 block">Event Time</span>
                            <p class="text-white font-medium text-lg">{{ $ticketData['event']['time'] }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 text-gray-300">
                        <i data-lucide="map-pin" class="h-5 w-5 text-gray-400 flex-shrink-0"></i> 
                        <div class="flex-1">
                            <span class="text-gray-400 block">Venue</span>
                            <p class="text-white font-medium text-lg">{{ $ticketData['event']['venue'] }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 border-t border-dashed border-gray-600/50 pt-6">
                    <div class="bg-gray-700/20 rounded-lg p-4 mb-4">
                        <p class="text-xs text-gray-400 mb-3 font-medium">Tickets Reserved:</p>
                        <div class="space-y-2 text-sm font-medium text-white">
                            @foreach($ticketData['tickets'] as $ticket)
                                <div class="flex justify-between items-center">
                                    <span>{{ $ticket['quantity'] }} × {{ $ticket['name'] }}</span>
                                    <span class="text-primary-400">KES {{ number_format($ticket['price'], 0) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="bg-primary-500/10 border border-primary-500/20 rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-300 font-medium">Total Amount:</span>
                            <span class="text-xl font-bold text-primary-400">KES {{ number_format($ticketData['total_amount'], 0) }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 border-t border-dashed border-gray-600/50 pt-4 text-center">
                    <p class="text-xs text-gray-400 mb-2 font-medium">Ticket ID</p>
                    <p class="text-sm text-white font-mono bg-gray-700/30 rounded px-3 py-2 inline-block">{{ $ticketData['ticket_id'] }}</p>
                </div>
            </div>
        </div>

        {{-- Status Info --}}
        <div class="mt-8 text-center">
            <div class="bg-emerald-500/10 border border-emerald-500/20 rounded-lg p-4 mb-6">
                <div class="flex items-center justify-center gap-2 text-emerald-400 mb-2">
                    <i data-lucide="shield-check" class="h-5 w-5"></i>
                    <span class="font-semibold">Verified Ticket</span>
                </div>
                <p class="text-sm text-gray-300">This ticket is valid and ready for entry</p>
            </div>
            
            <a href="/" class="inline-block rounded-lg bg-primary-500 px-6 py-3 text-sm font-bold text-white transition hover:bg-primary-600">
                Back to Home
            </a>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();
});
</script>
@endsection
