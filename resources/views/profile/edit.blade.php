@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gradient-to-br from-[#e0dfff] via-[#d8e9f4] to-[#bcd9ea] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto bg-white/60 backdrop-blur-lg rounded-2xl shadow-2xl p-10 border border-blue-200">
        <h2 class="text-4xl font-bold text-[#334188] mb-10 text-center drop-shadow-md">❄️ Edit Your Profile</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 mb-8 rounded-lg border border-green-300 text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Profile Update Form -->
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-8">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-blue-800 mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full border border-blue-300 bg-white rounded-lg px-4 py-3 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-blue-800 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full border border-blue-300 bg-white rounded-lg px-4 py-3 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-blue-800 mb-1">
                        New Password <span class="text-xs text-gray-500">(optional)</span>
                    </label>
                    <input type="password" name="password"
                        class="w-full border border-blue-300 bg-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-medium text-blue-800 mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full border border-blue-300 bg-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <!-- Update Button -->
            <div class="text-center pt-6">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-10 rounded-full transition shadow-lg">
                    Update Profile
                </button>
            </div>
        </form>

        <!-- Divider -->
        <hr class="my-12 border-blue-200">

        <!-- Delete Account -->
        <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account?')">
            @csrf
            @method('DELETE')

            <h3 class="text-2xl font-semibold text-red-700 mb-6 text-center">⚠️ Delete Account</h3>

            <div class="max-w-md mx-auto space-y-4">
                <label class="block text-sm font-medium text-red-700 mb-1">Confirm Password</label>
                <input type="password" name="password"
                    class="w-full border border-red-300 bg-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-400"
                    required>
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <div class="text-center pt-4">
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-10 rounded-full transition shadow-md">
                        Delete Account
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
