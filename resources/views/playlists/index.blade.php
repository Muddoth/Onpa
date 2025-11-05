<x-layout title="Playlist">
    @slot('headerButton')
    <a href="{{ route('playlists.create') }}"
        class="bg-cyan-500 hover:bg-cyan-600 text-white font-semibold px-4 py-2 rounded-lg">
        Create Playlist
    </a>
    @endslot

    <div class="main-content relative pb-40">
        <!-- Playlists Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($playlists as $playlist)
                <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-md p-5 hover:shadow-xl transition relative group cursor-pointer"
                    onclick="window.location='{{ route('playlists.show', $playlist->id) }}'">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-purple-400 truncate">
                            {{ $playlist->name }}
                        </h2>
                    </div>

                    <div class="border-t border-gray-600 my-4"></div>

                    <!-- Songs List -->
                    <div class="max-h-48 overflow-y-auto custom-scrollbar pr-2 space-y-2">
                        @forelse ($playlist->songs as $song)
                            <div class="song-item flex justify-between items-center bg-gray-700 hover:bg-gray-600 p-2 rounded-md transition"
                                data-audio="{{ asset($song->file_path) }}" data-name="{{ $song->name }}"
                                data-artist="{{ $song->artist_name }}"
                                data-image="{{ asset($song->image_path ?? 'images/song-icon.png') }}"
                                onclick="event.stopPropagation(); playSong(this)">
                                <span class="text-white text-sm truncate">{{ $song->name }}</span>
                                <span class="text-xs text-gray-300">▶</span>
                            </div>
                        @empty
                            <p class="text-gray-400 text-sm text-center">No songs in this playlist</p>
                        @endforelse
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-400 py-10">
                    No playlists found.
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $playlists->links() }}
        </div>

        <!-- ✅ Reusable Music Player Component -->
        <x-music-player />
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #ec4899;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
    </style>


</x-layout>