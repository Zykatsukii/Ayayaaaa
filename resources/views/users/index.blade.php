@extends('layouts.app')

@section('title', 'Users List')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<style>
  /* Snowflake animation for background */
  .snowflake {
    position: fixed;
    top: -10px;
    color: #cbd5e1aa; /* soft icy blue */
    font-size: 1.25rem;
    user-select: none;
    animation: fall linear infinite;
    z-index: 10;
    pointer-events: none;
    text-shadow: 0 0 6px #dbeafe;
  }
  @keyframes fall {
    0% {
      transform: translateY(0) rotate(0deg);
      opacity: 1;
    }
    100% {
      transform: translateY(110vh) rotate(360deg);
      opacity: 0;
    }
  }

  /* Frosted glass container */
  .frosted {
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 1.5rem;
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 8px 32px 0 rgba(147, 197, 253, 0.3);
    max-width: 900px;
    margin: auto;
    padding: 2.5rem 2rem;
  }
</style>

{{-- Snowflakes --}}
@for ($i = 0; $i < 20; $i++)
  <div
    class="snowflake"
    style="left: {{ rand(0, 100) }}%; animation-duration: {{ rand(20, 40) }}s; animation-delay: -{{ rand(0, 40) }}s;"
  >
    ❄
  </div>
@endfor

<div class="min-h-screen bg-gradient-to-br from-[#e0dfff] via-[#d8e9f4] to-[#bcd9ea] py-12 px-6">
  <div class="frosted">

    <h1 class="text-4xl font-extrabold text-[#374151] mb-10 text-center drop-shadow-sm">
      Registered Users
    </h1>

    <!-- Back Button -->
    <div class="mb-8 text-center">
      <a href="{{ route('dashboard') }}"
        class="inline-block bg-pink-400 hover:bg-pink-500 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition"
      >
        ← Back to Dashboard
      </a>
    </div>

    @if($users->count())
      <div class="overflow-x-auto rounded-xl border border-[#a5b4fc] shadow-md">
        <table class="min-w-full table-auto divide-y divide-[#c7d2fe]">
          <thead class="bg-[#e0e7ff]">
            <tr>
              <th class="text-left px-8 py-4 text-[#4338ca] font-semibold border-b border-[#a5b4fc]">Name</th>
              <th class="text-left px-8 py-4 text-[#4338ca] font-semibold border-b border-[#a5b4fc]">Email</th>
              <th class="text-left px-8 py-4 text-[#4338ca] font-semibold border-b border-[#a5b4fc]">Registered At</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-[#e0e7ff]">
            @foreach($users as $user)
              <tr class="hover:bg-[#e0e7ff] transition duration-200">
                <td class="px-8 py-5 text-[#312e81] font-medium">{{ $user->name }}</td>
                <td class="px-8 py-5 text-[#4338ca]">{{ $user->email }}</td>
                <td class="px-8 py-5 text-[#6366f1] text-sm">{{ $user->created_at->format('M d, Y') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="mt-8">
        {{ $users->links() }}
      </div>
    @else
      <p class="text-center text-[#4c51bf] italic text-lg">No users found.</p>
    @endif

  </div>
</div>
@endsection
