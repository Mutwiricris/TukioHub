@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-gray-200">
    <div class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
        <!-- Enhanced Page Header -->
        <div class="mb-12">
            <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6">
                <a href="{{ route('home') }}" class="hover:text-primary-400 transition-colors">Home</a>
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-white font-medium">Settings</span>
            </nav>
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-2xl bg-gradient-to-br from-primary-500/20 to-emerald-500/20 border border-primary-500/30">
                    <svg class="w-8 h-8 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-4xl font-bold text-white">Profile Settings</h1>
                    <p class="mt-2 text-gray-400">Manage your account information and preferences</p>
                </div>
            </div>
        </div>

        <!-- Enhanced Settings Navigation -->
        <div class="mb-10">
            <div class="flex gap-2 p-1.5 rounded-2xl bg-gradient-to-br from-gray-800/60 to-gray-800/40 border border-gray-700/50 backdrop-blur-md shadow-xl">
                <a href="{{ route('settings.profile') }}" class="flex-1 flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-emerald-500 px-4 py-3 text-center text-sm font-bold text-white shadow-lg transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profile
                </a>
                <a href="{{ route('settings.password') }}" class="flex-1 flex items-center justify-center gap-2 rounded-xl px-4 py-3 text-center text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Password
                </a>
                <a href="{{ route('settings.appearance') }}" class="flex-1 flex items-center justify-center gap-2 rounded-xl px-4 py-3 text-center text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                    </svg>
                    Appearance
                </a>
            </div>
        </div>

        <!-- Enhanced Profile Settings Form -->
        <div class="space-y-6">
            <!-- Enhanced Profile Information Section -->
            <div class="rounded-2xl border border-gray-700/50 bg-gradient-to-br from-gray-800/60 to-gray-800/40 backdrop-blur-md p-8 shadow-2xl">
                <div class="flex items-center gap-6 mb-8">
                    <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-gradient-to-br from-primary-500 to-emerald-500 text-white text-2xl font-bold shadow-lg border-2 border-white/10">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-1">Profile Information</h2>
                        <p class="text-sm text-gray-400">Update your account's profile information and email address</p>
                    </div>
                </div>

                @livewire('settings.profile')
            </div>

            <!-- Enhanced Account Actions Section -->
            <div class="rounded-2xl border border-gray-700/50 bg-gradient-to-br from-gray-800/60 to-gray-800/40 backdrop-blur-md p-8 shadow-2xl">
                <div class="flex items-center gap-3 mb-6">
                    <svg class="w-6 h-6 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                    <h2 class="text-2xl font-bold text-white">Account Actions</h2>
                </div>
                <div class="space-y-4">
                    <!-- Enhanced Export Data -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 p-6 rounded-2xl bg-blue-500/10 border border-blue-500/30 hover:bg-blue-500/15 transition-colors">
                        <div class="flex items-start gap-4">
                            <div class="p-2 rounded-xl bg-blue-500/20 border border-blue-500/30">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-white mb-1">Export Your Data</h3>
                                <p class="text-sm text-gray-400">Download a copy of all your account data</p>
                            </div>
                        </div>
                        <button class="rounded-xl bg-blue-500 px-6 py-2.5 text-sm font-bold text-white hover:bg-blue-400 shadow-lg hover:shadow-xl transition-all hover:scale-105">
                            Export Data
                        </button>
                    </div>

                    <!-- Enhanced Delete Account -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 p-6 rounded-2xl bg-red-500/10 border border-red-500/30 hover:bg-red-500/15 transition-colors">
                        <div class="flex items-start gap-4">
                            <div class="p-2 rounded-xl bg-red-500/20 border border-red-500/30">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-red-400 mb-1">Delete Account</h3>
                                <p class="text-sm text-gray-400">Permanently delete your account and all associated data</p>
                            </div>
                        </div>
                        <button onclick="confirmDelete()" class="rounded-xl bg-red-500 px-6 py-2.5 text-sm font-bold text-white hover:bg-red-400 shadow-lg hover:shadow-xl transition-all hover:scale-105">
                            Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="mx-4 w-full max-w-md rounded-2xl border border-white/10 bg-gray-800 p-6 shadow-xl">
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-white">Delete Account</h3>
            <p class="mt-2 text-sm text-gray-400">
                Are you sure you want to delete your account? This action cannot be undone and will permanently remove all your data.
            </p>
        </div>
        <div class="flex gap-3">
            <button onclick="closeDeleteModal()" class="flex-1 rounded-lg border border-white/10 px-4 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 transition-colors">
                Cancel
            </button>
            <button onclick="deleteAccount()" class="flex-1 rounded-lg bg-red-500 px-4 py-2 text-sm font-medium text-white hover:bg-red-400 transition-colors">
                Delete Account
            </button>
        </div>
    </div>
</div>

<script>
function confirmDelete() {
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
}

function deleteAccount() {
    // Here you would implement the actual delete functionality
    alert('Account deletion functionality would be implemented here');
    closeDeleteModal();
}

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>
@endsection
