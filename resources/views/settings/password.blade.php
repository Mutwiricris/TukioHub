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
                <span class="text-white">Password Settings</span>
            </nav>
            <h1 class="text-3xl font-bold text-white">Password Settings</h1>
            <p class="mt-2 text-gray-400">Update your password to keep your account secure</p>
        </div>

        <!-- Settings Navigation -->
        <div class="mb-8">
            <div class="flex space-x-1 rounded-xl bg-white/5 p-1">
                <a href="{{ route('settings.profile') }}" class="flex-1 rounded-lg px-3 py-2 text-center text-sm font-medium text-gray-400 hover:text-white transition-colors">
                    Profile
                </a>
                <a href="{{ route('settings.password') }}" class="flex-1 rounded-lg bg-primary-500 px-3 py-2 text-center text-sm font-medium text-white transition-colors">
                    Password
                </a>
                <a href="{{ route('settings.appearance') }}" class="flex-1 rounded-lg px-3 py-2 text-center text-sm font-medium text-gray-400 hover:text-white transition-colors">
                    Appearance
                </a>
            </div>
        </div>

        <!-- Password Settings Form -->
        <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-6">
            <div class="flex items-center gap-4 mb-6">
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-red-500 to-pink-500 text-white">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-white">Change Password</h2>
                    <p class="text-sm text-gray-400">Ensure your account is using a long, random password to stay secure</p>
                </div>
            </div>

            @livewire('settings.password')
        </div>
    </div>
</div>
@endsection
