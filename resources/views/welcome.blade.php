@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-gray-900">
      <!-- Hero Section -->
      <section class="relative mx-auto max-w-7xl px-4 py-12 sm:py-20">
        <div class="text-center mb-12 animate-fade-in">
          <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-500/10 border border-primary-500/20 text-primary-400 text-sm font-semibold mb-6 backdrop-blur-sm">
            <span class="relative flex h-2 w-2">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
            </span>
            Live Events Happening Now
          </div>
          <h1 class="text-5xl font-bold tracking-tight sm:text-6xl lg:text-7xl">
            <span class="bg-gradient-to-r from-white via-gray-100 to-gray-300 bg-clip-text text-transparent">
              Discover Amazing
            </span>
            <br>
            <span class="bg-gradient-to-r from-primary-400 to-emerald-400 bg-clip-text text-transparent">
              Events in Kenya
            </span>
          </h1>
          <p class="mx-auto mt-6 max-w-2xl text-lg sm:text-xl text-gray-300 leading-relaxed">
            From electrifying concerts to inspiring conferences. Book tickets instantly with M-Pesa.
          </p>

          <!-- Quick Stats -->
          <div class="flex flex-wrap items-center justify-center gap-8 mt-10">
            <div class="text-center">
              <div class="text-3xl font-bold text-white">50K+</div>
              <div class="text-sm text-gray-400 mt-1">Happy Attendees</div>
            </div>
            <div class="h-8 w-px bg-gray-700"></div>
            <div class="text-center">
              <div class="text-3xl font-bold text-white">1,000+</div>
              <div class="text-sm text-gray-400 mt-1">Events Hosted</div>
            </div>
            <div class="h-8 w-px bg-gray-700"></div>
            <div class="text-center">
              <div class="text-3xl font-bold text-white">200+</div>
              <div class="text-sm text-gray-400 mt-1">Trusted Organizers</div>
            </div>
          </div>
        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-6 lg:grid-rows-3 mt-12">

          <!-- Featured Carousel -->
          <div id="hero-carousel" class="group relative overflow-hidden rounded-3xl lg:col-span-4 lg:row-span-2 focus-visible-ring shadow-2xl border border-white/5" tabindex="0">
    <div id="carousel-slides" class="flex h-full transition-transform duration-700 ease-in-out">

        @forelse($featuredEvents as $event)
        <div class="carousel-slide relative h-full min-w-full">
            <img src="{{ $event->image_url ?: 'https://images.unsplash.com/photo-1527261834078-9b37d35a4a32?q=80&w=2070&auto=format&fit=crop' }}"
                 alt="{{ $event->name }}"
                 class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
            <div class="relative flex h-full flex-col justify-end p-8">
              <div class="flex items-center gap-3 mb-4">
                <span class="rounded-full bg-primary-500/90 px-4 py-1.5 text-xs font-bold text-white backdrop-blur-sm border border-primary-400/30 shadow-lg">
                  {{ $event->eventType->name ?? 'Event' }}
                </span>
                <span class="rounded-full bg-white/10 px-4 py-1.5 text-xs font-semibold text-white backdrop-blur-sm">
                  Featured
                </span>
              </div>
              <h2 class="text-3xl sm:text-4xl font-bold text-white leading-tight mb-2">{{ $event->name }}</h2>
              <div class="flex items-center gap-2 text-gray-200 mb-6">
                <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span>{{ $event->venue->name ?? 'TBA' }}, {{ $event->venue->city ?? 'Nairobi' }}</span>
                <span class="mx-2">•</span>
                <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>{{ $event->start_date->format('D, M j') }}</span>
              </div>
              <div>
                <a href="{{ route('Eventsdetails', $event->slug) }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3 text-sm font-bold text-gray-900 transition-all hover:bg-primary-500 hover:text-white hover:shadow-xl hover:shadow-primary-500/30 hover:scale-105 focus-visible-ring">
                  Get Tickets
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                  </svg>
                </a>
              </div>
            </div>
        </div>
        @empty
        <!-- Fallback slides if no featured events -->
        <div class="carousel-slide relative h-full min-w-full">
            <img src="https://images.unsplash.com/photo-1527261834078-9b37d35a4a32?q=80&w=2070&auto=format&fit=crop" alt="Featured Event" class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
            <div class="relative flex h-full flex-col justify-end p-6">
              <span class="rounded-full bg-primary-500/90 px-3 py-1 text-xs font-semibold text-white backdrop-blur-sm self-start">Coming Soon</span>
              <h2 class="mt-3 text-3xl font-bold text-white">Amazing Events Coming Soon</h2>
              <p class="mt-1 text-gray-300">Stay tuned for exciting events</p>
              <div class="mt-4"><a href="{{ route('Browse') }}" class="inline-block rounded-lg bg-white px-5 py-2.5 text-sm font-bold text-gray-900 transition-all hover:bg-primary-400 hover:text-white focus-visible-ring">Browse Events</a></div>
            </div>
        </div>
        @endforelse
    </div>

    <div id="carousel-controls" class="absolute inset-0 flex items-center justify-between px-2 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
        <button id="prev-button" class="rounded-full bg-black/40 p-2 text-white backdrop-blur-sm transition hover:bg-black/60 focus-visible-ring" aria-label="Previous slide">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
        </button>
        <button id="next-button" class="rounded-full bg-black/40 p-2 text-white backdrop-blur-sm transition hover:bg-black/60 focus-visible-ring" aria-label="Next slide">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
        </button>
    </div>

    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 space-x-2">
        <div id="carousel-pagination" class="flex items-center justify-center space-x-2 rounded-full bg-black/40 p-1 backdrop-blur-sm">
            </div>
    </div>
    <div id="carousel-progress" class="absolute bottom-0 left-0 h-1 w-full bg-white/10">
        <div class="h-full bg-primary-400" style="width: 0%;"></div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.getElementById('hero-carousel');
    const slidesContainer = document.getElementById('carousel-slides');
    const slides = document.querySelectorAll('.carousel-slide');
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');
    const paginationContainer = document.getElementById('carousel-pagination');
    const progressFill = document.querySelector('#carousel-progress > div');

    let currentIndex = 0;
    let autoplayInterval;
    const autoplayDuration = 6000; // 6 seconds

    // --- Create Pagination Dots ---
    slides.forEach((_, i) => {
        const dot = document.createElement('button');
        dot.classList.add('h-2', 'rounded-full', 'bg-white/50', 'transition-all', 'duration-300');
        dot.style.width = '0.5rem'; // Default width
        dot.addEventListener('click', () => {
            goToSlide(i);
            resetAutoplay();
        });
        paginationContainer.appendChild(dot);
    });
    const paginationDots = paginationContainer.querySelectorAll('button');

    // --- Core Function to Change Slide ---
    function goToSlide(index) {
        currentIndex = (index + slides.length) % slides.length; // Loop around
        slidesContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
        updatePagination();
        restartProgressBar();
    }

    // --- Update UI Elements ---
    function updatePagination() {
        paginationDots.forEach((dot, i) => {
            if (i === currentIndex) {
                dot.style.width = '1.5rem'; // Active dot width
                dot.classList.add('bg-white');
                dot.classList.remove('bg-white/50');
            } else {
                dot.style.width = '0.5rem';
                dot.classList.remove('bg-white');
                dot.classList.add('bg-white/50');
            }
        });
    }

    function restartProgressBar() {
        progressFill.style.transition = 'none';
        progressFill.style.width = '0%';
        // Force reflow to restart animation
        void progressFill.offsetWidth;
        progressFill.style.transition = `width ${autoplayDuration}ms linear`;
        progressFill.style.width = '100%';
    }

    // --- Autoplay Logic ---
    function startAutoplay() {
        autoplayInterval = setInterval(() => {
            goToSlide(currentIndex + 1);
        }, autoplayDuration);
        restartProgressBar();
    }

    function resetAutoplay() {
        clearInterval(autoplayInterval);
        startAutoplay();
    }

    // --- Event Listeners ---
    nextButton.addEventListener('click', () => {
        goToSlide(currentIndex + 1);
        resetAutoplay();
    });

    prevButton.addEventListener('click', () => {
        goToSlide(currentIndex - 1);
        resetAutoplay();
    });

    carousel.addEventListener('mouseenter', () => clearInterval(autoplayInterval));
    carousel.addEventListener('mouseleave', () => startAutoplay());

    // --- Initialize ---
    goToSlide(0); // Start at the first slide
    startAutoplay();
});
</script>
          <!-- Enhanced Search Box -->
          <div class="rounded-3xl border border-gray-700/50 bg-gradient-to-br from-gray-800/60 to-gray-800/40 backdrop-blur-md p-6 lg:col-span-2 lg:row-span-1 shadow-2xl hover:shadow-primary-500/10 transition-all duration-300">
            <div class="flex items-center gap-2 mb-4">
              <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
              </svg>
              <h3 class="font-bold text-white">Find Your Event</h3>
            </div>
            <form action="{{ route('Browse') }}" method="GET" class="space-y-3">
              <div>
                <label for="event-search" class="sr-only">Search</label>
                <div class="relative group">
                   <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                      <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary-400 transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" /></svg>
                   </div>
                   <input type="text" name="search" id="event-search" class="w-full rounded-xl border border-gray-600/50 bg-gray-700/30 py-3 pl-11 pr-4 text-white placeholder:text-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 focus:bg-gray-700/50 transition-all" placeholder="Search events, artists...">
                </div>
              </div>
              <button type="submit" class="w-full rounded-xl bg-gradient-to-r from-primary-500 to-emerald-500 py-3 text-sm font-bold text-white shadow-lg transition-all hover:shadow-xl hover:shadow-primary-500/30 hover:scale-[1.02] focus-visible-ring">
                Search Events
              </button>
            </form>
          </div>

          <!-- Category Card - Tech -->
          <a href="{{ route('Browse', ['category' => 3]) }}" class="group relative overflow-hidden rounded-3xl p-6 lg:col-span-2 lg:row-span-1 transition-all duration-300 hover:shadow-2xl hover:shadow-primary-500/20 focus-visible-ring border border-white/5">
            <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=1932&auto=format&fit=crop" alt="Tech conference" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-black/20"></div>
            <div class="relative flex flex-col h-full justify-end">
              <div class="inline-flex items-center gap-2 self-start mb-3">
                <span class="text-2xl">💻</span>
                <span class="rounded-full bg-primary-500/20 px-3 py-1 text-xs font-bold text-primary-300 border border-primary-500/30">Trending</span>
              </div>
              <h3 class="text-xl font-bold text-white mb-1">Tech Conferences</h3>
              <p class="text-sm text-gray-300">Explore the future of tech</p>
            </div>
          </a>

          <!-- Trust Section -->
          <div class="rounded-3xl border border-gray-700/50 bg-gradient-to-br from-gray-800/60 to-gray-800/40 backdrop-blur-md p-6 lg:col-span-3 lg:row-span-1 shadow-2xl">
             <div class="flex items-center gap-2 mb-5">
               <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
               </svg>
               <h3 class="font-bold text-white">Trusted & Secure</h3>
             </div>
             <div class="grid grid-cols-2 gap-4 text-sm">
                <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 transition-colors">
                  <svg class="h-5 w-5 text-primary-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3.75m-3.75 2.25h16.5m-16.5-9h16.5" /></svg>
                  <span class="text-gray-200 font-medium">M-Pesa</span>
                </div>
                <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 transition-colors">
                  <svg class="h-5 w-5 text-primary-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                  <span class="text-gray-200 font-medium">Instant</span>
                </div>
                <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 transition-colors">
                  <svg class="h-5 w-5 text-primary-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.286z" /></svg>
                  <span class="text-gray-200 font-medium">Verified</span>
                </div>
                <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 transition-colors">
                  <svg class="h-5 w-5 text-primary-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" /></svg>
                  <span class="text-gray-200 font-medium">24/7</span>
                </div>
             </div>
          </div>

          <!-- Category Card - Food -->
          <a href="{{ route('Browse', ['category' => 8]) }}" class="group relative overflow-hidden rounded-3xl p-6 lg:col-span-3 lg:row-span-1 transition-all duration-300 hover:shadow-2xl hover:shadow-primary-500/20 focus-visible-ring border border-white/5">
            <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=1887&auto=format&fit=crop" alt="Food festival" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-black/20"></div>
            <div class="relative flex flex-col h-full justify-end">
              <div class="inline-flex items-center gap-2 self-start mb-3">
                <span class="text-2xl">🍽️</span>
                <span class="rounded-full bg-orange-500/20 px-3 py-1 text-xs font-bold text-orange-300 border border-orange-500/30">Popular</span>
              </div>
              <h3 class="text-xl font-bold text-white mb-1">Food & Drink Festivals</h3>
              <p class="text-sm text-gray-300">Savor the best of Kenyan cuisine</p>
            </div>
          </a>

        </div>
      </section>

      <!-- Happening Soon Section -->
      <section class="py-20 sm:py-28 bg-gradient-to-b from-gray-900 to-gray-800/50">
    <div class="mx-auto max-w-7xl px-4">
        <div class="mb-16 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-gray-300 text-sm font-medium mb-6">
              <svg class="w-4 h-4 text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
              </svg>
              Curated Events
            </div>
            <h2 class="text-4xl font-bold tracking-tight text-white sm:text-5xl">
              <span class="bg-gradient-to-r from-white to-gray-400 bg-clip-text text-transparent">
                Happening Soon
              </span>
            </h2>
            <p class="mt-4 text-lg text-gray-300 max-w-2xl mx-auto">Discover unforgettable experiences. New events added daily.</p>
        </div>

        <div class="flex flex-col gap-12 lg:flex-row">
            <!-- Modernized Category Sidebar -->
            <aside class="lg:w-1/4">
                <div class="lg:sticky lg:top-28 rounded-2xl border border-gray-700/50 bg-gray-800/30 backdrop-blur-sm p-6">
                    <h3 class="mb-6 text-lg font-bold text-white flex items-center gap-2">
                      <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                      </svg>
                      Browse by Category
                    </h3>
                    <div id="event-filters" class="flex flex-wrap gap-2 lg:flex-col lg:items-stretch">
                        <a href="{{ route('Browse') }}" class="filter-btn active-filter group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold transition-all focus-visible-ring bg-gradient-to-r from-primary-500 to-emerald-500 text-white hover:shadow-lg hover:shadow-primary-500/30">
                          <span class="text-lg">🎯</span>
                          <span>All Events</span>
                          <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                          </svg>
                        </a>
                        <a href="{{ route('Browse', ['category' => 1]) }}" class="filter-btn group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all focus-visible-ring text-gray-300 bg-white/5 border border-white/5 hover:bg-white/10 hover:border-primary-500/30">
                          <span class="text-lg">🎵</span>
                          <span>Music</span>
                          <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                          </svg>
                        </a>
                        <a href="{{ route('Browse', ['category' => 3]) }}" class="filter-btn group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all focus-visible-ring text-gray-300 bg-white/5 border border-white/5 hover:bg-white/10 hover:border-primary-500/30">
                          <span class="text-lg">💻</span>
                          <span>Tech</span>
                          <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                          </svg>
                        </a>
                        <a href="{{ route('Browse', ['category' => 7]) }}" class="filter-btn group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all focus-visible-ring text-gray-300 bg-white/5 border border-white/5 hover:bg-white/10 hover:border-primary-500/30">
                          <span class="text-lg">🎨</span>
                          <span>Arts & Culture</span>
                          <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                          </svg>
                        </a>
                        <a href="{{ route('Browse', ['category' => 8]) }}" class="filter-btn group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all focus-visible-ring text-gray-300 bg-white/5 border border-white/5 hover:bg-white/10 hover:border-primary-500/30">
                          <span class="text-lg">🍽️</span>
                          <span>Food & Drink</span>
                          <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                          </svg>
                        </a>
                        <a href="{{ route('Browse', ['category' => 4]) }}" class="filter-btn group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all focus-visible-ring text-gray-300 bg-white/5 border border-white/5 hover:bg-white/10 hover:border-primary-500/30">
                          <span class="text-lg">🤝</span>
                          <span>Community</span>
                          <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                          </svg>
                        </a>
                    </div>
                </div>
            </aside>

            <div class="flex-1">
                <div id="event-grid" class="grid grid-cols-1 gap-8 md:grid-cols-2">

                    @forelse($upcomingEvents as $index => $event)
                        @php
                            $minPrice = $event->tickets->min('price');
                            $categoryMap = [
                                1 => 'music',
                                2 => 'music',
                                3 => 'tech',
                                4 => 'community',
                                5 => 'community',
                                6 => 'sports',
                                7 => 'art',
                                8 => 'food',
                                9 => 'tech',
                                10 => 'art',
                                11 => 'community',
                                12 => 'community'
                            ];
                            $category = $categoryMap[$event->event_type_id] ?? 'community';
                        @endphp

                        <a href="{{ route('Eventsdetails', $event->slug) }}"
                           class="event-card group {{ $index === 0 ? 'md:col-span-2' : '' }}"
                           data-category="{{ $category }}">

                            @if($index === 0)
                                <!-- Featured Hero Card -->
                                <div class="relative overflow-hidden rounded-3xl border border-white/10 shadow-2xl hover:shadow-primary-500/20 transition-all duration-500">
                                    <img class="aspect-[16/7] w-full object-cover transition-transform duration-700 group-hover:scale-110"
                                         src="{{ $event->image_url ?: 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=1974&auto=format&fit=crop' }}"
                                         alt="{{ $event->name }}">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>

                                    <!-- Date Badge -->
                                    <div class="absolute top-6 right-6 rounded-2xl bg-gradient-to-br from-primary-500 to-emerald-500 p-4 text-center text-white backdrop-blur-sm shadow-xl border border-white/20">
                                        <span class="block text-xs font-bold uppercase tracking-wider">{{ $event->start_date->format('M') }}</span>
                                        <span class="block text-3xl font-bold leading-tight">{{ $event->start_date->format('j') }}</span>
                                    </div>

                                    <!-- Content -->
                                    <div class="absolute bottom-0 left-0 right-0 p-8">
                                        <div class="flex items-center gap-2 mb-4">
                                            <span class="rounded-full bg-white/10 px-4 py-1.5 text-xs font-bold text-white backdrop-blur-sm border border-white/20">Featured Event</span>
                                        </div>
                                        <h3 class="text-3xl font-bold text-white mb-3 leading-tight">{{ $event->name }}</h3>
                                        <div class="flex items-center gap-2 text-gray-200">
                                            <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <span>{{ $event->venue->name ?? 'TBA' }}, {{ $event->venue->city ?? 'Nairobi' }}</span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Modern Event Card -->
                                <div class="relative overflow-hidden rounded-2xl border border-gray-700/50 bg-gray-800/40 backdrop-blur-sm shadow-lg hover:shadow-2xl hover:shadow-primary-500/10 hover:border-primary-500/30 transition-all duration-500 h-full flex flex-col group-hover:scale-[1.02]">
                                    <div class="relative overflow-hidden">
                                        <img class="aspect-[4/3] w-full object-cover transition-transform duration-700 group-hover:scale-110"
                                             src="{{ $event->image_url ?: 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?w=400&h=300&fit=crop' }}"
                                             alt="{{ $event->name }}">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                                        <!-- Date Badge -->
                                        <div class="absolute top-4 right-4 rounded-xl bg-gradient-to-br from-primary-500/90 to-emerald-500/90 p-3 text-center text-white backdrop-blur-md shadow-lg border border-white/20">
                                            <span class="block text-xs font-bold">{{ $event->start_date->format('M') }}</span>
                                            <span class="block text-xl font-bold leading-tight">{{ $event->start_date->format('j') }}</span>
                                        </div>
                                    </div>

                                    <div class="p-5 flex-grow flex flex-col">
                                        <h3 class="font-bold text-white text-lg mb-2 line-clamp-2 group-hover:text-primary-400 transition-colors">{{ $event->name }}</h3>
                                        <div class="flex items-center gap-2 text-sm text-gray-400 mb-4">
                                            <svg class="w-4 h-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <span class="truncate">{{ $event->venue->name ?? 'TBA' }}</span>
                                        </div>

                                        <div class="mt-auto pt-4 border-t border-gray-700/50">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <div class="text-xs text-gray-400 mb-1">Starting from</div>
                                                    <div class="text-lg font-bold text-white">
                                                        @if($minPrice && $minPrice > 0)
                                                            KES {{ number_format($minPrice) }}
                                                        @else
                                                            <span class="text-primary-400">Free</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="rounded-xl bg-primary-500/20 text-primary-400 group-hover:bg-primary-500 group-hover:text-white transition-all duration-300 px-4 py-2 flex items-center gap-2">
                                                    <span class="text-sm font-bold">Book</span>
                                                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </a>
                    @empty
                        <div class="md:col-span-2 text-center py-12">
                            <p class="text-gray-300 text-lg">No upcoming events available at the moment.</p>
                            <p class="text-gray-400 text-sm mt-2">Check back soon for exciting new events!</p>
                        </div>
                    @endforelse

                </div>

                <!-- Enhanced CTA -->
                <div class="mt-16 text-center">
                    <a href="{{ route('Browse') }}" class="group inline-flex items-center gap-3 rounded-2xl border-2 border-primary-500 bg-gradient-to-r from-primary-500/20 to-emerald-500/20 px-10 py-4 font-bold text-primary-400 transition-all hover:bg-primary-500 hover:text-white hover:shadow-2xl hover:shadow-primary-500/30 hover:scale-105 focus-visible-ring">
                        <span>Explore All Events</span>
                        <svg class="w-5 h-5 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add Scroll Reveal Animations -->
<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.8s ease-out;
}

/* Smooth scroll animations */
@media (prefers-reduced-motion: no-preference) {
    .event-card {
        opacity: 0;
        animation: fade-in 0.6s ease-out forwards;
    }

    .event-card:nth-child(1) { animation-delay: 0.1s; }
    .event-card:nth-child(2) { animation-delay: 0.2s; }
    .event-card:nth-child(3) { animation-delay: 0.3s; }
    .event-card:nth-child(4) { animation-delay: 0.4s; }
    .event-card:nth-child(5) { animation-delay: 0.5s; }
    .event-card:nth-child(6) { animation-delay: 0.6s; }
}

/* Enhanced hover glow */
.card-glow-enhanced {
    transition: all 0.3s ease;
}

.card-glow-enhanced:hover {
    box-shadow: 0 0 30px 0 rgba(16, 185, 129, 0.4), 0 0 10px 0 rgba(16, 185, 129, 0.3);
}

/* Line clamp utility */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

@endsection
