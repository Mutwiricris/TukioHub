@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-md w-full space-y-8">
    <!-- Header -->
    <div class="text-center">
      <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-yellow-500/10 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="m21 16-4 4-4-4"/>
          <path d="M17 20V4"/>
          <path d="m3 8 4-4 4 4"/>
          <path d="M7 4v16"/>
        </svg>
      </div>

      <h2 class="text-3xl font-bold text-white">Confirm your password</h2>
      <p class="mt-2 text-sm text-gray-400">This is a secure area of the application. Please confirm your password before continuing.</p>
    </div>

    <!-- Confirm Password Form -->
    <div class="rounded-2xl border border-white/10 bg-gray-800/50 p-8 shadow-2xl backdrop-blur-lg">
      <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
          <input
            id="password"
            name="password"
            type="password"
            autocomplete="current-password"
            required
            autofocus
            class="mt-1 block w-full rounded-lg border border-white/10 bg-white/5 px-3 py-3 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/50 focus:outline-none @error('password') border-red-500 @enderror"
            placeholder="Enter your password"
          />
          @error('password')
            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
          @enderror
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-primary-500 hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 focus:ring-offset-gray-900 transition-colors"
        >
          Confirm
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
