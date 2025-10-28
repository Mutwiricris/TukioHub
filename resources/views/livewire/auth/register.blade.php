<!-- Outstanding Registration Form with High Contrast -->
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-gray-900 to-black relative w-full overflow-hidden flex items-center justify-center">
  <!-- Enhanced Background Pattern -->
  <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-gray-900 to-black"></div>
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_70%,rgba(16,185,129,0.15),transparent_50%)]"></div>
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_30%,rgba(59,130,246,0.1),transparent_40%)]"></div>
  
  <!-- Enhanced Floating Elements -->
  <div class="absolute top-10 right-20 w-24 h-24 bg-gradient-to-r from-primary-500/20 to-blue-500/20 rounded-full blur-xl animate-pulse delay-300"></div>
  <div class="absolute bottom-32 left-16 w-28 h-28 bg-gradient-to-r from-primary-400/15 to-purple-500/15 rounded-full blur-2xl animate-pulse delay-700"></div>
  <div class="absolute top-1/3 right-1/4 w-20 h-20 bg-gradient-to-r from-primary-600/20 to-cyan-500/20 rounded-full blur-lg animate-pulse delay-1000"></div>
  <div class="absolute top-1/4 left-1/3 w-16 h-16 bg-gradient-to-r from-yellow-500/10 to-orange-500/10 rounded-full blur-lg animate-pulse delay-500"></div>

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
        <h2 class="text-3xl font-bold bg-gradient-to-r from-white via-gray-100 to-primary-200 bg-clip-text text-transparent mb-2">Join the community</h2>
        <p class="text-gray-300 text-base font-medium">Create your account and discover Kenya's best events</p>
      </div>

      <!-- Register Form -->
      <div class="relative">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-500/30 to-blue-500/20 rounded-2xl blur-xl"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-primary-400/10 to-purple-500/10 rounded-2xl blur-2xl"></div>
        <div class="relative rounded-2xl border border-white/20 bg-gray-800/60 backdrop-blur-xl p-6 shadow-2xl ring-1 ring-white/10">
          
          <!-- Session Status -->
          <x-auth-session-status class="text-center mb-3 text-sm" :status="session('status')" />

          <form wire:submit="register" class="space-y-3">
            <!-- Name -->
            <div class="space-y-2">
              <label for="name" class="block text-sm font-semibold text-gray-200">Full name</label>
              <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-primary-400 group-focus-within:text-primary-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                </div>
                <input
                  wire:model="name"
                  id="name"
                  type="text"
                  autocomplete="name"
                  required
                  autofocus
                  class="block w-full pl-10 pr-4 py-3 text-sm border-2 border-white/20 rounded-xl bg-white/10 text-white placeholder-gray-300 focus:border-primary-400 focus:ring-4 focus:ring-primary-500/20 focus:outline-none transition-all duration-300 hover:border-white/30 @error('name') border-red-400 focus:border-red-400 focus:ring-red-500/20 @enderror"
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

            <!-- Email & Phone -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
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
                    class="block w-full pl-10 pr-4 py-3 text-sm border-2 border-white/20 rounded-xl bg-white/10 text-white placeholder-gray-300 focus:border-primary-400 focus:ring-4 focus:ring-primary-500/20 focus:outline-none transition-all duration-300 hover:border-white/30 @error('email') border-red-400 focus:border-red-400 focus:ring-red-500/20 @enderror"
                    placeholder="your@email.com"
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

              <!-- Phone Number -->
              <div class="space-y-2">
                <label for="phone" class="block text-sm font-semibold text-gray-200">Phone number</label>
                <div class="relative group">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-primary-400 group-focus-within:text-primary-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                  </div>
                  <input
                    wire:model="phone"
                    id="phone"
                    type="tel"
                    autocomplete="tel"
                    required
                    class="block w-full pl-10 pr-4 py-3 text-sm border-2 border-white/20 rounded-xl bg-white/10 text-white placeholder-gray-300 focus:border-primary-400 focus:ring-4 focus:ring-primary-500/20 focus:outline-none transition-all duration-300 hover:border-white/30 @error('phone') border-red-400 focus:border-red-400 focus:ring-red-500/20 @enderror"
                    placeholder="+254 700 000 000"
                  />
                </div>
                @error('phone')
                  <p class="text-sm text-red-400 flex items-center mt-1">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                  </p>
                @enderror
              </div>
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
                  autocomplete="new-password"
                  required
                  class="block w-full pl-10 pr-4 py-3 text-sm border-2 border-white/20 rounded-xl bg-white/10 text-white placeholder-gray-300 focus:border-primary-400 focus:ring-4 focus:ring-primary-500/20 focus:outline-none transition-all duration-300 hover:border-white/30 @error('password') border-red-400 focus:border-red-400 focus:ring-red-500/20 @enderror"
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
              <label for="password_confirmation" class="block text-sm font-semibold text-gray-200">Confirm password</label>
              <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-primary-400 group-focus-within:text-primary-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                <input
                  wire:model="password_confirmation"
                  id="password_confirmation"
                  type="password"
                  autocomplete="new-password"
                  required
                  class="block w-full pl-10 pr-4 py-3 text-sm border-2 border-white/20 rounded-xl bg-white/10 text-white placeholder-gray-300 focus:border-primary-400 focus:ring-4 focus:ring-primary-500/20 focus:outline-none transition-all duration-300 hover:border-white/30"
                  placeholder="Confirm your password"
                />
              </div>
            </div>

            <!-- Terms Agreement -->
            <div class="flex items-start space-x-3 p-4 rounded-xl bg-white/5 border-2 border-white/10 hover:border-white/20 transition-all duration-200">
              <div class="flex items-center h-5 mt-0.5">
                <input
                  id="terms"
                  name="terms"
                  type="checkbox"
                  required
                  class="h-4 w-4 rounded border-2 border-primary-400/50 bg-white/10 text-primary-500 focus:ring-4 focus:ring-primary-500/20 focus:ring-offset-0 transition-all duration-200"
                />
              </div>
              <div class="text-sm leading-relaxed">
                <label for="terms" class="text-gray-200 font-medium cursor-pointer">
                  I agree to the
                  <a href="#" class="text-primary-400 hover:text-primary-300 hover:underline font-semibold transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:ring-offset-2 focus:ring-offset-gray-800 rounded px-1">Terms of Service</a>
                  and
                  <a href="#" class="text-primary-400 hover:text-primary-300 hover:underline font-semibold transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:ring-offset-2 focus:ring-offset-gray-800 rounded px-1">Privacy Policy</a>
                </label>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
              <button
                type="submit"
                class="group relative w-full flex justify-center py-4 px-6 border-2 border-transparent rounded-2xl text-base font-bold text-white bg-gradient-to-r from-green-500 via-gray-600 to-green-400 hover:from-primary-600 hover:via-primary-700 hover:to-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-500/50 focus:ring-offset-2 focus:ring-offset-gray-800 transform transition-all duration-300 hover:scale-[1.02] active:scale-[0.98] shadow-2xl hover:shadow-primary-500/40 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                <span class="absolute left-0 inset-y-0 flex items-center pl-4">
                  <svg class="h-6 w-6 text-white/80 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                  </svg>
                </span>
                <span class="relative">Create your Tukio Hub account</span>
                <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-white/0 via-white/10 to-white/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              </button>
            </div>
          </form>

          <!-- Login Link -->
          <div class="mt-8 text-center">
            <p class="text-base text-gray-300">
              Already have an account?
              <a href="{{ route('login') }}" wire:navigate class="font-bold text-primary-400 hover:text-primary-300 hover:underline transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:ring-offset-2 focus:ring-offset-gray-800 rounded px-2 py-1">
                Sign in here
              </a>
            </p>
          </div>
        </div>
      </div>

      <!-- Benefits -->
      <div class="text-center text space-y-4">
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
