<nav x-data="{ open: false, notificationsOpen: false }" class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-[#e0dfff] via-[#d8e9f4] to-[#bcd9ea] border-r border-blue-300 shadow-lg flex flex-col">

    <!-- Desktop Sidebar Content -->
    <div class="flex flex-col h-full">

        <!-- Logo / Title -->
        <div class="flex items-center justify-center h-16 border-b border-blue-300 flex-shrink-0">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 text-blue-900 hover:text-teal-600 font-semibold text-xl tracking-wider select-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linejoin="round" stroke-linecap="round">
                    <path d="M12 2C13.1046 2 14 2.89543 14 4C14 5.10457 13.1046 6 12 6C10.8954 6 10 5.10457 10 4C10 2.89543 10.8954 2 12 2Z" />
                    <path d="M19 10C20.1046 10 21 10.8954 21 12C21 13.1046 20.1046 14 19 14C17.8954 14 17 13.1046 17 12C17 10.8954 17.8954 10 19 10Z" />
                    <path d="M5 10C6.10457 10 7 10.8954 7 12C7 13.1046 6.10457 14 5 14C3.89543 14 3 13.1046 3 12C3 10.8954 3.89543 10 5 10Z" />
                    <path d="M12 18C13.1046 18 14 18.8954 14 20C14 21.1046 13.1046 22 12 22C10.8954 22 10 21.1046 10 20C10 18.8954 10.8954 18 12 18Z" />
                    <circle cx="12" cy="12" r="2" />
                </svg>
                <span>Ayaka</span>
            </a>
        </div>

        <!-- Nav Links -->
        <div class="flex-grow overflow-y-auto mt-4 px-4">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center px-3 py-2 rounded-md text-blue-900 hover:text-teal-600 hover:bg-white/50 transition
                       {{ request()->routeIs('dashboard') ? 'bg-white/70 font-semibold shadow-md' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linejoin="round" stroke-linecap="round" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('bookings.index') }}"
                       class="flex items-center px-3 py-2 rounded-md text-blue-900 hover:text-teal-600 hover:bg-white/50 transition
                       {{ request()->routeIs('bookings.index') ? 'bg-white/70 font-semibold shadow-md' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M8 7V3m0 0H5m3 0h3m3 0h3m-3 0v4m0 0h3m-3 0v14a2 2 0 002 2h-4a2 2 0 01-2-2V7m0 0H5a2 2 0 00-2 2v12a2 2 0 002 2h14" />
                        </svg>
                        Booking
                    </a>
                </li>
                
                <!-- Users Menu Item -->
                <li>
                    <a href="{{ route('users.index') }}"
                       class="flex items-center px-3 py-2 rounded-md text-blue-900 hover:text-teal-600 hover:bg-white/50 transition
                       {{ request()->routeIs('users.index') ? 'bg-white/70 font-semibold shadow-md' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Users
                    </a>
                </li>

                <!-- Notification Menu Item -->
                <li>
                    <div class="relative">
                        <button @click="notificationsOpen = !notificationsOpen" 
                                class="flex items-center w-full px-3 py-2 rounded-md text-blue-900 hover:text-teal-600 hover:bg-white/50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            Notifications
                            <!-- Notification Counter -->
                            <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                                3
                            </span>
                        </button>
                        
                        <!-- Notification Dropdown -->
                        <div x-show="notificationsOpen" 
                             @click.away="notificationsOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute left-0 mt-2 w-72 bg-white rounded-md shadow-lg overflow-hidden z-50"
                             style="display: none;">
                            <div class="py-1">
                                <!-- Notification Header -->
                                <div class="px-4 py-2 bg-blue-50 border-b border-blue-100 flex justify-between items-center">
                                    <h3 class="text-sm font-medium text-blue-800">Notifications</h3>
                                    <button class="text-blue-500 hover:text-blue-700 text-xs">
                                        Mark all as read
                                    </button>
                                </div>
                                
                                <!-- Notification Items -->
                                <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 border-b border-gray-100">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 text-blue-500">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="font-medium">New booking request</p>
                                            <p class="text-xs text-gray-500">Just now</p>
                                        </div>
                                    </div>
                                </a>
                                
                                <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 border-b border-gray-100">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 text-green-500">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="font-medium">Booking confirmed</p>
                                            <p class="text-xs text-gray-500">2 hours ago</p>
                                        </div>
                                    </div>
                                </a>
                                
                                <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 text-yellow-500">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="font-medium">Upcoming appointment</p>
                                            <p class="text-xs text-gray-500">Yesterday</p>
                                        </div>
                                    </div>
                                </a>
                                
                                <!-- View All Link -->
                                <div class="px-4 py-2 bg-gray-50 text-center">
                                    <a href="#" class="text-xs font-medium text-blue-600 hover:text-blue-800">
                                        View all notifications
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Profile Section -->
        <div class="border-t border-blue-300 p-4 flex flex-col">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-200 rounded-full w-10 h-10 flex items-center justify-center text-blue-800 font-semibold uppercase select-none">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-blue-900 font-semibold select-none">{{ Auth::user()->name }}</p>
                    <a href="{{ route('profile.edit') }}" class="text-teal-600 hover:underline text-sm select-none">Profile</a>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded-md bg-teal-600 text-white font-semibold hover:bg-teal-700 transition">Log Out</button>
            </form>
        </div>
    </div>

    <!-- Mobile sidebar toggle button -->
    <button
        @click="open = !open"
        class="fixed top-4 left-4 z-50 inline-flex items-center justify-center p-2 rounded-md text-blue-900 bg-white/90 shadow-lg hover:bg-white/100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-teal-500 sm:hidden"
        aria-label="Toggle sidebar"
    >
        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Mobile Sidebar Overlay -->
    <div
        x-show="open"
        @click="open = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-40 sm:hidden"
        style="display:none;"
    ></div>

    <!-- Mobile Sidebar Content -->
    <aside
        x-show="open"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-[#e0dfff] via-[#d8e9f4] to-[#bcd9ea] border-r border-blue-300 shadow-lg flex flex-col sm:hidden"
        style="display:none;"
        @click.away="open = false"
    >
        <!-- Repeat same content as desktop sidebar for mobile -->
        <!-- Make sure to include the users section here as well -->
        <div class="flex flex-col h-full">
            <!-- Mobile Logo/Title -->
            <div class="flex items-center justify-center h-16 border-b border-blue-300 flex-shrink-0">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 text-blue-900 hover:text-teal-600 font-semibold text-xl tracking-wider select-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linejoin="round" stroke-linecap="round">
                        <path d="M12 2C13.1046 2 14 2.89543 14 4C14 5.10457 13.1046 6 12 6C10.8954 6 10 5.10457 10 4C10 2.89543 10.8954 2 12 2Z" />
                        <path d="M19 10C20.1046 10 21 10.8954 21 12C21 13.1046 20.1046 14 19 14C17.8954 14 17 13.1046 17 12C17 10.8954 17.8954 10 19 10Z" />
                        <path d="M5 10C6.10457 10 7 10.8954 7 12C7 13.1046 6.10457 14 5 14C3.89543 14 3 13.1046 3 12C3 10.8954 3.89543 10 5 10Z" />
                        <path d="M12 18C13.1046 18 14 18.8954 14 20C14 21.1046 13.1046 22 12 22C10.8954 22 10 21.1046 10 20C10 18.8954 10.8954 18 12 18Z" />
                        <circle cx="12" cy="12" r="2" />
                    </svg>
                    <span>Ayaka</span>
                </a>
            </div>

            <!-- Mobile Nav Links -->
            <div class="flex-grow overflow-y-auto mt-4 px-4">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center px-3 py-2 rounded-md text-blue-900 hover:text-teal-600 hover:bg-white/50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linejoin="round" stroke-linecap="round" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('bookings.index') }}"
                           class="flex items-center px-3 py-2 rounded-md text-blue-900 hover:text-teal-600 hover:bg-white/50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M8 7V3m0 0H5m3 0h3m3 0h3m-3 0v4m0 0h3m-3 0v14a2 2 0 002 2h-4a2 2 0 01-2-2V7m0 0H5a2 2 0 00-2 2v12a2 2 0 002 2h14" />
                            </svg>
                            Booking
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}"
                           class="flex items-center px-3 py-2 rounded-md text-blue-900 hover:text-teal-600 hover:bg-white/50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Users
                        </a>
                    </li>
                    <!-- Include other mobile menu items as needed -->
                </ul>
            </div>

            <!-- Mobile Profile Section -->
            <div class="border-t border-blue-300 p-4 flex flex-col">
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-200 rounded-full w-10 h-10 flex items-center justify-center text-blue-800 font-semibold uppercase select-none">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-blue-900 font-semibold select-none">{{ Auth::user()->name }}</p>
                        <a href="{{ route('profile.edit') }}" class="text-teal-600 hover:underline text-sm select-none">Profile</a>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded-md bg-teal-600 text-white font-semibold hover:bg-teal-700 transition">Log Out</button>
                </form>
            </div>
        </div>
    </aside>
</nav>