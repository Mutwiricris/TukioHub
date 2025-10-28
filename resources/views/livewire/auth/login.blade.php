<!-- Outstanding Login Form with High Contrast -->
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-gray-900 to-black relative w-full overflow-hidden flex items-center justify-center">
  <!-- Enhanced Background Pattern -->
  <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-gray-900 to-black"></div>
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(16,185,129,0.15),transparent_50%)]"></div>
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(59,130,246,0.1),transparent_40%)]"></div>
  
  <!-- Enhanced Floating Elements -->
  <div class="absolute top-20 left-10 w-20 h-20 bg-gradient-to-r from-primary-500/20 to-blue-500/20 rounded-full blur-xl animate-pulse md:w-24 md:h-24"></div>
  <div class="absolute bottom-20 right-10 w-32 h-32 bg-gradient-to-r from-primary-400/15 to-purple-500/15 rounded-full blur-2xl animate-pulse delay-1000 md:w-40 md:h-40"></div>
  <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-gradient-to-r from-primary-600/20 to-cyan-500/20 rounded-full blur-lg animate-pulse delay-500 md:w-20 md:h-20"></div>
  <div class="absolute top-1/4 right-1/3 w-12 h-12 bg-gradient-to-r from-yellow-500/10 to-orange-500/10 rounded-full blur-lg animate-pulse delay-700"></div>

  <div class="relative w-full max-w-md mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="space-y-4">
      <!-- Logo & Header -->
      <div class="text-center">
        <div class="flex justify-center mb-6">
          <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-gradient-to-br from-primary-400 via-primary-500 to-primary-600 rounded-xl flex items-center justify-center shadow-lg shadow-primary-500/25 ring-2 ring-primary-400/20">
              <svg class="w-7 h-7 text-white drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
              </svg>
            </div>
            <span class="text-2xl font-bold bg-gradient-to-r from-white via-gray-100 to-primary-200 bg-clip-text text-transparent drop-shadow-sm">Tukio Hub</span>
          </div>
        </div>
        <h2 class="text-3xl font-bold bg-gradient-to-r from-white via-gray-100 to-primary-200 bg-clip-text text-transparent mb-2">Welcome back</h2>
        <p class="text-gray-300 text-base font-medium">Sign in to discover amazing events in Kenya</p>
      </div>

      <!-- Login Form -->
      <div class="relative">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-500/30 to-blue-500/20 rounded-2xl blur-xl"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-primary-400/10 to-purple-500/10 rounded-2xl blur-2xl"></div>
        <div class="relative rounded-2xl border border-white/20 bg-gray-800/60 backdrop-blur-xl p-6 shadow-2xl ring-1 ring-white/10">
          
          <!-- Session Status -->
          <x-auth-session-status class="text-center mb-3 text-sm" :status="session('status')" />

          <form wire:submit="login" class="space-y-3">
            <!-- Email -->
            <div class="space-y-2">
              <label for="email" class="block text-sm font-semibold text-gray-200">Email address</label>
              <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-primary-400 group-focus-within:text-primary-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                  </svg>
                </div>
                <input 
                  wire:model="email"
                  id="email" 
                  type="email" 
                  autocomplete="email" 
                  required 
                  autofocus
                  class="block w-full pl-10 pr-4 py-3 text-sm border-2 border-white/20 rounded-xl bg-white/10 text-white placeholder-gray-300 focus:border-primary-400 focus:ring-4 focus:ring-primary-500/20 focus:outline-none transition-all duration-300 hover:border-white/30 @error('email') border-red-400 focus:border-red-400 focus:ring-red-500/20 @enderror"
                  placeholder="Enter your email address"
                />
              </div>
              @error('email')
                <p class="text-sm text-red-400 flex items-center mt-1.5">
                  <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                  </svg>
                  {{ $message }}
                </p>
              @enderror
            </div>

            <!-- Password -->
            <div class="space-y-2">
              <label for="password" class="block text-sm font-semibold text-gray-200">Password</label>
              <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-primary-400 group-focus-within:text-primary-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                  </svg>
                </div>
                <input 
                  wire:model="password"
                  id="password" 
                  type="password" 
                  autocomplete="current-password" 
                  required
                  class="block w-full pl-10 pr-4 py-3 text-sm border-2 border-white/20 rounded-xl bg-white/10 text-white placeholder-gray-300 focus:border-primary-400 focus:ring-4 focus:ring-primary-500/20 focus:outline-none transition-all duration-300 hover:border-white/30 @error('password') border-red-400 focus:border-red-400 focus:ring-red-500/20 @enderror"
                  placeholder="Enter your password"
                />
              </div>
              @error('password')
                <p class="text-sm text-red-400 flex items-center mt-1.5">
                  <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                  </svg>
                  {{ $message }}
                </p>
              @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between pt-2">
              <div class="flex items-center">
                <input 
                  wire:model="remember"
                  id="remember_me" 
                  type="checkbox" 
                  class="h-4 w-4 rounded border-2 border-primary-400/50 bg-white/10 text-primary-500 focus:ring-4 focus:ring-primary-500/20 focus:ring-offset-0 transition-all duration-200"
                />
                <label for="remember_me" class="ml-3 block text-sm font-medium text-gray-200 cursor-pointer">Remember me</label>
              </div>

              @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" wire:navigate class="text-sm font-semibold text-primary-400 hover:text-primary-300 hover:underline transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:ring-offset-2 focus:ring-offset-gray-800 rounded px-1 py-0.5">
                  Forgot password?
                </a>
              @endif
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
              <button 
                type="submit" 
                class="group relative w-full flex justify-center py-4 px-6 border-2 border-transparent rounded-2xl text-base font-bold text-white bg-gradient-to-r from-green-500 via-gray-600 to-gray-400 hover:from-primary-600 hover:via-primary-700 hover:to-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-500/50 focus:ring-offset-2 focus:ring-offset-gray-800 transform transition-all duration-300 hover:scale-[1.02] active:scale-[0.98] shadow-2xl hover:shadow-primary-500/40 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                <span class="absolute left-0 inset-y-0 flex items-center pl-4">
                  <svg class="h-6 w-6 text-white/80 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                  </svg>
                </span>
                <span class="relative">Sign in to Tukio Hub</span>
                <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-white/0 via-white/10 to-white/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              </button>
            </div>
          </form>

          <!-- Register Link -->
          @if (Route::has('register'))
            <div class="mt-8 text-center">
              <p class="text-base text-gray-300">
                Don't have an account?
                <a href="{{ route('register') }}" wire:navigate class="font-bold text-primary-400 hover:text-primary-300 hover:underline transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:ring-offset-2 focus:ring-offset-gray-800 rounded px-2 py-1">
                  Create one now
                </a>
              </p>
            </div>
          @endif
        </div>
      </div>

      <!-- Features -->
      <div class="text-center space-y-4">
        <div class="flex justify-center space-x-6 sm:space-x-8 text-xs text-gray-500">
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