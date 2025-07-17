<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml;base64,PHN2ZyBmaWxsPSIjYmNkOWVhIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCI+PHBhdGggZD0iTTEyIDMgTDIgOSA2IDkgNiAxNSAxOCAxNSAxOCA5IDE4IDkgMTIgMTgiLz48L3N2Zz4=">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Inter:wght@400;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --ayaka-primary: #bcd9ea;
            --ayaka-accent: #d8e9f4;
            --ayaka-deep: #e0dfff;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--ayaka-deep), var(--ayaka-accent), var(--ayaka-primary));
            background-size: 400% 400%;
            animation: gradientBG 20s ease infinite;
            color: #334155;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        h1, h2, h3, h4 {
            font-family: 'DM Serif Display', serif;
        }

        .frosted {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .snowflake {
            position: fixed;
            top: -5%;
            color: #ffffffaa;
            font-size: 1.1rem;
            animation: fall linear infinite;
            z-index: 10;
            pointer-events: none;
        }

        @keyframes fall {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(120vh) rotate(360deg);
                opacity: 0;
            }
        }

        .ayaka-mode {
            background: linear-gradient(to bottom right, #f0f4ff, #dfeaf7, #bcd9ea) !important;
            color: #1e293b !important;
        }

        #loadingOverlay {
            background: rgba(255, 255, 255, 0.75);
            z-index: 100;
        }

        .btn-glass {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(8px);
            border-radius: 1rem;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
            transition: all 0.2s ease;
        }

        .btn-glass:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body class="min-h-screen antialiased overflow-x-hidden relative">

    <!-- Snowflake Overlay -->
    @for ($i = 0; $i < 30; $i++)
        <div 
            class="snowflake"
            style="left: {{ rand(0, 100) }}%; font-size: {{ rand(12, 20) / 10 }}rem; animation-duration: {{ rand(10, 20) }}s; animation-delay: -{{ rand(0, 20) }}s;"
        >
            ❄️
        </div>
    @endfor

    <!-- Loading Spinner -->
    <div id="loadingOverlay" class="fixed inset-0 hidden flex items-center justify-center">
        <div class="animate-spin h-16 w-16 border-4 border-blue-300 border-t-transparent rounded-full"></div>
    </div>

    <!-- Toggle Ayaka Mode -->
    <button id="ayakaToggleBtn" class="btn-glass fixed top-5 right-5 z-50 text-sm px-4 py-2 text-[#1e293b]">
        🌸 Ayaka Mode
    </button>

    <!-- Back to Top -->
    <button 
        onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
        id="backToTopBtn"
        class="btn-glass fixed bottom-6 right-6 text-xl p-3 hidden text-indigo-800"
    >
        ⬆️
    </button>

    <!-- Layout Wrapper -->
    <div class="min-h-screen flex flex-col relative z-10">

        @include('layouts.navigation')

        @if (isset($header))
            <header class="frosted mx-4 mt-6 p-6 shadow-lg">
                <div class="max-w-7xl mx-auto px-4">
                    <h1 class="text-4xl text-[#2e3655] drop-shadow-sm">{{ $header }}</h1>
                </div>
            </header>
        @endif

        <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="space-y-10">
                @yield('content')
            </div>
        </main>

        @php
            $quotes = [
                "Snow illuminates the land, just as I illuminate my clan.",
                "Grace is not simply given — it is practiced.",
                "Even the frost has warmth when shared with the right people.",
                "I am Kamisato Ayaka, a humble servant of the Shogun.",
            ];
        @endphp

        <footer class="frosted text-center text-gray-600 text-sm py-5">
            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.<br>
            <span class="italic text-xs text-blue-900 mt-2 block">“{{ $quotes[array_rand($quotes)] }}”</span>
        </footer>
    </div>

    <!-- Script Logic -->
    <script>
        const toggleBtn = document.getElementById('ayakaToggleBtn');
        const body = document.body;
        const MODE_KEY = 'ayaka_mode';

        if (localStorage.getItem(MODE_KEY) === 'on') {
            body.classList.add('ayaka-mode');
        }

        toggleBtn.addEventListener('click', () => {
            const isOn = body.classList.toggle('ayaka-mode');
            localStorage.setItem(MODE_KEY, isOn ? 'on' : 'off');
        });

        // Show loading
        window.addEventListener('beforeunload', () => {
            document.getElementById('loadingOverlay').classList.remove('hidden');
        });

        // Back to top toggle
        const backToTop = document.getElementById('backToTopBtn');
        window.addEventListener('scroll', () => {
            backToTop.classList.toggle('hidden', window.scrollY < 250);
        });
    </script>
</body>
</html>
