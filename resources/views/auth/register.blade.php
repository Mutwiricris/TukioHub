@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 relative overflow-hidden">
  <!-- Background Pattern -->
  <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900"></div>
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_70%,rgba(16,185,129,0.1),transparent_50%)]"></div>
  
  <!-- Floating Elements -->
  <div class="absolute top-10 right-20 w-24 h-24 bg-primary-500/10 rounded-full blur-xl animate-pulse delay-300"></div>
  <div class="absolute bottom-32 left-16 w-28 h-28 bg-primary-400/5 rounded-full blur-2xl animate-pulse delay-700"></div>
  <div class="absolute top-1/3 right-1/4 w-20 h-20 bg-primary-600/10 rounded-full blur-lg animate-pulse delay-1000"></div>

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
        <h2 class="text-3xl font-bold bg-gradient-to-r from-white to-gray-200 bg-clip-text text-transparent">Join the community</h2>
        <p class="mt-3 text-gray-400">Create your account and discover Kenya's best events</p>
      </div>

      <!-- Register Form -->
      <div class="relative">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-500/20 to-primary-400/20 rounded-2xl blur-xl"></div>
        <div class="relative rounded-2xl border border-white/10 bg-gray-800/50 p-8 shadow-2xl backdrop-blur-xl">
          <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div class="space-y-2">
              <label for="name" class="block text-sm font-medium text-gray-300">Full name</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                </div>
                <input
                  id="name"
                  name="name"
                  type="text"
                  autocomplete="name"
                  required
                  value="{{ old('name') }}"
                  class="block w-full pl-10 pr-3 py-3 border border-white/10 rounded-xl bg-white/5 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/50 focus:outline-none transition-all duration-200 @error('name') border-red-500 @enderror"
                  placeholder="Enter your full name"
                />
              </div>
              @error('name')
                <p class="text-sm text-red-400 flex items-center mt-1">
                  <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                  </svg>
                  {{ $message }}
                </p>
              @enderror
            </div>

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
                  autocomplete="new-password"
                  required
                  class="block w-full pl-10 pr-3 py-3 border border-white/10 rounded-xl bg-white/5 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/50 focus:outline-none transition-all duration-200 @error('password') border-red-500 @enderror"
                  placeholder="Create a strong password"
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

            <!-- Confirm Password -->
            <div class="space-y-2">
              <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirm password</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                <input
                  id="password_confirmation"
                  name="password_confirmation"
                  type="password"
                  autocomplete="new-password"
                  required
                  class="block w-full pl-10 pr-3 py-3 border border-white/10 rounded-xl bg-white/5 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/50 focus:outline-none transition-all duration-200"
                  placeholder="Confirm your password"
                />
              </div>
            </div>

            <!-- Terms Agreement -->
            <div class="flex items-start space-x-3 p-4 rounded-lg bg-white/5 border border-white/10">
              <div class="flex items-center h-5">
                <input
                  id="terms"
                  name="terms"
                  type="checkbox"
                  required
                  class="h-4 w-4 rounded border-gray-600 bg-gray-700 text-primary-500 focus:ring-primary-500 focus:ring-offset-gray-900"
                />
              </div>
              <div class="text-sm">
                <label for="terms" class="text-gray-300">
                  I agree to the
                  <a href="#" class="text-primary-400 hover:text-primary-300 transition-colors">Terms of Service</a>
                  and
                  <a href="#" class="text-primary-400 hover:text-primary-300 transition-colors">Privacy Policy</a>
                </label>
              </div>
            </div>

            <!-- Submit Button -->
            <button
              type="submit"
              class="group relative w-full flex justify-center py-3 px-4 border border-transparent rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 focus:ring-offset-gray-900 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-primary-500/25"
            >
              <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-primary-200 group-hover:text-primary-100 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
              </span>
              Create your Tukio Hub account
            </button>
          </form>

          <!-- Login Link -->
          <div class="mt-6 text-center">
            <p class="text-sm text-gray-400">
              Already have an account?
              <a href="{{ route('login') }}" class="font-medium text-primary-400 hover:text-primary-300 transition-colors">
                Sign in here
              </a>
            </p>
          </div>
        </div>
      </div>

      <!-- Benefits -->
      <div class="text-center space-y-4">
        <p class="text-sm text-gray-400">Join thousands of event enthusiasts and enjoy:</p>
        <div class="grid grid-cols-1 gap-3 text-sm">
          <div class="flex items-center justify-center space-x-2 text-gray-300">
            <div class="w-8 h-8 bg-primary-500/20 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
              </svg>
            </div>
            <span>Easy ticket booking & management</span>
          </div>
          <div class="flex items-center justify-center space-x-2 text-gray-300">
            <div class="w-8 h-8 bg-primary-500/20 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19l5-5 5 5H4z"></path>
              </svg>
            </div>
            <span>Instant M-Pesa payments</span>
          </div>
          <div class="flex items-center justify-center space-x-2 text-gray-300">
            <div class="w-8 h-8 bg-primary-500/20 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19l5-5 5 5H4z"></path>
              </svg>
            </div>
            <span>Personalized event recommendations</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
