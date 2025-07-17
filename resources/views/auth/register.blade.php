<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register | {{ config('app.name', 'Laravel') }}</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    /* Background gradient and body setup */
    body {
      background: linear-gradient(135deg, #a2d9ff 0%, #d0e9ff 50%, #e6f2ff 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      font-family: 'Inter', sans-serif;
      position: relative;
      overflow-x: hidden;
      color: #0f1e47;
    }

    /* Snowflakes animation */
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

    /* Frosted glass container */
    .frosted {
      background: rgba(255, 255, 255, 0.4);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 1.5rem;
      border: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      max-width: 420px;
      width: 100%;
      padding: 2.5rem 2rem;
      box-sizing: border-box;
    }

    label {
      color: #1958a8;
      font-weight: 600;
    }

    input:focus {
      border-color: #4ca6ff;
      box-shadow: 0 0 8px #4ca6ff;
      outline: none;
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

  <div class="frosted">

    <h2 class="text-3xl font-bold mb-6 text-center drop-shadow-md">Create an Account</h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
      @csrf

      <div>
        <label for="name" class="block mb-1">Full Name</label>
        <input
          id="name"
          type="text"
          name="name"
          value="{{ old('name') }}"
          required
          autofocus
          class="w-full px-4 py-3 rounded-xl border border-[#4ca6ff] text-[#0f1e47]"
        />
        @error('name')
          <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="email" class="block mb-1">Email Address</label>
        <input
          id="email"
          type="email"
          name="email"
          value="{{ old('email') }}"
          required
          class="w-full px-4 py-3 rounded-xl border border-[#4ca6ff] text-[#0f1e47]"
        />
        @error('email')
          <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="password" class="block mb-1">Password</label>
        <input
          id="password"
          type="password"
          name="password"
          required
          class="w-full px-4 py-3 rounded-xl border border-[#4ca6ff] text-[#0f1e47]"
        />
        @error('password')
          <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="password_confirmation" class="block mb-1">Confirm Password</label>
        <input
          id="password_confirmation"
          type="password"
          name="password_confirmation"
          required
          class="w-full px-4 py-3 rounded-xl border border-[#4ca6ff] text-[#0f1e47]"
        />
      </div>

      <div>
        <button
          type="submit"
          class="w-full bg-[#4ca6ff] hover:bg-[#3785e4] text-white font-bold py-3 rounded-xl shadow-lg transition"
        >
          Register
        </button>
      </div>
    </form>

    <p class="mt-6 text-center text-sm text-[#1958a8]">
      Already have an account?
      <a href="{{ route('login') }}" class="font-semibold hover:underline text-[#4ca6ff]">Login</a>
    </p>

  </div>

</body>
</html>
