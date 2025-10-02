@if(config('app.debug') && $cacheEnabled ?? false)
<div class="fixed bottom-4 right-4 z-50 bg-green-500/90 text-white px-3 py-1 rounded-lg text-xs font-mono backdrop-blur-sm">
    <div class="flex items-center gap-2">
        <div class="w-2 h-2 bg-green-300 rounded-full animate-pulse"></div>
        Redis Cache Active
    </div>
</div>
@endif
