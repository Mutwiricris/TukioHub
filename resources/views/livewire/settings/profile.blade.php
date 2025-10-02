<div>
    <form wire:submit="updateProfileInformation" class="space-y-6">
        {{-- Name Input --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                <svg class="inline h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Full Name
            </label>
            <input 
                wire:model="name" 
                id="name" 
                name="name" 
                type="text" 
                required 
                autofocus 
                autocomplete="name" 
                placeholder="Enter your full name"
                class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/50 focus:outline-none transition-colors" 
            />
            @error('name') 
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p> 
            @enderror
        </div>

        {{-- Email Input --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                <svg class="inline h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                </svg>
                Email Address
            </label>
            <input 
                wire:model="email" 
                id="email" 
                name="email" 
                type="email" 
                required 
                autocomplete="email" 
                placeholder="Enter your email address"
                class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/50 focus:outline-none transition-colors" 
            />
            @error('email') 
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p> 
            @enderror

            {{-- Email Verification Status --}}
            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                <div class="mt-3 p-3 rounded-lg bg-yellow-500/10 border border-yellow-500/20">
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                        <p class="text-sm text-yellow-300">Your email address is unverified.</p>
                    </div>
                    <button 
                        wire:click.prevent="resendVerificationNotification" 
                        class="mt-2 text-sm text-primary-400 hover:text-primary-300 underline transition-colors"
                    >
                        Click here to re-send the verification email
                    </button>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-400">
                            ✓ A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Phone Input --}}
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-300 mb-2">
                <svg class="inline h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                Phone Number
            </label>
            <input 
                wire:model="phone" 
                id="phone" 
                name="phone" 
                type="tel" 
                autocomplete="tel" 
                placeholder="Enter your phone number (optional)"
                class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/50 focus:outline-none transition-colors" 
            />
            @error('phone') 
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p> 
            @enderror
            <p class="mt-1 text-xs text-gray-400">We'll use this for important account notifications</p>
        </div>

        {{-- Save Button & Status Message --}}
        <div class="flex items-center justify-between pt-4">
            <div class="flex items-center gap-4">
                <button 
                    type="submit" 
                    class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-primary-400 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all hover:from-primary-400 hover:to-primary-300 hover:shadow-xl hover:shadow-primary-500/20 focus:outline-none focus:ring-2 focus:ring-primary-500/50"
                    wire:loading.attr="disabled"
                >
                    <svg wire:loading.remove class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <svg wire:loading class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove>Save Changes</span>
                    <span wire:loading>Saving...</span>
                </button>

                <div 
                    x-data="{ show: false }" 
                    x-show="show" 
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90"
                    x-init="@this.on('profile-updated', () => { show = true; setTimeout(() => show = false, 3000) })"
                    class="flex items-center gap-2 text-green-400"
                >
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm font-medium">Profile updated successfully!</span>
                </div>
            </div>
        </div>
    </form>
</div>
