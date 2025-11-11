<x-layout title="{{ $song->name }}">
    @slot('headerButton')
    @can('update', $song)
        <a href="{{ route('songs.edit', $song->id) }}"
            class="bg-teal-500 hover:bg-teal-600 text-white font-semibold px-4 py-2 rounded-lg m-10">
            Edit Song
        </a>
    @endcan

    @can('delete', $song)
        <form id="delete-form" action="{{ route('songs.delete', $song->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-700 hover:bg-red-800 text-white font-semibold px-4 py-2 rounded-lg">
                Delete Song
            </button>
        </form>
    @endcan
    @endslot

    <div class="w-full">
        <div
            class="bg-gray-800 rounded-2xl shadow-lg p-6 transition-transform duration-300 hover:shadow-xl border border-gray-700 flex w-8/12 overflow-hidden mx-auto">

            <div class="flex flex-col w-full">
                <!-- Song Info -->
                <div class="flex p-5 border-b border-gray-700">
                    <img class="w-20 h-20 object-cover rounded-full bg-gray-700" alt="Album Art"
                        src="{{ asset($song->image_path ?? 'images/song-icon.png') }}">
                    <div class="flex flex-col px-3 w-full">
                        <span class="text-xs text-gray-400 uppercase font-medium">Now Playing</span>
                        <span class="text-lg text-pink-400 capitalize font-semibold pt-1">
                            {{ $song->name }}
                        </span>
                        <span class="text-sm text-gray-300 capitalize font-medium">
                            — "{{ $song->album }}" by {{ $song->artist->name }}
                        </span>
                        <span class="text-xs text-gray-500 uppercase font-medium mt-1">
                            Genre: {{ is_array($song->genre) ? implode(', ', $song->genre) : $song->genre }}
                        </span>
                    </div>
                </div>

                <!-- Player Controls -->
                <div class="flex flex-col sm:flex-row items-center p-5">
                    <div class="flex items-center">
                        <div class="flex space-x-3 p-2">
                            <!-- Previous -->
                            <button class="focus:outline-none hover:scale-110 transition">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="#e43397" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="19 20 9 12 19 4 19 20"></polygon>
                                    <line x1="5" y1="19" x2="5" y2="5"></line>
                                </svg>
                            </button>

                            <!-- Play -->
                            <button
                                class="rounded-full w-10 h-10 flex items-center justify-center ring-1 ring-pink-400 hover:bg-pink-400 hover:text-gray-900 transition focus:outline-none">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                            </button>

                            <!-- Next -->
                            <button class="focus:outline-none hover:scale-110 transition">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="#e43397" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="5 4 15 12 5 20 5 4"></polygon>
                                    <line x1="19" y1="5" x2="19" y2="19"></line>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="relative w-full sm:w-1/2 md:w-7/12 lg:w-4/6 ml-2">
                        <div class="bg-pink-700 h-2 w-full rounded-lg"></div>
                        <div class="bg-pink-500 h-2 w-1/2 rounded-lg absolute top-0"></div>
                    </div>

                    <!-- Duration -->
                    <div class="flex justify-end w-full sm:w-auto pt-1 sm:pt-0">
                        <span class="text-xs text-white uppercase font-medium pl-2">
                            02:00 / 04:00
                        </span>
                    </div>
                </div>

                <!-- Audio Player -->
                <div hidden class="mt-4 px-5">
                    <audio controls class="w-full rounded-lg">
                        <source src="{{ asset($song->file_path) }}" type="audio/mpeg">
                    </audio>

                </div>
            </div>
        </div>
    </div>
</x-layout>