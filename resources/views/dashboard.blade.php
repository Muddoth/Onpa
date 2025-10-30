<x-layout>

    <!-- Status Cards -->
    <div class="grid grid-cols-2 gap-6 mb-8">
        <div
            class="bg-gray-800 rounded-2xl shadow-lg p-6 hover:scale-105 transition-transform duration-300 hover:shadow-xl border border-gray-700 p-6 flex justify-between items-center">
            <div>
                <h2 class="text-white text-sm uppercase">Total Songs</h2>
                <p class="text-3xl font-bold text-pink-500">{{ $totalSongs }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-pink-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19V6l12-2v13M9 19l-6-2V4l6 2m0 13l6 2m0 0V6M15 21V8" />
            </svg>
        </div>
        <div
            class="bg-gray-800 rounded-2xl shadow-lg p-6 hover:scale-105 transition-transform duration-300 hover:shadow-xl border border-gray-700 p-6 flex justify-between items-center">
            <div>
                <h2 class="text-white text-sm uppercase">Total Genres</h2>
                <p class="text-3xl font-bold text-pink-500">{{ $totalGenres }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-pink-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3m0 0l7 7-7 7" />
            </svg>
        </div>
    </div>

    <!-- Music Player Card -->
    <!-- This is the provided component -->
    <div class="w-full">
        <div
            class='bg-gray-800 rounded-2xl shadow-lg p-6 hover:scale-105 transition-transform duration-300 hover:shadow-xl border border-gray-700 flex w-11/12  overflow-hidden mx-auto'>
            <div class="flex flex-col w-full">
                <div class="flex p-5 border-b">
                    <img class='w-20 h-20 object-cover' alt='User avatar'
                        src='https://images.unsplash.com/photo-1477118476589-bff2c5c4cfbb?auto=format&fit=crop&w=200&q=200'>
                    <div class="flex flex-col px-2 w-full">
                        <span class="text-xs text-blue-500 uppercase font-medium">now playing</span>
                        <span class="text-sm text-pink-500 capitalize font-semibold pt-1">
                            I think I need a sunrise, I'm tired of the sunset
                        </span>
                        <span class="text-xs text-white uppercase font-medium">
                            -"Boston," Augustana
                        </span>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center p-5">
                    <div class="flex items-center">
                        <div class="flex space-x-3 p-2">
                            <button class="focus:outline-none">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="#e43397" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="19 20 9 12 19 4 19 20"></polygon>
                                    <line x1="5" y1="19" x2="5" y2="5"></line>
                                </svg>
                            </button>
                            <button
                                class="rounded-full w-10 h-10 flex items-center justify-center pl-0.5 ring-1 ring-blue-400 focus:outline-none">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="#e43397" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                            </button>
                            <button class="focus:outline-none">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="#e43397" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="5 4 15 12 5 20 5 4"></polygon>
                                    <line x1="19" y1="5" x2="19" y2="19"></line>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="relative w-full sm:w-1/2 md:w-7/12 lg:w-4/6 ml-2">
                        <div class="bg-blue-300 h-2 w-full rounded-lg"></div>
                        <div class="bg-blue-500 h-2 w-1/2 rounded-lg absolute top-0"></div>
                    </div>
                    <div class="flex justify-end w-full sm:w-auto pt-1 sm:pt-0">
                        <span class="text-xs text-white uppercase font-medium pl-2">
                            02:00/04:00
                        </span>
                    </div>

                    <!--Playlist-->
                    <div class="flex flex-col p-5">

                        <div class="flex border-b py-3 cursor-pointer hover:shadow-md px-2">
                            <img class='w-10 h-10 object-cover rounded-lg' alt='User avatar'
                                src='https://images.unsplash.com/photo-1477118476589-bff2c5c4cfbb?auto=format&fit=crop&w=200&q=200'>
                            <div class="flex flex-col px-2 w-full">
                                <span class="text-sm text-pink-500 capitalize font-semibold pt-1">
                                    I think I need a sunrise, I'm tired of the sunset
                                </span>
                                <span class="text-xs text-white uppercase font-medium">
                                    -"Boston," Augustana
                                </span>
                            </div>
                        </div>

                        <div class="flex border-b py-3 cursor-pointer hover:shadow-md px-2">
                            <img class='w-10 h-10 object-cover rounded-lg' alt='User avatar'
                                src='https://images.unsplash.com/photo-1477118476589-bff2c5c4cfbb?auto=format&fit=crop&w=200&q=200'>
                            <div class="flex flex-col px-2 w-full">
                                <span class="text-sm text-pink-500 capitalize font-semibold pt-1">
                                    I think I need a sunrise, I'm tired of the sunset
                                </span>
                                <span class="text-xs text-white uppercase font-medium">
                                    -"Boston," Augustana
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>

</x-layout>