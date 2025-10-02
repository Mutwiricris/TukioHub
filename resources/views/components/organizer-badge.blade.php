@props(['event'])

@php
    $organizerName = $event->organizer->name ?? 'TukioHub';
    $isVerified = $event->organizer->is_verified ?? true; // Default TukioHub as verified
    $organizerWebsite = $event->organizer->website ?? null;
@endphp

<div class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-blue-500/20 to-purple-500/20 px-3 py-1.5 text-sm font-medium text-blue-300 ring-1 ring-inset ring-blue-500/30 backdrop-blur-sm">
    <span class="text-gray-300">By</span>
    
    @if($organizerWebsite)
        <a href="{{ $organizerWebsite }}" target="_blank" class="hover:text-blue-200 transition-colors">
            {{ $organizerName }}
        </a>
    @else
        <span>{{ $organizerName }}</span>
    @endif
    
    @if($isVerified)
        <div class="flex items-center" title="Verified Organizer">
            <svg class="h-4 w-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.236 4.53L7.53 10.53a.75.75 0 00-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
            </svg>
        </div>
    @endif
</div>
