@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center">
    <!-- Logo -->
    <div class="flex justify-center mb-6">
        <div class="flex items-center space-x-2">
            <div class="w-10 h-10 bg-gradient-to-br from-primary-400 to-primary-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                </svg>
            </div>
            <span class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">TukioHub</span>
        </div>
    </div>
    
    <flux:heading size="xl" class="text-gray-800">{{ $title }}</flux:heading>
    <flux:subheading class="text-gray-600 mt-2">{{ $description }}</flux:subheading>
</div>
