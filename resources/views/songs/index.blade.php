<x-layout title="Songs Page">
    @slot('headerButton')
    <a href="{{ route('songs.create') }}"
        class="bg-teal-500 hover:bg-teal-600 text-white font-semibold px-4 py-2 rounded-lg">
        Create Song
    </a>
 
    @endslot

    <!-- Music Player Cards -->
    <div class="w-full space-y-8">
        @forelse ($songs as $song)
                <a href="{{ route('songs.show', $song->id) }}">
                    <div
                        class="bg-gray-800 rounded-2xl shadow-lg p-6 hover:scale-105 transition-transform duration-300 hover:shadow-xl border border-gray-700 flex w-11/12 overflow-hidden mx-auto">

                        <div class="flex flex-col w-full">
                            <!-- Header -->
                            <div class="flex p-5 border-b border-gray-700">
                                <img class="w-20 h-20 object-cover rounded-lg bg-gray-700" alt="Cover Art"
                                    src="{{ asset($song->image_path ?? 'images/song-icon.png') }}">
                                <div class="flex flex-col px-3 w-full">
                                    <span
                                        class="text-xs {{ $loop->first ? 'text-teal-400' : 'text-gray-400' }} uppercase font-medium">
                                        {{ $loop->first ? 'Now Playing' : 'Recently Added' }}
                                    </span>

                                    <span class="text-sm text-pink-400 capitalize font-semibold pt-1">
                                        {{ $song->name }}
                                    </span>
                                    <span class="text-xs text-white uppercase font-medium">
                                        — "{{ $song->album }}" by {{ $song->artist_name }}
                                    </span>
                                </div>
                            </div>

                            <!-- Controls -->
                            <div class="flex flex-col sm:flex-row items-center p-5">
                                <div class="flex items-center space-x-3 p-2">
                                    <button class="focus:outline-none">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="#e43397" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polygon points="19 20 9 12 19 4 19 20"></polygon>
                                            <line x1="5" y1="19" x2="5" y2="5"></line>
                                        </svg>
                                    </button>
                </a>

                <!-- Play button -->
                <button
                    class="rounded-full w-10 h-10 flex items-center justify-center pl-0.5 ring-1 ring-pink-400 focus:outline-none">
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

            <!-- Progress bar -->
            <div class="relative w-full sm:w-1/2 md:w-7/12 lg:w-4/6 ml-2">
                <div class="bg-pink-300 h-2 w-full rounded-lg"></div>
                <div class="bg-pink-500 h-2 w-1/2 rounded-lg absolute top-0"></div>
            </div>

            <div class="flex justify-end w-full sm:w-auto pt-1 sm:pt-0">
                <span class="text-xs text-white uppercase font-medium pl-2">
                    00:00 / 00:00
                </span>
            </div>
            </div>

            <!-- Audio player -->
            <div class="px-5">
                <audio controls class="w-full mt-2">
                    <source src="{{ asset($song->file_path) }}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
            </div>
            </div>
        @empty
        <div class="text-center text-gray-400 w-full py-10">
            No songs available yet.
        </div>
    @endforelse
    </div>
    <div class="mt-6">
        {{ $songs->links() }}
    </div>
</x-layout>