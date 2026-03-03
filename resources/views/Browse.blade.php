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

<main class="mx-auto max-w-7xl px-4 py-12 sm:py-20">
    <!-- Enhanced Header -->
    <div class="mb-16 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-500/10 border border-primary-500/20 text-primary-400 text-sm font-semibold mb-6 backdrop-blur-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Explore Events
        </div>
        <h1 class="text-5xl font-bold tracking-tight sm:text-6xl md:text-7xl">
            <span class="bg-gradient-to-r from-white via-gray-100 to-gray-300 bg-clip-text text-transparent">
                Discover Amazing
            </span>
            <br>
            <span class="bg-gradient-to-r from-primary-400 to-emerald-400 bg-clip-text text-transparent">
                Events Near You
            </span>
        </h1>
        <p class="mt-6 max-w-2xl mx-auto text-lg sm:text-xl text-gray-300 leading-relaxed">
            From electrifying concerts to inspiring workshops. Find your next experience.
        </p>
    </div>

    <!-- Modernized Search Bar -->
    <div class="mb-12">
        <form method="GET" action="{{ route('Browse') }}" class="space-y-6">
            <div class="relative max-w-4xl mx-auto">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-6">
                    <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input
                    type="text"
                    name="search"
                    id="search-input"
                    value="{{ request('search') }}"
                    placeholder="Search events, artists, venues, or locations..."
                    class="w-full rounded-2xl border-2 border-gray-700/50 bg-gradient-to-br from-gray-800/60 to-gray-800/40 py-5 pl-14 pr-6 text-white text-lg placeholder:text-gray-400 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/20 focus:outline-none backdrop-blur-md shadow-2xl transition-all"
                    autocomplete="off">

                <!-- Enhanced Search Autocomplete Dropdown -->
                <div id="search-dropdown" class="absolute top-full left-0 right-0 mt-3 hidden rounded-2xl border border-gray-700/50 bg-gray-800/95 backdrop-blur-xl shadow-2xl z-50 overflow-hidden">
                    <div class="search-dropdown p-2">
                        <!-- Autocomplete results will be populated here -->
                    </div>
                </div>
            </div>

            <!-- Enhanced Active Filters Display -->
             <!-- Display active filters as tags with icons and remove buttons -->
            <div id="active-filters" class="flex flex-wrap gap-3 max-w-4xl mx-auto">
                @if(request('search'))
                    <span class="filter-tag inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500/20 to-emerald-500/20 border border-primary-500/30 px-4 py-2 text-sm font-medium text-primary-300 shadow-lg backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        "{{ request('search') }}"
                        <button type="button" onclick="removeFilter('search')" class="hover:text-primary-100 hover:bg-white/10 rounded-full p-1 transition-colors">
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
                    <span class="filter-tag inline-flex items-center gap-2 rounded-xl bg-blue-500/20 border border-blue-500/30 px-4 py-2 text-sm font-medium text-blue-300 shadow-lg backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/>
                        </svg>
                        {{ $categoryName }}
                        <button type="button" onclick="removeFilter('category')" class="hover:text-blue-100 hover:bg-white/10 rounded-full p-1 transition-colors">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </span>
                @endif

                @if(request('location'))
                    <span class="filter-tag inline-flex items-center gap-2 rounded-xl bg-green-500/20 border border-green-500/30 px-4 py-2 text-sm font-medium text-green-300 shadow-lg backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ request('location') }}
                        <button type="button" onclick="removeFilter('location')" class="hover:text-green-100 hover:bg-white/10 rounded-full p-1 transition-colors">
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
        <!-- Enhanced Mobile Filter Button -->
        <div class="lg:hidden">
            <button id="mobile-filter-btn" class="flex w-full items-center justify-center gap-3 rounded-2xl border-2 border-gray-700/50 bg-gradient-to-br from-gray-800/60 to-gray-800/40 py-4 font-bold text-white backdrop-blur-md shadow-xl hover:border-primary-500/50 hover:shadow-2xl hover:shadow-primary-500/10 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 text-primary-400">
                    <path d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.59L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z" />
                </svg>
                Filters & Sort
                <span id="filter-count" class="hidden rounded-full bg-gradient-to-r from-primary-500 to-emerald-500 px-2.5 py-1 text-xs font-bold">0</span>
            </button>
        </div>

        <!-- Modernized Desktop Sidebar Filters -->
        <aside class="hidden lg:block lg:w-1/4 lg:sticky lg:top-24 lg:self-start">
            <div class="rounded-2xl border border-gray-700/50 bg-gradient-to-br from-gray-800/60 to-gray-800/40 p-6 backdrop-blur-md shadow-2xl">
                <div class="flex items-center gap-2 mb-6">
                    <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    <h3 class="text-lg font-bold text-white">Filters</h3>
                </div>

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
                        <!-- Modernized Event Card -->
                        <div class="event-card overflow-hidden rounded-2xl border border-gray-700/50 bg-gray-800/40 backdrop-blur-sm shadow-lg hover:shadow-2xl hover:shadow-primary-500/10 hover:border-primary-500/30 transition-all duration-500 h-full flex flex-col group-hover:scale-[1.02]">
                            <div class="relative overflow-hidden">
                                <img
                                    src="{{ $event->image_url ?: 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?w=400&h=300&fit=crop' }}"
                                    alt="{{ $event->name }}"
                                    class="aspect-[4/3] w-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                                <!-- Enhanced Date Badge -->
                                <div class="absolute top-4 right-4 rounded-xl bg-gradient-to-br from-primary-500/90 to-emerald-500/90 p-3 text-center text-white backdrop-blur-md shadow-lg border border-white/20">
                                    <span class="block text-xs font-bold">{{ $event->start_date->format('M') }}</span>
                                    <span class="block text-xl font-bold leading-tight">{{ $event->start_date->format('j') }}</span>
                                </div>

                                <!-- Category Badge -->
                                <div class="absolute top-4 left-4 rounded-full bg-white/10 backdrop-blur-md px-3 py-1.5 text-xs font-bold text-white border border-white/20 shadow-lg">
                                    {{ $event->eventType->name ?? 'Event' }}
                                </div>

                                @if($event->is_featured)
                                    <div class="absolute bottom-4 left-4 rounded-full bg-gradient-to-r from-yellow-500/90 to-orange-500/90 backdrop-blur-md px-3 py-1.5 text-xs font-bold text-white border border-white/20 shadow-lg flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        Featured
                                    </div>
                                @endif
                            </div>

                            <div class="p-5 flex-grow flex flex-col">
                                <h3 class="font-bold text-lg text-white mb-2 line-clamp-2 group-hover:text-primary-400 transition-colors min-h-[3.5rem]">
                                    {{ $event->name }}
                                </h3>
                                <div class="mt-2 mb-3">
                                    @include('components.organizer-badge', ['event' => $event])
                                </div>
                                <div class="space-y-2 mt-3">
                                    <div class="flex items-center gap-2 text-sm text-gray-400">
                                        <svg class="h-4 w-4 text-primary-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="truncate">{{ $event->venue->name ?? 'TBA' }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm text-gray-400">
                                        <svg class="h-4 w-4 text-primary-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ $event->start_date->format('M j, Y') }}</span>
                                    </div>
                                </div>

                                <div class="mt-auto pt-5 border-t border-gray-700/50">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="text-xs text-gray-400 mb-1">Starting from</div>
                                            <div class="text-lg font-bold text-white">
                                                @if($minPrice && $minPrice > 0)
                                                    @if($minPrice === $maxPrice)
                                                        KES {{ number_format($minPrice) }}
                                                    @else
                                                        KES {{ number_format($minPrice) }}
                                                    @endif
                                                @else
                                                    <span class="text-primary-400">Free</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="rounded-xl bg-primary-500/20 text-primary-400 group-hover:bg-primary-500 group-hover:text-white transition-all duration-300 px-4 py-2 flex items-center gap-2">
                                            <span class="text-sm font-bold">View</span>
                                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                            </svg>
                                        </div>
                                    </div>
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
