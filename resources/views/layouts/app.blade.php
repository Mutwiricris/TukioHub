<!doctype html>
<html lang="en" class="dark scroll-smooth">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Tukio Hub | The Future of Events in Kenya</title>
    <meta name="description" content="Experience the next generation of event discovery. Find and book tickets for concerts, festivals, and exclusive experiences with instant M-Pesa checkout." />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,700&display=swap" rel="stylesheet">

    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2334d399' stroke-width='2'%3E%3Cpath d='M3 10a2 2 0 1 0 0 4v3a2 2 0 0 0 2 2h9l7-7-7-7H5a2 2 0 0 0-2 2v3Z'/%3E%3C/svg%3E">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
{{-- Simple library for generating barcodes --}}
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
{{-- Library for generating QR Codes --}}
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.1/build/qrcode.min.js"></script>
    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            fontFamily: {
              sans: ['DM Sans', 'sans-serif'],
            },
            colors: {
              primary: {
                // Vibrant Green, good for dark mode
                400: '#34d399',
                500: '#10b981',
                600: '#059669',
              },
              gray: { // Custom gray scale for dark mode
                900: '#111111',
                800: '#18181B',
                700: '#262626',
                600: '#3F3F46',
                400: '#A1A1AA',
                200: '#E4E4E7',
              }
            },
            animation: {
              'aurora': 'aurora 60s linear infinite',
            },
            keyframes: {
              aurora: {
                'from': { 'background-position': '0% 50%' },
                'to': { 'background-position': '200% 50%' },
              }
            }
          }
        }
      }
    </script>
    <style>
      .card-glow:hover {
        box-shadow: 0 0 20px 0 rgba(16, 185, 129, 0.3), 0 0 5px 0 rgba(16, 185, 129, 0.2);
      }
      .focus-visible-ring:focus-visible {
        outline: 2px solid theme('colors.primary.400');
        outline-offset: 2px;
      }
    </style>
  </head>
  <body class="bg-gray-900 text-gray-200 antialiased font-sans">

    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
      <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(34,197,94,0.3),rgba(255,255,255,0))]"></div>
      <div class="w-full h-full bg-[radial-gradient(at_20%_90%,hsla(160,70%,40%,0.2)_0px,transparent_50%),radial-gradient(at_80%_20%,hsla(200,70%,50%,0.2)_0px,transparent_50%),radial-gradient(at_50%_50%,hsla(340,70%,60%,0.15)_0px,transparent_50%)] animate-aurora"></div>
    </div>

    <header class="sticky top-4 z-50">
      <div class="mx-auto max-w-7xl px-4">
        <div class="flex items-center justify-between gap-4 rounded-2xl border border-white/10 bg-black/30 px-4 py-3 shadow-xl backdrop-blur-lg">
          <a href="{{ route('home') }}" class="flex items-center gap-3 focus-visible-ring rounded-lg" aria-label="Tukio Hub Homepage">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-primary-500 to-primary-400 text-white">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 10a2 2 0 1 0 0 4v3a2 2 0 0 0 2 2h9l7-7-7-7H5a2 2 0 0 0-2 2v3Z" /></svg>
            </div>
            <span class="text-xl font-bold tracking-tight text-white">
              Tukio<span class="text-primary-400">Hub</span>
            </span>
          </a>

          <nav class="hidden items-center gap-2 lg:flex">
            <a href="{{ route('Browse') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition-colors hover:text-white focus-visible-ring">Browse</a>
            <a href="{{ route('Browse') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition-colors hover:text-white focus-visible-ring">Explore</a>
            <a href="{{ route('Browse') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition-colors hover:text-white focus-visible-ring">Concerts</a>
            <a href="{{ route('Tickets') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition-colors hover:text-white focus-visible-ring">My Tickets</a>
          </nav>

          <div class="hidden items-center gap-4 lg:flex">
            @auth
              <a href="{{ route('Tickets') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition-colors hover:text-white focus-visible-ring">My Tickets</a>
              <div class="relative group">
                <button class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition-colors hover:text-white focus-visible-ring">
                  {{ Auth::user()->name }}
                  <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
                </button>
                <div class="absolute right-0 mt-2 w-48 rounded-lg border border-white/10 bg-gray-800/90 backdrop-blur-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
                  <a href="{{ route('settings.profile') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/10 hover:text-white">Settings</a>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-white/10 hover:text-white">
                      Sign out
                    </button>
                  </form>
                </div>
              </div>
            @else
              <a href="{{ route('login') }}" class="rounded-lg px-4 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-white/10 focus-visible-ring">Login</a>
              <a href="{{ route('register') }}" class="rounded-lg bg-primary-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg transition-all hover:bg-primary-400 hover:shadow-primary-400/40 focus-visible-ring">
                Sign Up
              </a>
            @endauth
          </div>

          <!-- Mobile Navigation Controls -->
          <div class="flex items-center gap-2 lg:hidden">
            @auth
              <!-- Mobile Profile Button -->
              <button id="mobile-profile-btn" class="rounded-lg p-2 text-gray-300 hover:bg-white/10 focus-visible-ring">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </button>
            @else
              <!-- Mobile Login Button -->
              <a href="{{ route('login') }}" class="rounded-lg p-2 text-gray-300 hover:bg-white/10 focus-visible-ring">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
              </a>
            @endauth

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="rounded-lg p-2 text-gray-300 hover:bg-white/10 focus-visible-ring">
              <svg id="menu-icon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
              </svg>
              <svg id="close-icon" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="mt-4 hidden rounded-2xl border border-white/10 bg-black/30 backdrop-blur-lg shadow-xl lg:hidden">
          <div class="px-4 py-6 space-y-4">
            <!-- Navigation Links -->
            <div class="space-y-2">
              <a href="{{ route('Browse') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition-colors hover:bg-white/10 hover:text-white">Browse Events</a>
              <a href="#" class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition-colors hover:bg-white/10 hover:text-white">Explore</a>
              <a href="#" class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition-colors hover:bg-white/10 hover:text-white">Concerts</a>
              @auth
                <a href="{{ route('Tickets') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition-colors hover:bg-white/10 hover:text-white">My Tickets</a>
              @endauth
            </div>

            <!-- Auth Section -->
            <div class="border-t border-white/10 pt-4">
              @auth
                <div class="space-y-2">
                  <div class="px-3 py-2">
                    <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                  </div>
                  <a href="{{ route('settings.profile') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition-colors hover:bg-white/10 hover:text-white">
                    <svg class="inline h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Settings
                  </a>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition-colors hover:bg-white/10 hover:text-white">
                      <svg class="inline h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                      </svg>
                      Sign out
                    </button>
                  </form>
                </div>
              @else
                <div class="space-y-2">
                  <a href="{{ route('login') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition-colors hover:bg-white/10 hover:text-white">
                    <svg class="inline h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    Login
                  </a>
                  <a href="{{ route('register') }}" class="block rounded-lg bg-primary-500 px-3 py-2 text-sm font-semibold text-white shadow-lg transition-all hover:bg-primary-400">
                    <svg class="inline h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM3 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 019.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>
                    Sign Up
                  </a>
                </div>
              @endauth
            </div>
          </div>
        </div>

        <!-- Mobile Profile Menu (for authenticated users) -->
        @auth
        <div id="mobile-profile-menu" class="mt-4 hidden rounded-2xl border border-white/10 bg-black/30 backdrop-blur-lg shadow-xl lg:hidden">
          <div class="px-4 py-6">
            <div class="flex items-center gap-3 mb-4">
              <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary-500 text-white font-semibold">
                {{ substr(Auth::user()->name, 0, 1) }}
              </div>
              <div>
                <p class="font-medium text-white">{{ Auth::user()->name }}</p>
                <p class="text-sm text-gray-400">{{ Auth::user()->email }}</p>
              </div>
            </div>
            <div class="space-y-2">
              <a href="{{ route('Tickets') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition-colors hover:bg-white/10 hover:text-white">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                </svg>
                My Tickets
              </a>
              <a href="{{ route('settings.profile') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition-colors hover:bg-white/10 hover:text-white">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Settings
              </a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition-colors hover:bg-white/10 hover:text-white">
                  <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                  </svg>
                  Sign out
                </button>
              </form>
            </div>
          </div>
        </div>
        @endauth
      </div>
    </header>

    <main>

    @yield('content')


    <style>
    .filter-btn {
        @apply bg-white/5 text-gray-300 hover:bg-white/10;
    }
    .filter-btn.active-filter {
        @apply bg-primary-500 text-white;
    }
    .event-card {
        transition: opacity 0.4s ease-in-out, transform 0.4s ease-in-out;
    }
    .event-card.hidden {
        opacity: 0;
        transform: scale(0.95);
        display: none;
    }
    .cta-button .cta-text {
        max-width: 0;
        opacity: 0;
        transition: max-width 0.4s ease-in-out, opacity 0.2s ease-in-out;
        white-space: nowrap;
        overflow: hidden;
    }
    .group:hover .cta-button .cta-text {
        max-width: 100px; /* Adjust as needed */
        opacity: 1;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Functionality
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileProfileBtn = document.getElementById('mobile-profile-btn');
    const mobileProfileMenu = document.getElementById('mobile-profile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');

    let isMenuOpen = false;
    let isProfileMenuOpen = false;

    // Toggle mobile menu
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            isMenuOpen = !isMenuOpen;

            if (isMenuOpen) {
                mobileMenu.classList.remove('hidden');
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
                // Close profile menu if open
                if (isProfileMenuOpen && mobileProfileMenu) {
                    mobileProfileMenu.classList.add('hidden');
                    isProfileMenuOpen = false;
                }
            } else {
                mobileMenu.classList.add('hidden');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });
    }

    // Toggle mobile profile menu
    if (mobileProfileBtn && mobileProfileMenu) {
        mobileProfileBtn.addEventListener('click', () => {
            isProfileMenuOpen = !isProfileMenuOpen;

            if (isProfileMenuOpen) {
                mobileProfileMenu.classList.remove('hidden');
                // Close main menu if open
                if (isMenuOpen && mobileMenu) {
                    mobileMenu.classList.add('hidden');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                    isMenuOpen = false;
                }
            } else {
                mobileProfileMenu.classList.add('hidden');
            }
        });
    }

    // Close menus when clicking outside
    document.addEventListener('click', (e) => {
        if (mobileMenu && !mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target) && isMenuOpen) {
            mobileMenu.classList.add('hidden');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            isMenuOpen = false;
        }

        if (mobileProfileMenu && !mobileProfileMenu.contains(e.target) && !mobileProfileBtn.contains(e.target) && isProfileMenuOpen) {
            mobileProfileMenu.classList.add('hidden');
            isProfileMenuOpen = false;
        }
    });

    // Event filtering functionality (existing code)
    const filterContainer = document.getElementById('event-filters');
    const eventGrid = document.getElementById('event-grid');

    if (filterContainer && eventGrid) {
        const filterButtons = filterContainer.querySelectorAll('.filter-btn');
        const eventCards = eventGrid.querySelectorAll('.event-card');

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Update active button style
                filterButtons.forEach(btn => btn.classList.remove('active-filter'));
                button.classList.add('active-filter');

                const filterValue = button.getAttribute('data-filter');

                // Filter logic
                eventCards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');
                    const isFeatured = card.classList.contains('md:col-span-2');

                    // For a smooth animation, we first hide, then after a delay, remove the 'hidden' class
                    const shouldShow = (filterValue === 'all' || cardCategory === filterValue);

                    if (!shouldShow) {
                        card.classList.add('hidden');
                    } else {
                        // We need a small delay for the display:none to not interfere with the transition
                        setTimeout(() => {
                             card.classList.remove('hidden');
                        }, 10);
                    }
                });
            });
        });
    }
});
</script>
    </main>

    <footer class="border-t border-white/10">
      <div class="mx-auto max-w-7xl px-4 py-16 sm:py-24">
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-3">
          <div class="lg:col-span-1">
              <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-primary-500 to-primary-400 text-white"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 10a2 2 0 1 0 0 4v3a2 2 0 0 0 2 2h9l7-7-7-7H5a2 2 0 0 0-2 2v3Z" /></svg></div>
                <span class="text-xl font-bold text-white">Tukio<span class="text-primary-400">Hub</span></span>
              </div>
              <p class="mt-4 text-gray-400">The home of Kenya's most vibrant events.</p>
              <div class="mt-6">
                <h4 class="font-semibold text-white">Are you an organizer?</h4>
                <p class="mt-1 text-gray-400">Reach thousands and manage your event with ease.</p>
                <a href="#" class="mt-3 inline-block rounded-lg bg-primary-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg transition-all hover:bg-primary-400 focus-visible-ring">Create Your Event</a>
              </div>
          </div>

          <div class="grid grid-cols-2 gap-8 sm:grid-cols-3 lg:col-span-2">
              <div>
                <h3 class="font-semibold text-white">Discover</h3>
                <ul class="mt-4 space-y-3">
                  <li><a href="#" class="text-gray-400 transition-colors hover:text-white">This Weekend</a></li>
                  <li><a href="#" class="text-gray-400 transition-colors hover:text-white">Music & Concerts</a></li>
                  <li><a href="#" class="text-gray-400 transition-colors hover:text-white">Tech & Business</a></li>
                  <li><a href="#" class="text-gray-400 transition-colors hover:text-white">Food & Drink</a></li>
                </ul>
              </div>
              <div>
                <h3 class="font-semibold text-white">Company</h3>
                <ul class="mt-4 space-y-3">
                  <li><a href="#" class="text-gray-400 transition-colors hover:text-white">About Us</a></li>
                  <li><a href="#" class="text-gray-400 transition-colors hover:text-white">Careers</a></li>
                  <li><a href="#" class="text-gray-400 transition-colors hover:text-white">Blog</a></li>
                  <li><a href="#" class="text-gray-400 transition-colors hover:text-white">Press</a></li>
                </ul>
              </div>
              <div>
                <h3 class="font-semibold text-white">Support</h3>
                <ul class="mt-4 space-y-3">
                  <li><a href="#" class="text-gray-400 transition-colors hover:text-white">Help Center</a></li>
                  <li><a href="#" class="text-gray-400 transition-colors hover:text-white">Contact Us</a></li>
                  <li><a href="#" class="text-gray-400 transition-colors hover:text-white">Refund Policy</a></li>
                  <li><a href="#" class="text-gray-400 transition-colors hover:text-white">Terms & Privacy</a></li>
                </ul>
              </div>
          </div>
        </div>

        <div class="mt-16 border-t border-white/10 pt-8 text-center text-sm text-gray-400">
          <p>&copy; 2025 Tukio Hub. All rights reserved. Made with ❤️ in Nairobi, Kenya.</p>
        </div>
      </div>
    </footer>

  </body>
</html>
