<!DOCTYPE html>
<html class="h-full bg-gray-900" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onpa</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- For Blade-stacked CSS (if you push styles elsewhere) --}}
    @stack('styles')

    <style>
        .text-pink {
            color: #e43397;
        }
    </style>
</head>

<body class="bg-gray-900 text-white">

    {{-- HEADER SECTION --}}
    <header class="fixed top-0 left-0 w-full bg-gray-800/80 backdrop-blur-md border-b border-gray-700 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            {{-- Logo + Name --}}
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/onpa-logo.png') }}" alt="Onpa Logo" class="w-12 h-12">
                <h1 class="text-2xl font-bold text-pink-400 tracking-wide">Onpa</h1>
            </div>

            {{-- Navigation Buttons --}}
            <nav class="flex items-center space-x-6 text-sm font-medium">
                <a href="{{ route('login') }}"
                    class="px-4 py-2 rounded-lg bg-gray-700 hover:bg-gray-600 transition text-white">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="px-4 py-2 rounded-lg bg-pink-500 hover:bg-pink-600 transition text-white font-semibold shadow-md">
                    Sign Up
                </a>
            </nav>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="pt-32 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div
            class="relative isolate overflow-hidden bg-gray-800 px-6 pt-16 sm:rounded-3xl sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0 after:pointer-events-none after:absolute after:inset-0 after:inset-ring after:inset-ring-white/10">

            {{-- Background Glow SVG --}}
            <svg viewBox="0 0 1024 1024" aria-hidden="true"
                class="absolute top-1/2 left-1/2 -z-10 w-[512px] -translate-y-1/2 sm:left-full sm:-ml-80 lg:left-1/2 lg:-translate-x-1/2 lg:translate-y-0">
                <circle r="512" cx="512" cy="512" fill="url(#gradient-1)" fill-opacity="0.7" />
                <defs>
                    <radialGradient id="gradient-1">
                        <stop stop-color="#7775D6" />
                        <stop offset="1" stop-color="#E935C1" />
                    </radialGradient>
                </defs>
            </svg>

            {{-- Text Section --}}
            <div class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left lg:w-1/2">

                {{ $slot }}
            </div>


            {{-- Image Section --}}
            {{-- <div class="relative mt-16 h-auto lg:mt-8 lg:flex-none lg:w-1/2">
                <img src="/images/App_Screenshot.png" alt="App screenshot"
                    class="w-full rounded-md bg-white/5 ring-1 ring-white/10" />
            </div> --}}

        </div>
    </main>

    @stack('scripts')
</body>

</html>
