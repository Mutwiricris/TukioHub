@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 relative overflow-hidden">
  <!-- Background Pattern -->
  <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900"></div>
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(16,185,129,0.1),transparent_50%)]"></div>
  
  <!-- Floating Elements -->
  <div class="absolute top-20 left-10 w-20 h-20 bg-primary-500/10 rounded-full blur-xl animate-pulse"></div>
  <div class="absolute bottom-20 right-10 w-32 h-32 bg-primary-400/5 rounded-full blur-2xl animate-pulse delay-1000"></div>
  <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-primary-600/10 rounded-full blur-lg animate-pulse delay-500"></div>

  <div class="relative flex items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <!-- Logo & Header -->
      <div class="text-center">
        <div class="flex justify-center mb-6">
          <div class="flex items-center space-x-2">
            <div class="w-10 h-10 bg-gradient-to-br from-primary-400 to-primary-600 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
              </svg>
            </div>
            <span class="text-2xl font-bold bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">Tukio Hub</span>
          </div>
        </div>
        <h2 class="text-3xl font-bold bg-gradient-to-r from-white to-gray-200 bg-clip-text text-transparent">Welcome back</h2>
        <p class="mt-3 text-gray-400">Sign in to discover amazing events in Kenya</p>
      </div>

      <!-- Login Form -->
      <div class="relative">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-500/20 to-primary-400/20 rounded-2xl blur-xl"></div>
        <div class="relative rounded-2xl border border-white/10 bg-gray-800/50 p-8 shadow-2xl backdrop-blur-xl">
          <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email -->
            <div class="space-y-2">
              <label for="email" class="block text-sm font-medium text-gray-300">Email address</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                  </svg>
                </div>
                <input 
                  id="email" 
                  name="email" 
                  type="email" 
                  autocomplete="email" 
                  required 
                  value="{{ old('email') }}"
                  class="block w-full pl-10 pr-3 py-3 border border-white/10 rounded-xl bg-white/5 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/50 focus:outline-none transition-all duration-200 @error('email') border-red-500 @enderror"
                  placeholder="Enter your email"
                />
              </div>
              @error('email')
                <p class="text-sm text-red-400 flex items-center mt-1">
                  <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                  </svg>
                  {{ $message }}
                </p>
              @enderror
            </div>

            <!-- Password -->
            <div class="space-y-2">
              <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                  </svg>
                </div>
                <input 
                  id="password" 
                  name="password" 
                  type="password" 
                  autocomplete="current-password" 
                  required
                  class="block w-full pl-10 pr-3 py-3 border border-white/10 rounded-xl bg-white/5 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/50 focus:outline-none transition-all duration-200 @error('password') border-red-500 @enderror"
                  placeholder="Enter your password"
                />
              </div>
              @error('password')
                <p class="text-sm text-red-400 flex items-center mt-1">
                  <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                  </svg>
                  {{ $message }}
                </p>
              @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <input 
                  id="remember_me" 
                  name="remember" 
                  type="checkbox" 
                  class="h-4 w-4 rounded border-gray-600 bg-gray-700 text-primary-500 focus:ring-primary-500 focus:ring-offset-gray-900"
                />
                <label for="remember_me" class="ml-2 block text-sm text-gray-300">Remember me</label>
              </div>

              @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-primary-400 hover:text-primary-300 transition-colors">
                  Forgot password?
                </a>
              @endif
            </div>

            <!-- Submit Button -->
            <button 
              type="submit" 
              class="group relative w-full flex justify-center py-3 px-4 border border-transparent rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 focus:ring-offset-gray-900 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-primary-500/25"
            >
              <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-primary-200 group-hover:text-primary-100 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
              </span>
              Sign in to Tukio Hub
            </button>
          </form>

          <!-- Register Link -->
          <div class="mt-6 text-center">
            <p class="text-sm text-gray-400">
              Don't have an account?
              <a href="{{ route('register') }}" class="font-medium text-primary-400 hover:text-primary-300 transition-colors">
                Create one now
              </a>
            </p>
          </div>
        </div>
      </div>

      <!-- Features -->
      <div class="text-center space-y-4">
        <div class="flex justify-center space-x-8 text-xs text-gray-500">
          <div class="flex items-center space-x-1">
            <svg class="w-4 h-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
            <span>Secure</span>
          </div>
          <div class="flex items-center space-x-1">
            <svg class="w-4 h-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <span>Fast</span>
          </div>
          <div class="flex items-center space-x-1">
            <svg class="w-4 h-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
            <span>Trusted</span>
          </div>
        </div>
        <p class="text-xs text-gray-500">
          By signing in, you agree to our 
          <a href="#" class="text-primary-400 hover:text-primary-300 transition-colors">Terms of Service</a> 
          and 
          <a href="#" class="text-primary-400 hover:text-primary-300 transition-colors">Privacy Policy</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
