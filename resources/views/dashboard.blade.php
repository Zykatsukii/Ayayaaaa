@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script src="//unpkg.com/alpinejs" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
    .animate-bounce-once {
        animation: bounceOnce 0.8s ease;
    }
    @keyframes bounceOnce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
    .card-hover-effect {
        transition: all 0.3s ease;
    }
    .card-hover-effect:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .gradient-text {
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
    }
</style>

<div x-data="{ showBookings: false, activeTab: 'bookings' }" class="min-h-screen bg-gradient-to-br from-[#e0dfff] via-[#d8e9f4] to-[#bcd9ea] py-10 px-4 sm:px-6 lg:px-8 overflow-y-auto">
    <div class="max-w-6xl mx-auto space-y-8">

        <!-- Success message with animation -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-xl shadow-md border border-green-300 text-center animate-bounce-once">
                <div class="flex items-center justify-center space-x-2">
                    <i class="fas fa-check-circle text-green-500"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Welcome Section with gradient text -->
        <div class="bg-white/30 backdrop-blur-lg rounded-2xl p-8 border border-teal-300 shadow-lg">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h3 class="text-3xl font-semibold bg-gradient-to-r from-[#334188] to-teal-600 gradient-text drop-shadow-md">
                        Welcome, {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-[#4a5c7a] mt-2 text-lg">Here's your personalized dashboard summary</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="inline-block bg-teal-100 text-teal-800 text-sm font-semibold px-3 py-1 rounded-full">
                        <i class="fas fa-user-shield mr-1"></i> {{ Auth::user()->role ?? 'User' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Statistics Cards Grid - Now only 2 cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            <!-- Total Bookings Card -->
            <div 
                @click="showBookings = !showBookings; activeTab = 'bookings'" 
                class="card-hover-effect bg-white/60 backdrop-blur-md border-l-4 border-teal-500 shadow-lg p-6 rounded-2xl cursor-pointer hover:bg-white/80 transition group"
                role="button" tabindex="0"
            >
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-teal-700 font-semibold text-lg group-hover:text-teal-900">Total Bookings</h4>
                        <p class="text-4xl font-bold text-teal-600 mt-2">{{ $totalBookings ?? 0 }}</p>
                    </div>
                    <i class="fas fa-calendar-check text-teal-400 text-3xl"></i>
                </div>
                <p class="text-xs text-teal-600 mt-2">Click to view details</p>
            </div>

            <!-- Recent Activity Card -->
            <div 
                @click="activeTab = 'activity'" 
                class="card-hover-effect bg-white/60 backdrop-blur-md border-l-4 border-blue-500 shadow-lg p-6 rounded-2xl cursor-pointer hover:bg-white/80 transition group"
                role="button" tabindex="0"
            >
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-blue-700 font-semibold text-lg group-hover:text-blue-900">Recent Activity</h4>
                        <p class="text-4xl font-bold text-blue-600 mt-2">{{ isset($recentActivities) ? count($recentActivities) : 0 }}</p>
                    </div>
                    <i class="fas fa-bell text-blue-400 text-3xl"></i>
                </div>
                <p class="text-xs text-blue-600 mt-2">Click to view</p>
            </div>
        </div>

        <!-- Tabbed Content Section -->
        <div class="bg-white/40 backdrop-blur-lg shadow-xl rounded-2xl border border-indigo-300 mt-6 overflow-hidden">
            <!-- Tab Headers -->
            <div class="flex border-b border-indigo-200">
                <button 
                    @click="activeTab = 'bookings'" 
                    :class="{ 'bg-indigo-100 text-indigo-700 border-b-2 border-indigo-500': activeTab === 'bookings' }"
                    class="px-6 py-3 font-medium text-indigo-600 hover:bg-indigo-50 transition"
                >
                    <i class="fas fa-calendar-alt mr-2"></i> Your Bookings
                </button>
                <button 
                    @click="activeTab = 'activity'" 
                    :class="{ 'bg-indigo-100 text-indigo-700 border-b-2 border-indigo-500': activeTab === 'activity' }"
                    class="px-6 py-3 font-medium text-indigo-600 hover:bg-indigo-50 transition"
                >
                    <i class="fas fa-bell mr-2"></i> Recent Activity
                </button>
            </div>

            <!-- Tab Content -->
            <div class="p-6">
                <!-- Bookings Tab -->
                <div x-show="activeTab === 'bookings'" x-transition>
                    <h3 class="text-2xl font-semibold text-indigo-700 mb-6 flex items-center">
                        <i class="fas fa-calendar-day mr-2"></i> Your Bookings
                    </h3>

                    @if(isset($bookings) && $bookings->count())
                        <div class="space-y-5">
                            @foreach ($bookings as $booking)
                                <div class="card-hover-effect bg-white rounded-xl p-5 border border-indigo-200 shadow hover:shadow-xl transition duration-300">
                                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                        <div>
                                            <h4 class="text-lg font-semibold text-indigo-800">{{ $booking->title }}</h4>
                                            <p class="text-indigo-700 text-sm mt-1">{{ $booking->description }}</p>
                                            <div class="flex items-center mt-3">
                                                <i class="far fa-clock text-indigo-500 mr-2"></i>
                                                <span class="text-xs text-indigo-500">
                                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y h:i A') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mt-4 md:mt-0 flex space-x-4">
                                            <a href="{{ route('bookings.edit', $booking->id) }}" 
                                               class="text-blue-600 hover:text-blue-800 font-medium flex items-center"
                                               title="Edit booking"
                                            >
                                                <i class="fas fa-pencil-alt mr-1"></i> Edit
                                            </a>

                                            <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}"
                                                  onsubmit="return confirm('Are you sure you want to delete this booking?');"
                                                  class="inline"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium flex items-center"
                                                        title="Delete booking"
                                                >
                                                    <i class="fas fa-trash-alt mr-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="far fa-calendar-plus text-indigo-300 text-5xl mb-4"></i>
                            <p class="text-indigo-600 font-medium">You don't have any bookings yet.</p>
                            <a href="{{ route('bookings.create') }}" class="inline-block mt-4 px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                <i class="fas fa-plus mr-2"></i> Create New Booking
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Activity Tab -->
                <div x-show="activeTab === 'activity'" x-transition style="display: none;">
                    <h3 class="text-2xl font-semibold text-indigo-700 mb-6 flex items-center">
                        <i class="fas fa-bell mr-2"></i> Recent Activity
                    </h3>
                    
                    <div class="space-y-4">
                        @if(isset($recentActivities) && count($recentActivities) > 0)
                            @foreach($recentActivities as $activity)
                                <div class="bg-white/80 p-4 rounded-lg border border-indigo-100 shadow-sm">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 bg-indigo-100 p-2 rounded-full">
                                            <i class="fas fa-bell text-indigo-500"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-indigo-800">
                                                {{ $activity->description ?? 'System activity' }}
                                            </p>
                                            <p class="text-xs text-indigo-500 mt-1">
                                                {{ isset($activity->created_at) ? $activity->created_at->diffForHumans() : 'Recently' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-bell-slash text-indigo-300 text-5xl mb-4"></i>
                                <p class="text-indigo-600 font-medium">No recent activity found</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection