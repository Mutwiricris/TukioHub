@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 relative overflow-hidden">
  <!-- Background Pattern -->
  <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900"></div>
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_60%_40%,rgba(16,185,129,0.1),transparent_50%)]"></div>
  
  <!-- Floating Elements -->
  <div class="absolute top-16 left-16 w-20 h-20 bg-primary-500/10 rounded-full blur-xl animate-pulse delay-200"></div>
  <div class="absolute bottom-24 right-20 w-24 h-24 bg-primary-400/5 rounded-full blur-2xl animate-pulse delay-800"></div>

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

        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-primary-500/20 to-primary-400/20 mb-6 backdrop-blur-sm border border-primary-500/20">
          <svg class="h-8 w-8 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
          </svg>
        </div>

        <h2 class="text-3xl font-bold bg-gradient-to-r from-white to-gray-200 bg-clip-text text-transparent">Check your email</h2>
        <p class="mt-3 text-gray-400">We've sent a verification link to your email address</p>
      </div>

      <!-- Status Message -->
      @if (session('status') == 'verification-link-sent')
        <div class="relative">
          <div class="absolute inset-0 bg-gradient-to-r from-primary-500/20 to-primary-400/20 rounded-xl blur-lg"></div>
          <div class="relative rounded-xl bg-primary-500/10 border border-primary-500/20 p-4 backdrop-blur-sm">
            <div class="flex items-center space-x-2">
              <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <p class="text-sm text-primary-300">A new verification link has been sent to your email address.</p>
            </div>
          </div>
        </div>
      @endif

      <!-- Actions -->
      <div class="relative">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-500/20 to-primary-400/20 rounded-2xl blur-xl"></div>
        <div class="relative rounded-2xl border border-white/10 bg-gray-800/50 p-8 shadow-2xl backdrop-blur-xl space-y-4">
          <!-- Resend Verification Email -->
          <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button
              type="submit"
              class="group relative w-full flex justify-center py-3 px-4 border border-transparent rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 focus:ring-offset-gray-900 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-primary-500/25"
            >
              <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-primary-200 group-hover:text-primary-100 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
              </span>
              Resend Verification Email
            </button>
          </form>

          <!-- Logout -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
              type="submit"
              class="w-full flex justify-center py-3 px-4 border border-white/10 rounded-xl text-sm font-medium text-gray-300 bg-white/5 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white/20 focus:ring-offset-gray-900 transition-all duration-200"
            >
              <span class="flex items-center space-x-2">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span>Log Out</span>
              </span>
            </button>
          </form>
        </div>
      </div>

      <!-- Help Text -->
      <div class="text-center">
        <p class="text-xs text-gray-500">
          Didn't receive the email? Check your spam folder or
          <a href="#" class="text-primary-400 hover:text-primary-300 transition-colors">contact support</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
