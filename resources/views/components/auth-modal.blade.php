{{-- Authentication Modal Component --}}
<div id="auth-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    {{-- Backdrop --}}
    <div class="flex min-h-screen items-center justify-center px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="closeAuthModal()"></div>

        {{-- Modal positioning --}}
        <span class="hidden sm:inline-block sm:h-screen sm:align-middle" aria-hidden="true">&#8203;</span>

        {{-- Modal content --}}
        <div class="relative inline-block transform overflow-hidden rounded-3xl bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 border border-white/10 px-4 pt-5 pb-4 text-left align-bottom shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-8 sm:align-middle">
            {{-- Close button --}}
            <div class="absolute right-4 top-4">
                <button type="button" onclick="closeAuthModal()" class="rounded-full bg-white/10 p-2 text-gray-400 hover:bg-white/20 hover:text-white transition-all duration-200">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Header with icon --}}
            <div class="text-center mb-8">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-r from-primary-500/20 to-green-500/20 mb-4">
                    <svg class="h-8 w-8 text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-2" id="modal-title">
                    Unlock Your Event Experience
                </h3>
                <p class="text-gray-400 text-sm">
                    Join thousands of event lovers and get exclusive access to amazing experiences
                </p>
            </div>

            {{-- Benefits section --}}
            <div class="mb-8">
                <div class="grid grid-cols-1 gap-4">
                    {{-- Benefit 1: Early Access --}}
                    <div class="flex items-center space-x-3 p-3 rounded-xl bg-gradient-to-r from-primary-500/10 to-transparent border border-primary-500/20">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-primary-500/20 flex items-center justify-center">
                                <svg class="h-4 w-4 text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">Early Bird Access</p>
                            <p class="text-xs text-gray-400">Get tickets before they sell out</p>
                        </div>
                    </div>

                    {{-- Benefit 2: Exclusive Discounts --}}
                    <div class="flex items-center space-x-3 p-3 rounded-xl bg-gradient-to-r from-green-500/10 to-transparent border border-green-500/20">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-green-500/20 flex items-center justify-center">
                                <svg class="h-4 w-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">Exclusive Discounts</p>
                            <p class="text-xs text-gray-400">Save up to 25% on premium events</p>
                        </div>
                    </div>

                    {{-- Benefit 3: Rewards Points --}}
                    <div class="flex items-center space-x-3 p-3 rounded-xl bg-gradient-to-r from-yellow-500/10 to-transparent border border-yellow-500/20">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-yellow-500/20 flex items-center justify-center">
                                <svg class="h-4 w-4 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">Reward Points</p>
                            <p class="text-xs text-gray-400">Earn points with every purchase</p>
                        </div>
                    </div>

                    {{-- Benefit 4: Personalized Recommendations --}}
                    <div class="flex items-center space-x-3 p-3 rounded-xl bg-gradient-to-r from-purple-500/10 to-transparent border border-purple-500/20">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-purple-500/20 flex items-center justify-center">
                                <svg class="h-4 w-4 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM9 17H4l5 5v-5zM12 3v12" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">Smart Notifications</p>
                            <p class="text-xs text-gray-400">Get alerts for events you'll love</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Special offer banner --}}
            <div class="mb-6 p-4 rounded-xl bg-gradient-to-r from-primary-500/20 via-green-500/20 to-primary-500/20 border border-primary-500/30">
                <div class="text-center">
                    <div class="flex items-center justify-center space-x-2 mb-2">
                        <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span class="text-sm font-bold text-yellow-400">LIMITED TIME OFFER</span>
                        <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <p class="text-white font-semibold">Sign up now and get 15% off your first event!</p>
                    <p class="text-xs text-gray-400 mt-1">Use code: <span class="text-primary-400 font-mono">WELCOME15</span></p>
                </div>
            </div>

            {{-- Action buttons --}}
            <div class="space-y-3">
                {{-- Sign Up Button --}}
                <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-6 py-3 border border-transparent text-base font-semibold rounded-xl text-white bg-gradient-to-r from-primary-500 to-green-500 hover:from-primary-600 hover:to-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Create Free Account
                </a>

                {{-- Login Button --}}
                <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-6 py-3 border border-white/20 text-base font-semibold rounded-xl text-white bg-white/10 hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white/50 transition-all duration-200 backdrop-blur-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Already have an account? Sign In
                </a>

                {{-- Continue as Guest --}}
                <button onclick="closeAuthModal()" class="w-full text-center py-2 text-sm text-gray-400 hover:text-white transition-colors">
                    Continue as guest
                </button>
            </div>

            {{-- Trust indicators --}}
            <div class="mt-6 pt-4 border-t border-white/10">
                <div class="flex items-center justify-center space-x-6 text-xs text-gray-500">
                    <div class="flex items-center space-x-1">
                        <svg class="h-4 w-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Secure & Private</span>
                    </div>
                    <div class="flex items-center space-x-1">
                        <svg class="h-4 w-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>100% Free</span>
                    </div>
                    <div class="flex items-center space-x-1">
                        <svg class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                        </svg>
                        <span>50K+ Happy Users</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript for modal functionality --}}
<script>
function showAuthModal() {
    document.getElementById('auth-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Add entrance animation
    const modal = document.querySelector('#auth-modal .relative');
    modal.style.transform = 'scale(0.95)';
    modal.style.opacity = '0';
    
    setTimeout(() => {
        modal.style.transform = 'scale(1)';
        modal.style.opacity = '1';
        modal.style.transition = 'all 0.2s ease-out';
    }, 10);
}

function closeAuthModal() {
    const modal = document.querySelector('#auth-modal .relative');
    modal.style.transform = 'scale(0.95)';
    modal.style.opacity = '0';
    
    setTimeout(() => {
        document.getElementById('auth-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }, 200);
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('auth-modal').classList.contains('hidden')) {
        closeAuthModal();
    }
});

// Show modal for unauthenticated users on page load (with delay)
document.addEventListener('DOMContentLoaded', function() {
    @guest
        // Check if user has seen the modal recently (using localStorage)
        const lastModalShown = localStorage.getItem('authModalLastShown');
        const now = Date.now();
        const oneDay = 24 * 60 * 60 * 1000; // 24 hours in milliseconds
        
        if (!lastModalShown || (now - parseInt(lastModalShown)) > oneDay) {
            // Show modal after 3 seconds delay
            setTimeout(() => {
                showAuthModal();
                localStorage.setItem('authModalLastShown', now.toString());
            }, 3000);
        }
    @endguest
});
</script>
