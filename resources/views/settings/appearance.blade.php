@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-zinc-900 text-zinc-200">
    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <nav class="flex items-center gap-2 text-sm text-gray-400 mb-4">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-white">Appearance Settings</span>
            </nav>
            <h1 class="text-3xl font-bold text-white">Appearance Settings</h1>
            <p class="mt-2 text-gray-400">Customize how TukioHub looks and feels</p>
        </div>

        <!-- Settings Navigation -->
        <div class="mb-8">
            <div class="flex space-x-1 rounded-xl bg-white/5 p-1">
                <a href="{{ route('settings.profile') }}" class="flex-1 rounded-lg px-3 py-2 text-center text-sm font-medium text-gray-400 hover:text-white transition-colors">
                    Profile
                </a>
                <a href="{{ route('settings.password') }}" class="flex-1 rounded-lg px-3 py-2 text-center text-sm font-medium text-gray-400 hover:text-white transition-colors">
                    Password
                </a>
                <a href="{{ route('settings.appearance') }}" class="flex-1 rounded-lg bg-primary-500 px-3 py-2 text-center text-sm font-medium text-white transition-colors">
                    Appearance
                </a>
            </div>
        </div>

        <!-- Appearance Settings Form -->
        <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-6">
            <div class="flex items-center gap-4 mb-6">
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-purple-500 to-indigo-500 text-white">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-white">Appearance Preferences</h2>
                    <p class="text-sm text-gray-400">Customize the look and feel of your TukioHub experience</p>
                </div>
            </div>

            @livewire('settings.appearance')
        </div>
    </div>
</div>
@endsection
