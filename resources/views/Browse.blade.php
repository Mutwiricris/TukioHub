@extends('layouts.app')
@section('content')
{{-- Include Authentication Modal --}}
@include('components.auth-modal')
<style>
    /* Enhanced Search Autocomplete */
    .search-dropdown {
        max-height: 300px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: rgba(59, 130, 246, 0.5) transparent;
    }

    .search-dropdown::-webkit-scrollbar {
        width: 6px;
    }

    .search-dropdown::-webkit-scrollbar-track {
        background: transparent;
    }

    .search-dropdown::-webkit-scrollbar-thumb {
        background-color: rgba(59, 130, 246, 0.5);
        border-radius: 3px;
    }

    /* Filter animations */
    .filter-tag {
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Price range slider */
    .price-slider {
        -webkit-appearance: none;
        appearance: none;
        height: 6px;
        border-radius: 3px;
        background: linear-gradient(to right, #10b981 0%, #10b981 var(--value), #374151 var(--value), #374151 100%);
        outline: none;
    }

    .price-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #10b981;
        cursor: pointer;
        border: 2px solid #fff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    .price-slider::-moz-range-thumb {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #10b981;
        cursor: pointer;
        border: 2px solid #fff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    /* Mobile filter drawer */
    .filter-drawer {
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
    }

    .filter-drawer.open {
        transform: translateX(0);
    }

    /* Card utilities */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Improved card hover effects */
    .event-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .event-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
    }
</style>

<main class="mx-auto max-w-7xl px-4 py-8 sm:py-16">
    <!-- Header -->
    <div class="mb-12 text-center">
        <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl md:text-6xl">
            Discover Amazing Events
        </h1>
        <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-400">
            Find concerts, workshops, conferences, and more happening around Kenya
        </p>
    </div>

    <!-- Enhanced Search Bar -->
    <div class="mb-8">
        <form method="GET" action="{{ route('Browse') }}" class="space-y-4">
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input
                    type="text"
                    name="search"
                    id="search-input"
                    value="{{ request('search') }}"
                    placeholder="Search events, artists, venues, or locations..."
                    class="w-full rounded-2xl border border-white/10 bg-white/5 py-4 pl-12 pr-4 text-white placeholder:text-gray-400 focus:border-primary-400 focus:ring-2 focus:ring-primary-500/50 focus:outline-none backdrop-blur-sm"
                    autocomplete="off">

                <!-- Search Autocomplete Dropdown -->
                <div id="search-dropdown" class="absolute top-full left-0 right-0 mt-2 hidden rounded-xl border border-white/10 bg-gray-800/90 backdrop-blur-lg shadow-xl z-50">
                    <div class="search-dropdown p-2">
                        <!-- Autocomplete results will be populated here -->
                    </div>
                </div>
            </div>

            <!-- Active Filters Display -->
            <div id="active-filters" class="flex flex-wrap gap-2">
                @if(request('search'))
                    <span class="filter-tag inline-flex items-center gap-2 rounded-full bg-primary-500/20 px-3 py-1 text-sm text-primary-300">
                        Search: "{{ request('search') }}"
                        <button type="button" onclick="removeFilter('search')" class="hover:text-primary-100">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </span>
                @endif

                @if(request('category') && request('category') !== 'all')
                    @php
                        $categoryName = $eventTypes->find(request('category'))->name ?? 'Category';
                    @endphp
                    <span class="filter-tag inline-flex items-center gap-2 rounded-full bg-blue-500/20 px-3 py-1 text-sm text-blue-300">
                        {{ $categoryName }}
                        <button type="button" onclick="removeFilter('category')" class="hover:text-blue-100">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </span>
                @endif

                @if(request('location'))
                    <span class="filter-tag inline-flex items-center gap-2 rounded-full bg-green-500/20 px-3 py-1 text-sm text-green-300">
                        📍 {{ request('location') }}
                        <button type="button" onclick="removeFilter('location')" class="hover:text-green-100">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </span>
                @endif
            </div>
        </form>
    </div>

    <div class="flex flex-col gap-8 lg:flex-row">
        <!-- Mobile Filter Button -->
        <div class="lg:hidden">
            <button id="mobile-filter-btn" class="flex w-full items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 py-3 font-semibold text-white backdrop-blur-sm hover:bg-white/10 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.59L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z" />
                </svg>
                Filters & Sort
                <span id="filter-count" class="hidden rounded-full bg-primary-500 px-2 py-1 text-xs">0</span>
            </button>
        </div>

        <!-- Desktop Sidebar Filters -->
        <aside class="hidden lg:block lg:w-1/4 lg:sticky lg:top-24 lg:self-start">
            <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-sm">
                <h3 class="mb-6 text-lg font-semibold text-white">Filters</h3>

                <form method="GET" action="{{ route('Browse') }}" id="filter-form">
                    <input type="hidden" name="search" value="{{ request('search') }}">

                    <!-- Category Filter -->
                    <div class="mb-6">
                        <h4 class="mb-3 text-sm font-medium text-gray-300">Category</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="category" value="all" {{ request('category', 'all') === 'all' ? 'checked' : '' }} class="sr-only">
                                <span class="filter-option flex w-full cursor-pointer items-center rounded-lg px-3 py-2 text-sm transition-colors {{ request('category', 'all') === 'all' ? 'bg-primary-500/20 text-primary-300' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                    All Events
                                </span>
                            </label>
                            @foreach($eventTypes as $type)
                                <label class="flex items-center">
                                    <input type="radio" name="category" value="{{ $type->id }}" {{ request('category') == $type->id ? 'checked' : '' }} class="sr-only">
                                    <span class="filter-option flex w-full cursor-pointer items-center rounded-lg px-3 py-2 text-sm transition-colors {{ request('category') == $type->id ? 'bg-primary-500/20 text-primary-300' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                        {{ $type->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Location Filter -->
                    <div class="mb-6">
                        <h4 class="mb-3 text-sm font-medium text-gray-300">Location</h4>
                        <select name="location" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white focus:border-primary-400 focus:outline-none">
                            <option value="">All Locations</option>
                            @foreach($cities as $city)
                                <option value="{{ $city }}" {{ request('location') === $city ? 'selected' : '' }}>
                                    {{ $city }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date Filter -->
                    <div class="mb-6">
                        <h4 class="mb-3 text-sm font-medium text-gray-300">Date Range</h4>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-xs text-gray-400 mb-1">From</label>
                                <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white focus:border-primary-400 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-400 mb-1">To</label>
                                <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white focus:border-primary-400 focus:outline-none">
                            </div>
                        </div>
                    </div>

                    <!-- Price Range Filter -->
                    <div class="mb-6">
                        <h4 class="mb-3 text-sm font-medium text-gray-300">Price Range (KES)</h4>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white focus:border-primary-400 focus:outline-none">
                                <span class="text-gray-400">-</span>
                                <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white focus:border-primary-400 focus:outline-none">
                            </div>
                            <div class="flex gap-2">
                                <button type="button" onclick="setPriceRange(0, 1000)" class="flex-1 rounded-lg border border-white/10 px-3 py-1 text-xs text-gray-400 hover:bg-white/5 hover:text-white">
                                    Free - 1K
                                </button>
                                <button type="button" onclick="setPriceRange(1000, 5000)" class="flex-1 rounded-lg border border-white/10 px-3 py-1 text-xs text-gray-400 hover:bg-white/5 hover:text-white">
                                    1K - 5K
                                </button>
                                <button type="button" onclick="setPriceRange(5000, null)" class="flex-1 rounded-lg border border-white/10 px-3 py-1 text-xs text-gray-400 hover:bg-white/5 hover:text-white">
                                    5K+
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sort Options -->
                    <div class="mb-6">
                        <h4 class="mb-3 text-sm font-medium text-gray-300">Sort By</h4>
                        <select name="sort" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white focus:border-primary-400 focus:outline-none">
                            <option value="start_date" {{ request('sort') === 'start_date' ? 'selected' : '' }}>Date (Earliest First)</option>
                            <option value="popularity" {{ request('sort') === 'popularity' ? 'selected' : '' }}>Popularity</option>
                            <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price (Low to High)</option>
                            <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price (High to Low)</option>
                            <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name (A-Z)</option>
                        </select>
                    </div>

                    <!-- Apply Filters Button -->
                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 rounded-lg bg-primary-500 py-2 text-sm font-semibold text-white hover:bg-primary-400 transition-colors">
                            Apply Filters
                        </button>
                        <button type="button" onclick="clearFilters()" class="rounded-lg border border-white/10 px-4 py-2 text-sm text-gray-400 hover:bg-white/5 hover:text-white transition-colors">
                            Clear
                        </button>
                    </div>
                </form>
            </div>
        </aside>

        <!-- Events Grid -->
        <div class="flex-1">
            <!-- Results Header -->
            <div class="mb-6 flex items-center justify-between">
                <div class="text-gray-400">
                    <span class="font-medium text-white">{{ $events->total() }}</span> events found
                    @if(request('search'))
                        for "<span class="text-primary-400">{{ request('search') }}</span>"
                    @endif
                </div>

                <!-- Quick Sort (Mobile) -->
                <div class="lg:hidden">
                    <select onchange="quickSort(this.value)" class="rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm text-white focus:border-primary-400 focus:outline-none">
                        <option value="start_date" {{ request('sort') === 'start_date' ? 'selected' : '' }}>Date</option>
                        <option value="popularity" {{ request('sort') === 'popularity' ? 'selected' : '' }}>Popular</option>
                        <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price ↑</option>
                        <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price ↓</option>
                    </select>
                </div>
            </div>

            <!-- Events Grid -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
                @forelse($events as $event)
                    @php
                        $minPrice = $event->tickets->min('price');
                        $maxPrice = $event->tickets->max('price');
                    @endphp
                    <a href="{{ route('Eventsdetails', $event->slug) }}" class="group block" onclick="@guest showAuthModal(); return false; @endguest">
                        <div class="event-card overflow-hidden rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm hover:border-primary-400/50 hover:bg-white/10 hover:shadow-primary-500/20">
                            <div class="relative">
                                <img
                                    src="{{ $event->image_url ?: 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?w=400&h=300&fit=crop' }}"
                                    alt="{{ $event->name }}"
                                    class="aspect-[4/3] w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                                <!-- Date Badge -->
                                <div class="absolute top-3 right-3 rounded-lg bg-black/70 px-2 py-1 text-center text-white backdrop-blur-sm">
                                    <div class="text-xs font-semibold uppercase tracking-wider">{{ $event->start_date->format('M') }}</div>
                                    <div class="text-lg font-bold leading-tight">{{ $event->start_date->format('j') }}</div>
                                </div>

                                <!-- Category Badge -->
                                <div class="absolute top-3 left-3 rounded-full bg-primary-500/90 px-2 py-1 text-xs font-semibold text-white backdrop-blur-sm">
                                    {{ $event->eventType->name ?? 'Event' }}
                                </div>
                            </div>

                            <div class="p-5">
                                <h3 class="font-bold text-xl text-white group-hover:text-primary-400 transition-colors line-clamp-2 min-h-[3.5rem]">
                                    {{ $event->name }}
                                </h3>
                                <div class="mt-2 mb-3">
                                    @include('components.organizer-badge', ['event' => $event])
                                </div>
                                <div class="space-y-2 mt-3">
                                    <p class="text-sm text-gray-400 flex items-center gap-2">
                                        <svg class="h-4 w-4 text-gray-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="truncate">{{ $event->venue->name ?? 'TBA' }}, {{ $event->venue->city ?? 'Nairobi' }}</span>
                                    </p>
                                    <p class="text-sm text-gray-500 flex items-center gap-2">
                                        <svg class="h-4 w-4 text-gray-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 012 0v4m0 0V3a1 1 0 012 0v4m0 0h4m-4 0H8m0 0v5a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2H10a2 2 0 00-2 2z" />
                                        </svg>
                                        <span>{{ $event->start_date->format('D, M j, Y • g:i A') }}</span>
                                    </p>
                                </div>

                                <div class="mt-5 flex items-center justify-between">
                                    <div class="text-sm">
                                        @if($minPrice && $minPrice > 0)
                                            @if($minPrice === $maxPrice)
                                                <span class="font-bold text-primary-400">KES {{ number_format($minPrice) }}</span>
                                            @else
                                                <span class="font-bold text-primary-400">KES {{ number_format($minPrice) }} - {{ number_format($maxPrice) }}</span>
                                            @endif
                                        @else
                                            <span class="font-bold text-green-400">Free Entry</span>
                                        @endif
                                    </div>

                                    @if($event->is_featured)
                                        <span class="rounded-full bg-yellow-500/20 px-2 py-1 text-xs font-semibold text-yellow-400">
                                            ⭐ Featured
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="mx-auto w-24 h-24 rounded-full bg-gray-800/50 flex items-center justify-center mb-4">
                            <svg class="w-12 h-12 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">No events found</h3>
                        <p class="text-gray-400 mb-4">Try adjusting your search criteria or browse all events</p>
                        <a href="{{ route('Browse') }}" class="inline-block rounded-lg bg-primary-500 px-6 py-2 text-sm font-semibold text-white hover:bg-primary-400 transition-colors">
                            View All Events
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($events->hasPages())
                <div class="mt-12">
                    {{ $events->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </div>
</main>

<!-- Mobile Filter Drawer -->
<div id="mobile-filter-overlay" class="fixed inset-0 z-40 hidden bg-black/50 backdrop-blur-sm lg:hidden"></div>
<div id="mobile-filter-drawer" class="filter-drawer fixed left-0 top-0 z-50 h-full w-80 bg-gray-900 shadow-xl lg:hidden">
    <div class="flex h-full flex-col">
        <div class="flex items-center justify-between border-b border-white/10 p-4">
            <h3 class="text-lg font-semibold text-white">Filters</h3>
            <button id="close-mobile-filter" class="rounded-lg p-2 text-gray-400 hover:bg-white/10 hover:text-white">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-4">
            <form method="GET" action="{{ route('Browse') }}" id="mobile-filter-form">
                <input type="hidden" name="search" value="{{ request('search') }}">

                <!-- Category Filter -->
                <div class="mb-6">
                    <h4 class="mb-3 text-sm font-medium text-gray-300">Category</h4>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" name="category" value="all" {{ request('category', 'all') === 'all' ? 'checked' : '' }} class="sr-only">
                            <span class="mobile-filter-option flex w-full cursor-pointer items-center rounded-lg px-3 py-2 text-sm transition-colors {{ request('category', 'all') === 'all' ? 'bg-primary-500/20 text-primary-300' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                All Events
                            </span>
                        </label>
                        @foreach($eventTypes as $type)
                            <label class="flex items-center">
                                <input type="radio" name="category" value="{{ $type->id }}" {{ request('category') == $type->id ? 'checked' : '' }} class="sr-only">
                                <span class="mobile-filter-option flex w-full cursor-pointer items-center rounded-lg px-3 py-2 text-sm transition-colors {{ request('category') == $type->id ? 'bg-primary-500/20 text-primary-300' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                    {{ $type->name }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Location Filter -->
                <div class="mb-6">
                    <h4 class="mb-3 text-sm font-medium text-gray-300">Location</h4>
                    <select name="location" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white focus:border-primary-400 focus:outline-none">
                        <option value="">All Locations</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}" {{ request('location') === $city ? 'selected' : '' }}>
                                {{ $city }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Date Filter -->
                <div class="mb-6">
                    <h4 class="mb-3 text-sm font-medium text-gray-300">Date Range</h4>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">From</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white focus:border-primary-400 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">To</label>
                            <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white focus:border-primary-400 focus:outline-none">
                        </div>
                    </div>
                </div>

                <!-- Price Range Filter -->
                <div class="mb-6">
                    <h4 class="mb-3 text-sm font-medium text-gray-300">Price Range (KES)</h4>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white focus:border-primary-400 focus:outline-none">
                            <span class="text-gray-400">-</span>
                            <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white focus:border-primary-400 focus:outline-none">
                        </div>
                        <div class="flex gap-2">
                            <button type="button" onclick="setMobilePriceRange(0, 1000)" class="flex-1 rounded-lg border border-white/10 px-3 py-1 text-xs text-gray-400 hover:bg-white/5 hover:text-white">
                                Free - 1K
                            </button>
                            <button type="button" onclick="setMobilePriceRange(1000, 5000)" class="flex-1 rounded-lg border border-white/10 px-3 py-1 text-xs text-gray-400 hover:bg-white/5 hover:text-white">
                                1K - 5K
                            </button>
                            <button type="button" onclick="setMobilePriceRange(5000, null)" class="flex-1 rounded-lg border border-white/10 px-3 py-1 text-xs text-gray-400 hover:bg-white/5 hover:text-white">
                                5K+
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sort Options -->
                <div class="mb-6">
                    <h4 class="mb-3 text-sm font-medium text-gray-300">Sort By</h4>
                    <select name="sort" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white focus:border-primary-400 focus:outline-none">
                        <option value="start_date" {{ request('sort') === 'start_date' ? 'selected' : '' }}>Date (Earliest First)</option>
                        <option value="popularity" {{ request('sort') === 'popularity' ? 'selected' : '' }}>Popularity</option>
                        <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price (Low to High)</option>
                        <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price (High to Low)</option>
                        <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name (A-Z)</option>
                    </select>
                </div>

                <!-- Apply Filters Button -->
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 rounded-lg bg-primary-500 py-3 text-sm font-semibold text-white hover:bg-primary-400 transition-colors">
                        Apply Filters
                    </button>
                    <button type="button" onclick="clearMobileFilters()" class="rounded-lg border border-white/10 px-4 py-3 text-sm text-gray-400 hover:bg-white/5 hover:text-white transition-colors">
                        Clear
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Enhanced Search with Autocomplete
let searchTimeout;
const searchInput = document.getElementById('search-input');
const searchDropdown = document.getElementById('search-dropdown');

searchInput.addEventListener('input', function() {
    clearTimeout(searchTimeout);
    const query = this.value.trim();

    if (query.length < 2) {
        searchDropdown.classList.add('hidden');
        return;
    }

    searchTimeout = setTimeout(() => {
        fetch(`{{ route('api.search') }}?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                displaySearchResults(data);
            })
            .catch(error => {
                console.error('Search error:', error);
            });
    }, 300);
});

function displaySearchResults(events) {
    const dropdown = searchDropdown.querySelector('.search-dropdown');

    if (events.length === 0) {
        dropdown.innerHTML = '<div class="p-3 text-gray-400 text-sm">No events found</div>';
    } else {
        dropdown.innerHTML = events.map(event => `
            <a href="{{ route('Eventsdetails', '') }}/${event.slug}" class="block p-3 hover:bg-white/10 rounded-lg transition-colors">
                <div class="font-medium text-white">${event.name}</div>
                <div class="text-sm text-gray-400">${new Date(event.start_date).toLocaleDateString()}</div>
            </a>
        `).join('');
    }

    searchDropdown.classList.remove('hidden');
}

// Hide dropdown when clicking outside
document.addEventListener('click', function(e) {
    if (!searchInput.contains(e.target) && !searchDropdown.contains(e.target)) {
        searchDropdown.classList.add('hidden');
    }
});

// Filter Management
function removeFilter(filterName) {
    const url = new URL(window.location);
    url.searchParams.delete(filterName);
    window.location.href = url.toString();
}

function clearFilters() {
    window.location.href = '{{ route("Browse") }}';
}

function setPriceRange(min, max) {
    document.querySelector('input[name="price_min"]').value = min || '';
    document.querySelector('input[name="price_max"]').value = max || '';
}

function setMobilePriceRange(min, max) {
    document.querySelector('#mobile-filter-form input[name="price_min"]').value = min || '';
    document.querySelector('#mobile-filter-form input[name="price_max"]').value = max || '';
}

function clearMobileFilters() {
    window.location.href = '{{ route("Browse") }}';
}

function quickSort(sortValue) {
    const url = new URL(window.location);
    url.searchParams.set('sort', sortValue);
    window.location.href = url.toString();
}

// Mobile Filter Drawer
const mobileFilterBtn = document.getElementById('mobile-filter-btn');
const mobileFilterOverlay = document.getElementById('mobile-filter-overlay');
const mobileFilterDrawer = document.getElementById('mobile-filter-drawer');
const closeMobileFilter = document.getElementById('close-mobile-filter');

mobileFilterBtn?.addEventListener('click', () => {
    mobileFilterOverlay.classList.remove('hidden');
    mobileFilterDrawer.classList.add('open');
    document.body.style.overflow = 'hidden';
});

function closeMobileFilterDrawer() {
    mobileFilterOverlay.classList.add('hidden');
    mobileFilterDrawer.classList.remove('open');
    document.body.style.overflow = '';
}

closeMobileFilter?.addEventListener('click', closeMobileFilterDrawer);
mobileFilterOverlay?.addEventListener('click', closeMobileFilterDrawer);

// Filter option styling for both desktop and mobile
document.querySelectorAll('.filter-option, .mobile-filter-option').forEach(option => {
    option.addEventListener('click', function() {
        const radio = this.previousElementSibling;
        radio.checked = true;

        // Update styling for the current form (desktop or mobile)
        const form = this.closest('form');
        const filterOptions = form.querySelectorAll('.filter-option, .mobile-filter-option');
        
        filterOptions.forEach(opt => {
            opt.classList.remove('bg-primary-500/20', 'text-primary-300');
            opt.classList.add('text-gray-400');
        });

        this.classList.remove('text-gray-400');
        this.classList.add('bg-primary-500/20', 'text-primary-300');
    });
});

// Auto-submit form on filter change
document.querySelectorAll('#filter-form select, #filter-form input[type="radio"]').forEach(element => {
    element.addEventListener('change', function() {
        document.getElementById('filter-form').submit();
    });
});
</script>
@endsection
