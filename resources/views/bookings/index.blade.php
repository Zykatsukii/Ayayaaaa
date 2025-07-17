@extends('layouts.app')

@section('title', 'Bookings')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
    #inline-calendar {
        width: 100%;
        max-width: 420px;
        font-size: 1rem;
    }
    .flatpickr-day {
        height: 2.5rem;
        line-height: 2.5rem;
        width: 2.5rem;
        margin: 0.1rem;
    }
    .flatpickr-time input {
        font-size: 1rem;
        width: 3rem;
        height: 2rem;
    }
    .flatpickr-day.disabled, .flatpickr-day.disabled:hover {
        color: #ccc;
        background: #f8f9fa;
        cursor: not-allowed;
    }
    .flatpickr-day.booked {
        background: #fef2f2;
        color: #dc2626;
        border-color: #fecaca;
    }
    .flatpickr-day.booked:hover {
        background: #fecaca;
        color: #991b1b;
    }
    .booking-card {
        transition: all 0.3s ease;
    }
    .booking-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .animate-fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="bg-gradient-to-br from-[#e0dfff] via-[#d8e9f4] to-[#bcd9ea] py-12 min-h-screen overflow-y-auto">
    <div class="max-w-4xl mx-auto space-y-8 px-4 sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg shadow-md border border-green-300 text-center animate-fade-in">
                <div class="flex items-center justify-center space-x-2">
                    <i class="fas fa-check-circle text-green-500"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <section aria-labelledby="booking-form-heading" class="bg-white/80 backdrop-blur-lg shadow-xl rounded-xl p-6 sm:p-8 border border-blue-100">
            <h2 id="booking-form-heading" class="text-3xl font-bold mb-6 text-center bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                <i class="fas fa-calendar-plus mr-2"></i> Schedule an Appointment
            </h2>

            <form method="POST" action="{{ route('bookings.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="fas fa-heading mr-2 text-blue-500"></i> Appointment Title
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            value="{{ old('title') }}"
                            required
                            placeholder="e.g. Project Consultation"
                            class="w-full mt-1 border border-gray-300 bg-white text-gray-900 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-sm" 
                        />
                        @error('title')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="attendees" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="fas fa-users mr-2 text-blue-500"></i> Attendees (optional)
                        </label>
                        <input 
                            type="text" 
                            name="attendees" 
                            id="attendees" 
                            value="{{ old('attendees') }}"
                            placeholder="Who's attending?"
                            class="w-full mt-1 border border-gray-300 bg-white text-gray-900 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-sm" 
                        />
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                        <i class="fas fa-align-left mr-2 text-blue-500"></i> Details
                    </label>
                    <textarea 
                        name="description" 
                        id="description" 
                        rows="4"
                        required
                        placeholder="What's this appointment about?"
                        class="w-full mt-1 border border-gray-300 bg-white text-gray-900 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-sm"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <input type="hidden" name="booking_date" id="booking_date" value="{{ old('booking_date') }}" />

                <div class="bg-blue-50/50 p-4 rounded-lg border border-blue-100">
                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class="far fa-clock mr-2 text-blue-500"></i> Select Date & Time
                    </label>
                    
                    <div class="flex flex-col md:flex-row gap-6">
                        <div id="inline-calendar" class="rounded-lg border border-blue-200 bg-white p-4 shadow-sm"></div>
                        
                        <div class="flex-1">
                            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                <h3 class="font-medium text-gray-800 mb-3 flex items-center">
                                    <i class="fas fa-info-circle mr-2 text-blue-500"></i> Availability Notes
                                </h3>
                                <ul class="space-y-2 text-sm text-gray-600">
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-0.5 mr-2"></i>
                                        <span>Available time slots are shown in white</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-times-circle text-red-500 mt-0.5 mr-2"></i>
                                        <span>Red dates are already booked</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-clock text-gray-500 mt-0.5 mr-2"></i>
                                        <span>Business hours: 9:00 AM - 5:00 PM</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="mt-4 bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                <h3 class="font-medium text-gray-800 mb-2 flex items-center">
                                    <i class="fas fa-calendar-check mr-2 text-blue-500"></i> Selected Time
                                </h3>
                                <div id="selected-time-display" class="text-lg font-semibold text-blue-600">
                                    @if(old('booking_date'))
                                        {{ \Carbon\Carbon::parse(old('booking_date'))->format('l, F j, Y \a\t g:i A') }}
                                    @else
                                        No time selected
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @error('booking_date')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="pt-2 flex justify-center">
                    <button type="submit" class="relative inline-flex items-center justify-center px-8 py-3 overflow-hidden font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full group shadow-lg hover:shadow-xl transition-all duration-300">
                        <span class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                        <span class="relative flex items-center">
                            <i class="fas fa-calendar-plus mr-2"></i> Confirm Booking
                        </span>
                    </button>
                </div>
            </form>
        </section>

        @if($bookings->count() > 0)
        <section aria-labelledby="upcoming-bookings-heading" class="bg-white/80 backdrop-blur-lg shadow-xl rounded-xl p-6 sm:p-8 border border-blue-100">
            <h2 id="upcoming-bookings-heading" class="text-2xl font-bold mb-6 text-center bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                <i class="far fa-calendar-alt mr-2"></i> Your Upcoming Appointments
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($bookings as $booking)
                <div class="booking-card bg-white border border-gray-200 rounded-lg p-5 shadow-sm hover:border-blue-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-lg text-gray-800">{{ $booking->title }}</h3>
                            <p class="text-gray-600 mt-1 flex items-center">
                                <i class="far fa-clock mr-2 text-blue-500"></i>
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('D, M j, Y \a\t g:i A') }}
                            </p>
                            @if($booking->attendees)
                            <p class="text-gray-600 mt-1 flex items-center">
                                <i class="fas fa-users mr-2 text-blue-500"></i>
                                {{ $booking->attendees }}
                            </p>
                            @endif
                        </div>
                        <div class="flex space-x-2">
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to cancel this booking?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-t border-gray-100">
                        <p class="text-gray-700">{{ $booking->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    const bookedDates = @json($bookedDates);
    const hiddenInput = document.getElementById("booking_date");
    const timeDisplay = document.getElementById("selected-time-display");
    
    // Format booked dates for Flatpickr
    const disabledDates = bookedDates.map(date => new Date(date));
    
    const calendar = flatpickr("#inline-calendar", {
        inline: true,
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: "today",
        minTime: "09:00",
        maxTime: "17:00",
        disable: disabledDates,
        time_24hr: false,
        defaultDate: hiddenInput.value ? new Date(hiddenInput.value) : null,
        onChange: function(selectedDates, dateStr) {
            hiddenInput.value = dateStr;
            if (selectedDates.length > 0) {
                const formattedDate = selectedDates[0].toLocaleString('en-US', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                timeDisplay.textContent = formattedDate;
            } else {
                timeDisplay.textContent = "No time selected";
            }
        },
        onDayCreate: function(dObj, dStr, fp, dayElem) {
            // Mark booked dates with a special class
            const date = new Date(dayElem.dateObj);
            date.setHours(0,0,0,0);
            
            disabledDates.forEach(disabledDate => {
                disabledDate.setHours(0,0,0,0);
                if (date.getTime() === disabledDate.getTime()) {
                    dayElem.classList.add("booked");
                }
            });
        }
    });
    
    // Initialize display if there's already a value
    if (hiddenInput.value) {
        const date = new Date(hiddenInput.value);
        const formattedDate = date.toLocaleString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
        timeDisplay.textContent = formattedDate;
    }
</script>
@endsection