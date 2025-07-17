<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Welcome | {{ config('app.name', 'Laravel') }}</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    /* Subtle snowflake animation for Ayaka icy vibe */
    .snowflake {
      position: fixed;
      top: -10px;
      color: #cce6ffaa;
      font-size: 1.2rem;
      user-select: none;
      animation: fall linear infinite;
      z-index: 50;
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

    /* Frosted glass style container */
    .frosted {
      background: rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.25);
      border-radius: 1.5rem;
      box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body class="relative min-h-screen bg-gradient-to-br from-[#a2d9ff] via-[#d0e9ff] to-[#e6f2ff] flex items-center justify-center px-6">

  {{-- Snowflake Layer --}}
  @for ($i = 0; $i < 20; $i++)
    <div 
      class="snowflake" 
      style="left: {{ rand(0, 100) }}%; animation-duration: {{ rand(15, 30) }}s; animation-delay: -{{ rand(0, 30) }}s;">
      ❄
    </div>
  @endfor

  <main class="frosted max-w-md w-full p-10 text-center">
    <h1 class="text-5xl font-extrabold text-[#0f1e47] drop-shadow-md mb-6">Welcome to <span class="text-[#4ca6ff]">{{ config('app.name', 'Laravel') }}</span></h1>
    <p class="text-[#1958a8] text-lg mb-10">Experience the calm and elegance of Ayaka Kamisato's style. Please register or log in to continue.</p>

    <div class="flex justify-center gap-8">
      <a href="{{ route('register') }}" 
         class="px-8 py-3 bg-[#4ca6ff] hover:bg-[#3785e4] text-white rounded-xl font-semibold transition shadow-lg">
        Register
      </a>
      <a href="{{ route('login') }}" 
         class="px-8 py-3 border-2 border-[#4ca6ff] text-[#4ca6ff] hover:bg-[#d6eaff] rounded-xl font-semibold transition shadow-sm">
        Login
      </a>
    </div>
  </main>

</body>
</html>
