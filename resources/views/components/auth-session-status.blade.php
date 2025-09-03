@props([
    'status',
])

@if ($status)
    <div class="relative">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-500/10 to-primary-400/10 rounded-xl blur-lg"></div>
        <div {{ $attributes->merge(['class' => 'relative rounded-xl bg-primary-50 border border-primary-200 p-4 backdrop-blur-sm']) }}>
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-sm text-primary-700 font-medium">{{ $status }}</p>
            </div>
        </div>
    </div>
@endif
