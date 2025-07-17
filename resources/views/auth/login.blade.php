<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login | {{ config('app.name', 'Laravel') }}</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      background: linear-gradient(135deg, #a2d9ff 0%, #d0e9ff 50%, #e6f2ff 100%);
      position: relative;
      overflow-x: hidden;
    }

    /* Snowflake styling */
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
  </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-10">

  {{-- Snowflakes Layer --}}
  @for ($i = 0; $i < 25; $i++)
    <div 
      class="snowflake" 
      style="left: {{ rand(0, 100) }}%; animation-duration: {{ rand(15, 30) }}s; animation-delay: -{{ rand(0, 30) }}s;">
      ❄
    </div>
  @endfor

  <div class="w-full max-w-md bg-white bg-opacity-50 backdrop-blur-lg rounded-3xl shadow-2xl p-10 relative z-10">
    <h2 class="text-3xl font-extrabold text-[#0f1e47] mb-8 text-center drop-shadow-md">
      Log In to Your Account
    </h2>

    @if (session('status'))
      <div class="mb-4 font-medium text-sm text-green-600 text-center">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
      @csrf

      <div>
        <label for="email" class="block text-sm font-semibold text-[#1958a8] mb-2">Email Address</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
          class="w-full px-4 py-3 rounded-xl border border-[#4ca6ff] focus:outline-none focus:ring-2 focus:ring-[#4ca6ff] text-[#0f1e47]" />
        @error('email')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="password" class="block text-sm font-semibold text-[#1958a8] mb-2">Password</label>
        <input id="password" type="password" name="password" required
          class="w-full px-4 py-3 rounded-xl border border-[#4ca6ff] focus:outline-none focus:ring-2 focus:ring-[#4ca6ff] text-[#0f1e47]" />
        @error('password')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex items-center space-x-3">
        <input id="remember_me" type="checkbox" name="remember" 
          class="h-5 w-5 text-[#4ca6ff] border-[#4ca6ff] rounded focus:ring-[#4ca6ff]" />
        <label for="remember_me" class="text-sm text-[#1958a8] font-medium">Remember Me</label>
      </div>

      <div>
        <button type="submit"
          class="w-full bg-[#4ca6ff] hover:bg-[#3785e4] text-white font-bold py-3 rounded-xl shadow-lg transition">
          Login
        </button>
      </div>
    </form>

    <div class="mt-8 text-center text-sm text-[#1958a8] space-y-2">
      @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}" class="hover:underline inline-block">
          Forgot your password?
        </a><br />
      @endif
      <span>
        Don't have an account?
        <a href="{{ route('register') }}" class="font-semibold hover:underline text-[#4ca6ff]">
          Register
        </a>
      </span>
    </div>
  </div>

</body>
</html>
