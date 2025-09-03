{{--
    This code is designed for a Livewire component's view file,
    for example: resources/views/livewire/settings/profile.blade.php

    The entire component is wrapped in a single root <div> to prevent
    the "Multiple root elements detected" error.
--}}
<div>
    <section class="rounded-2xl border border-white/10 bg-gray-800/50 p-4 sm:p-6 shadow-lg">
        <header>
            <h2 class="text-lg font-semibold text-white">Profile</h2>
            <p class="mt-1 text-sm text-gray-400">Update your account's profile information and email address.</p>
        </header>

        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            {{-- Name Input --}}
            <div>
                <label for="name" class="text-xs font-medium text-gray-300">Name</label>
                <input wire:model="name" id="name" name="name" type="text" required autofocus autocomplete="name" class="mt-1 w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm text-white placeholder-gray-400 focus:border-primary-500 focus:ring-1 focus:ring-primary-500" />
            </div>

            {{-- Email Input --}}
            <div>
                <label for="email" class="text-xs font-medium text-gray-300">Email</label>
                <input wire:model="email" id="email" name="email" type="email" required autocomplete="email" class="mt-1 w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm text-white placeholder-gray-400 focus:border-primary-500 focus:ring-1 focus:ring-primary-500" />

                {{-- Email Verification Status Logic --}}
                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-xs text-gray-400">
                            Your email address is unverified.
                            <button wire:click.prevent="sendVerification" class="cursor-pointer text-primary-400 hover:underline">
                                Click here to re-send the verification email.
                            </button>
                        </p>
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-xs font-medium text-emerald-400">
                                A new verification link has been sent to your email address.
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Save Button & Action Message --}}
            <div class="flex items-center gap-4">
                <button type="submit" class="rounded-lg bg-primary-500 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-primary-600">Save</button>

                <div x-data="{ show: false }" x-show="show" x-transition x-init="@this.on('profile-updated', () => { show = true; setTimeout(() => show = false, 2000) })">
                    <p class="text-sm text-gray-300">Saved.</p>
                </div>
            </div>
        </form>
    </section>

    {{-- Delete User Form Section --}}
    <section class="mt-8 rounded-2xl border border-white/10 bg-gray-800/50 p-4 sm:p-6 shadow-lg">
         <header>
            <h2 class="text-lg font-semibold text-red-400">Delete Account</h2>
            <p class="mt-1 text-sm text-gray-400">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
        </header>
        <button class="mt-4 rounded-lg border border-red-500/50 bg-red-500/20 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-red-500/30">
            Delete Account
        </button>
    </section>
</div>
