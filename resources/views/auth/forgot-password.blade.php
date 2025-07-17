<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Password Reset | {{ config('app.name', 'Laravel') }}</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      background: linear-gradient(135deg, #a2d9ff 0%, #d0e9ff 50%, #e6f2ff 100%);
      position: relative;
      overflow-x: hidden;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }

    .snowflake {
      position: fixed;
      top: -10px;
      color: #cce6ffaa;
      font-size: 1.2rem;
      user-select: none;
      animation: fall linear infinite;
      z-index: 50;
      pointer-events: none;
      text-shadow: 0 0 5px #d0e9ff;
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

    .frosted {
      background: rgba(255,255,255,0.4);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 1.5rem;
      border: 1px solid rgba(255,255,255,0.3);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      max-width: 400px;
      width: 100%;
      padding: 2rem;
    }
  </style>
</head>
<body>

  {{-- Snowflakes --}}
  @for ($i = 0; $i < 25; $i++)
    <div 
      class="snowflake" 
      style="left: {{ rand(0, 100) }}%; animation-duration: {{ rand(15, 30) }}s; animation-delay: -{{ rand(0, 30) }}s;">
      ❄
    </div>
  @endfor

  <div class="frosted text-[#0f1e47]">

    <h1 class="text-2xl font-bold mb-6 text-center drop-shadow-md">Forgot your password?</h1>

    <p class="mb-6 text-center text-[#1958a8] text-sm leading-relaxed">
      No problem. Just enter your email below and we'll send you a password reset link.
    </p>

    <!-- Session Status -->
    @if (session('status'))
      <div class="mb-4 px-4 py-3 bg-green-200 text-green-800 rounded text-center text-sm font-semibold">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
      @csrf

      <div>
        <label for="email" class="block text-sm font-semibold mb-1 text-[#4ca6ff]">Email</label>
        <input 
          id="email" 
          type="email" 
          name="email" 
          value="{{ old('email') }}" 
          required autofocus
          class="w-full px-4 py-3 rounded-xl border border-[#4ca6ff] focus:outline-none focus:ring-2 focus:ring-[#4ca6ff] text-[#0f1e47]" 
        />
        @error('email')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="text-center">
        <button type="submit" class="w-full bg-[#4ca6ff] hover:bg-[#3785e4] text-white font-bold py-3 rounded-xl shadow-lg transition">
          Email Password Reset Link
        </button>
      </div>
    </form>

    <p class="mt-6 text-center text-sm text-[#1958a8]">
      Remembered your password?
      <a href="{{ route('login') }}" class="font-semibold hover:underline text-[#4ca6ff]">Login here</a>.
    </p>

  </div>

</body>
</html>
