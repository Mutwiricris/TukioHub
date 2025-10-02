@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-zinc-900 text-zinc-200">
    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <nav class="flex items-center gap-2 text-sm text-gray-400 mb-4">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-white">Profile Settings</span>
            </nav>
            <h1 class="text-3xl font-bold text-white">Profile Settings</h1>
            <p class="mt-2 text-gray-400">Manage your account information and preferences</p>
        </div>

        <!-- Settings Navigation -->
        <div class="mb-8">
            <div class="flex space-x-1 rounded-xl bg-white/5 p-1">
                <a href="{{ route('settings.profile') }}" class="flex-1 rounded-lg bg-primary-500 px-3 py-2 text-center text-sm font-medium text-white transition-colors">
                    Profile
                </a>
                <a href="{{ route('settings.password') }}" class="flex-1 rounded-lg px-3 py-2 text-center text-sm font-medium text-gray-400 hover:text-white transition-colors">
                    Password
                </a>
                <a href="{{ route('settings.appearance') }}" class="flex-1 rounded-lg px-3 py-2 text-center text-sm font-medium text-gray-400 hover:text-white transition-colors">
                    Appearance
                </a>
            </div>
        </div>

        <!-- Profile Settings Form -->
        <div class="space-y-8">
            <!-- Profile Information Section -->
            <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-6">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-primary-500 to-primary-400 text-white text-xl font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-white">Profile Information</h2>
                        <p class="text-sm text-gray-400">Update your account's profile information and email address</p>
                    </div>
                </div>

                @livewire('settings.profile')
            </div>

            <!-- Account Actions Section -->
            <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-6">
                <h2 class="text-xl font-semibold text-white mb-4">Account Actions</h2>
                <div class="space-y-4">
                    <!-- Export Data -->
                    <div class="flex items-center justify-between p-4 rounded-lg bg-blue-500/10 border border-blue-500/20">
                        <div>
                            <h3 class="font-medium text-white">Export Your Data</h3>
                            <p class="text-sm text-gray-400">Download a copy of all your account data</p>
                        </div>
                        <button class="rounded-lg bg-blue-500 px-4 py-2 text-sm font-medium text-white hover:bg-blue-400 transition-colors">
                            Export Data
                        </button>
                    </div>

                    <!-- Delete Account -->
                    <div class="flex items-center justify-between p-4 rounded-lg bg-red-500/10 border border-red-500/20">
                        <div>
                            <h3 class="font-medium text-red-400">Delete Account</h3>
                            <p class="text-sm text-gray-400">Permanently delete your account and all associated data</p>
                        </div>
                        <button onclick="confirmDelete()" class="rounded-lg bg-red-500 px-4 py-2 text-sm font-medium text-white hover:bg-red-400 transition-colors">
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
