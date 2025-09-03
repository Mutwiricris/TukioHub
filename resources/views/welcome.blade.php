@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-gray-900">
      <section class="mx-auto max-w-7xl px-4 py-16 sm:py-24">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-6 lg:grid-rows-3">

          <div class="lg:col-span-6">
            <h1 class="text-4xl font-bold tracking-tight text-center sm:text-5xl lg:text-6xl bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
                Unforgettable<br class="hidden sm:block"> Experiences Await
            </h1>
            <p class="mx-auto mt-4 max-w-2xl text-center text-lg text-gray-300">Your portal to Kenya's most exciting events.</p>
          </div>

          <div id="hero-carousel" class="group relative overflow-hidden rounded-3xl lg:col-span-4 lg:row-span-2 focus-visible-ring" tabindex="0">
    <div id="carousel-slides" class="flex h-full transition-transform duration-700 ease-in-out">

        @forelse($featuredEvents as $event)
        <div class="carousel-slide relative h-full min-w-full">
            <img src="{{ $event->image_url ?: 'https://images.unsplash.com/photo-1527261834078-9b37d35a4a32?q=80&w=2070&auto=format&fit=crop' }}"
                 alt="{{ $event->name }}"
                 class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
            <div class="relative flex h-full flex-col justify-end p-6">
              <span class="rounded-full bg-primary-500/90 px-3 py-1 text-xs font-semibold text-white backdrop-blur-sm self-start">
                {{ $event->eventType->name ?? 'Event' }}
              </span>
              <h2 class="mt-3 text-3xl font-bold text-white">{{ $event->name }}</h2>
              <p class="mt-1 text-gray-300">
                {{ $event->venue->name ?? 'TBA' }}, {{ $event->venue->city ?? 'Nairobi' }} •
                {{ $event->start_date->format('D, M j') }}
              </p>
              <div class="mt-4">
                <a href="{{ route('Eventsdetails', $event->slug) }}"
                   class="inline-block rounded-lg bg-white px-5 py-2.5 text-sm font-bold text-gray-900 transition-all hover:bg-primary-400 hover:text-white focus-visible-ring">
                  Get Tickets
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
          <div class="rounded-3xl border border-gray-700/50 bg-gray-800/50 backdrop-blur-sm p-6 lg:col-span-2 lg:row-span-1 shadow-lg">
            <h3 class="font-bold text-white">Find your next event</h3>
            <form action="{{ route('Browse') }}" method="GET" class="mt-4 space-y-3">
              <div>
                <label for="event-search" class="sr-only">Search</label>
                <div class="relative">
                   <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                      <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" /></svg>
                   </div>
                   <input type="text" name="search" id="event-search" class="w-full rounded-lg border border-gray-600/50 bg-gray-700/50 py-2.5 pl-10 pr-3 text-white placeholder:text-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20" placeholder="Search events, artists, venues...">
                </div>
              </div>
              <button type="submit" class="w-full rounded-lg bg-gradient-to-r from-primary-500 to-primary-600 py-2.5 text-sm font-semibold text-white shadow-lg transition-all hover:from-primary-600 hover:to-primary-700 focus-visible-ring">Search Events</button>
            </form>
          </div>

          <a href="{{ route('Browse') }}" class="group relative overflow-hidden rounded-3xl p-6 lg:col-span-2 lg:row-span-1 transition-all duration-300 hover:shadow-2xl card-glow focus-visible-ring">
            <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=1932&auto=format&fit=crop" alt="Tech conference" class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-black/20"></div>
            <div class="relative">
              <h3 class="text-xl font-bold text-white">Tech Conferences</h3>
              <p class="mt-1 text-sm text-gray-300">Explore the future of tech</p>
            </div>
          </a>

          <div class="rounded-3xl border border-gray-700/50 bg-gray-800/50 backdrop-blur-sm p-6 lg:col-span-3 lg:row-span-1 shadow-lg">
             <h3 class="font-bold text-white">Seamless & Secure Ticketing</h3>
             <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
                <div class="flex items-center gap-2 text-gray-300"><svg class="h-5 w-5 text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3.75m-3.75 2.25h16.5m-16.5-9h16.5" /></svg>Secure M-Pesa</div>
                <div class="flex items-center gap-2 text-gray-300"><svg class="h-5 w-5 text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" /></svg>Instant Delivery</div>
                <div class="flex items-center gap-2 text-gray-300"><svg class="h-5 w-5 text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.286z" /></svg>Verified Organizers</div>
                <div class="flex items-center gap-2 text-gray-300"><svg class="h-5 w-5 text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.17 48.17 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" /></svg>24/7 Support</div>
             </div>
          </div>

          <a href="{{ route('Browse') }}" class="group relative overflow-hidden rounded-3xl p-6 lg:col-span-3 lg:row-span-1 transition-all duration-300 hover:shadow-2xl card-glow focus-visible-ring">
            <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=1887&auto=format&fit=crop" alt="Food festival" class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-black/20"></div>
            <div class="relative">
              <h3 class="text-xl font-bold text-white">Food & Drink Festivals</h3>
              <p class="mt-1 text-sm text-gray-300">Savor the best of Kenyan cuisine</p>
            </div>
          </a>

        </div>
      </section>

      <section class="py-16 sm:py-24 bg-gray-800/50">
    <div class="mx-auto max-w-7xl px-4">
        <div class="mb-12 text-center">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Happening Soon</h2>
            <p class="mt-4 text-lg text-gray-300">Discover events curated for you. New experiences added daily.</p>
        </div>

        <div class="flex flex-col gap-12 lg:flex-row">
            <aside class="lg:w-1/4 lg:sticky lg:top-28 lg:self-start">
                <h3 class="mb-4 hidden text-lg font-semibold text-white lg:block">Categories</h3>
                <div id="event-filters" class="flex flex-wrap items-center justify-center gap-3 lg:flex-col lg:items-stretch lg:justify-start">
                    <a href="{{ route('Browse') }}" class="filter-btn active-filter rounded-full px-4 py-2 text-sm font-semibold transition-colors focus-visible-ring bg-primary-500 text-white hover:bg-primary-600">All Events</a>
                    <a href="{{ route('Browse', ['category' => 1]) }}" class="filter-btn rounded-full px-4 py-2 text-sm font-medium transition-colors focus-visible-ring text-gray-300 bg-gray-700/50 border border-gray-600/50 hover:bg-gray-600/50">🎵 Music</a>
                    <a href="{{ route('Browse', ['category' => 3]) }}" class="filter-btn rounded-full px-4 py-2 text-sm font-medium transition-colors focus-visible-ring text-gray-300 bg-gray-700/50 border border-gray-600/50 hover:bg-gray-600/50">💻 Tech</a>
                    <a href="{{ route('Browse', ['category' => 7]) }}" class="filter-btn rounded-full px-4 py-2 text-sm font-medium transition-colors focus-visible-ring text-gray-300 bg-gray-700/50 border border-gray-600/50 hover:bg-gray-600/50">🎨 Arts & Culture</a>
                    <a href="{{ route('Browse', ['category' => 8]) }}" class="filter-btn rounded-full px-4 py-2 text-sm font-medium transition-colors focus-visible-ring text-gray-300 bg-gray-700/50 border border-gray-600/50 hover:bg-gray-600/50">🍽️ Food & Drink</a>
                    <a href="{{ route('Browse', ['category' => 4]) }}" class="filter-btn rounded-full px-4 py-2 text-sm font-medium transition-colors focus-visible-ring text-gray-300 bg-gray-700/50 border border-gray-600/50 hover:bg-gray-600/50">🤝 Community</a>
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
                                <!-- Featured large card -->
                                <div class="relative overflow-hidden rounded-2xl border border-white/10">
                                    <img class="aspect-[16/7] w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                         src="{{ $event->image_url ?: 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=1974&auto=format&fit=crop' }}"
                                         alt="{{ $event->name }}">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                                    <div class="absolute top-4 right-4 rounded-lg bg-black/50 p-2 text-center text-white backdrop-blur-sm">
                                        <span class="block text-xs font-semibold uppercase tracking-wider">{{ $event->start_date->format('M') }}</span>
                                        <span class="block text-2xl font-bold">{{ $event->start_date->format('j') }}</span>
                                    </div>
                                    <div class="absolute bottom-0 left-0 p-6">
                                        <h3 class="text-2xl font-bold text-white">{{ $event->name }}</h3>
                                        <p class="mt-1 text-gray-300">{{ $event->venue->name ?? 'TBA' }}, {{ $event->venue->city ?? 'Nairobi' }}</p>
                                    </div>
                                </div>
                            @else
                                <!-- Regular card -->
                                <div class="relative overflow-hidden rounded-2xl border border-gray-700/50 bg-gray-800/50 backdrop-blur-sm shadow-lg hover:shadow-xl transition-shadow duration-300 h-full flex flex-col">
                                    <img class="aspect-[4/3] w-full object-cover"
                                         src="{{ $event->image_url ?: 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?w=400&h=300&fit=crop' }}"
                                         alt="{{ $event->name }}">
                                    <div class="p-4 flex-grow flex flex-col">
                                        <h3 class="font-bold text-white">{{ Str::limit($event->name, 30) }}</h3>
                                        <p class="mt-1 text-sm text-gray-300">{{ $event->venue->name ?? 'TBA' }}, {{ $event->venue->city ?? 'Nairobi' }}</p>
                                        <div class="mt-auto pt-4">
                                            <div class="cta-button rounded-lg bg-primary-500/20 text-primary-400 group-hover:bg-primary-500 group-hover:text-white transition-all duration-300 flex items-center justify-between p-2">
                                                <span class="px-2 text-sm font-bold">
                                                    @if($minPrice && $minPrice > 0)
                                                        KES {{ number_format($minPrice) }}
                                                    @else
                                                        Free Entry
                                                    @endif
                                                </span>
                                                <span class="cta-text text-sm font-semibold pr-2">Get Tickets</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="absolute top-3 right-3 rounded-lg bg-gray-900/90 px-2 py-1 text-center text-white backdrop-blur-sm border border-gray-700/50">
                                        <span class="block text-xs font-semibold">{{ $event->start_date->format('M') }}</span>
                                        <span class="block text-lg font-bold leading-tight">{{ $event->start_date->format('j') }}</span>
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

                <div class="mt-12 text-center">
                    <a href="{{ route('Browse') }}" class="inline-block rounded-full border border-primary-500 bg-primary-500/20 px-8 py-3 font-semibold text-primary-400 transition-colors hover:bg-primary-500 hover:text-white focus-visible-ring">
                        View All Events
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
