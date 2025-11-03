<!DOCTYPE html>
<html class="h-full bg-gray-900" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onpa Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<style>
    .body {}

    .text-pink {
        color: #e43397;
    }
</style>

<body class="bg-gray-900 flex">


    <!-- Sidebar -->
    <aside class="w-1/5 bg-gray-800/50 text-white min-h-screen p-6 border-gray-700 fixed">
        <div class="flex items-center mb-10 space-x-3">
            <img src="{{ asset('images/onpa-logo.png') }}" alt="Onpa Logo" class="w-20 h-20">
            <h1 class="text-2xl font-bold text-pink-400">Onpa</h1>
        </div>
        <nav class="flex flex-col space-y-4 text-xl">
            <a href="{{ route('dashboard') }}"
                class="transition {{ request()->routeIs('dashboard') ? 'text-pink-400 font-semibold' : 'text-white hover:text-pink-400' }}">
                Dashboard
            </a>

            <a href="{{ route('songs.index') }}"
                class="transition {{ request()->routeIs('songs.index') ? 'text-pink-400 font-semibold' : 'text-white hover:text-pink-400' }}">
                Songs
            </a>

            <a href="{{ route('profiles.index') }}"
                class="transition {{ request()->routeIs('profiles.index') ? 'text-pink-400 font-semibold' : 'text-white hover:text-pink-400' }}">
                User Profile
            </a>

            <a href="{{ route('playlist') }}"
                class="transition {{ request()->routeIs('playlist') ? 'text-pink-400 font-semibold' : 'text-white hover:text-pink-400' }}">
                Playlist
            </a>
        </nav>

    </aside>



    <!-- Main Content -->
    <main class="flex-1 p-8 ml-[20%]"> <!-- shift right by sidebar width -->
        <!-- Header Bar -->
        <div
            class="bg-gray-900 border-b border-gray-700 p-4 mb-8 flex justify-between items-center fixed top-0 left-[20%] w-[80%] z-50">
            <h1 class="text-3xl font-bold text-pink-400">{{ $title ?? '' }}</h1>
            @isset($headerButton)
                <div>
                    {{ $headerButton }}
                </div>
            @endisset
        </div>

        <!-- Add padding-top so content isn't hidden under header -->
        <div class="pt-20">
            {{ $slot }}
        </div>
    </main>

</body>

</html>