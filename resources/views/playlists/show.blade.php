<style>
    .hidden-audio::-webkit-media-controls {
        display: none !important;
    }

    .hidden-audio::-moz-media-controls {
        display: none !important;
    }

    .hidden-audio {
        outline: none;
    }

    #musicPlayer {
        backdrop-filter: blur(10px);
    }
</style>

<x-layout title="{{ $playlist->name }}">
    @slot('headerButton')

    <div>
        <a href="{{ route('playlists.edit', $playlist->id) }}"
            class="mx-2 text-white inline-block mt-4 px-4 py-2 bg-pink-500 hover:bg-pink-600 rounded-lg text-sm font-semibold">
            Edit Playlist
        </a>

        <form id="form-delete" action="{{ route('playlists.delete', $playlist->id) }}" method="POST"
            class="inline-block mt-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="mx-2 text-white px-4 py-2 bg-red-500 hover:bg-red-600 rounded-lg text-sm font-semibold">
                Delete Playlist
            </button>
        </form>

    </div>

    @endslot

    <!-- Music Player Cards -->
    <div class="w-full space-y-8 pb-60">
        <div class="bg-gray-800  rounded-2xl shadow-lg p-6 border border-gray-700 flex w-11/12 overflow-hidden mx-auto">

            <div class="flex flex-col w-full">
                <ul role="list" class="divide-y divide-white/5">

                    @forelse ($playlist->songs as $song)
                        <li class="song-item flex justify-between items-center gap-x-6 py-5 hover:scale-105 transition-transform duration-300 hover:shadow-xl rounded-lg px-3 border-b border-gray-700"
                            data-audio="{{ asset($song->file_path) }}" data-name="{{ $song->name }}"
                            data-artist="{{ $song->artist_name }}"
                            data-image="{{ asset($song->image_path ?? 'images/song-icon.png') }}">

                            <!-- Left side: Song details -->
                            <div class="flex items-center gap-x-4">
                                <img src="{{ asset($song->image_path ?? 'images/song-icon.png') }}" alt="Song Icon"
                                    class="w-20 h-20 object-cover rounded-full bg-gray-700" />

                                <div class="min-w-0">
                                    <p>
                                        <span class="text-lg font-semibold text-purple-500">{{ $song->name }}</span>
                                        <span class="text-sm text-white"> by {{ $song->artist_name }}</span>
                                    </p>
                                    <p class="mt-1 truncate text-xs text-white">{{ is_array($song->genre) ? implode(', ', $song->genre) : $song->genre }}</p>
                                    <p class="text-sm text-white">Album: {{ $song->album }}</p>
                                </div>
                            </div>

                            <!-- Right side: Buttons -->
                            <div class="flex gap-3 items-center">
                                <a href="{{ route('songs.show', $song->id) }}"
                                    class="inline-flex items-center justify-center px-4 py-1.5 text-sm font-medium rounded-lg bg-purple-500 hover:bg-purple-600 text-white shadow-md transition duration-200">
                                    View
                                </a>

                                @role('admin')
                                <a href="{{ route('songs.edit', $song->id) }}"
                                    class="inline-flex items-center justify-center px-4 py-1.5 text-sm font-medium rounded-lg bg-pink-400 hover:bg-pink-500 text-white shadow-md transition duration-200">
                                    Edit
                                </a>

                                <form action="{{ route('songs.delete', $song->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this song?');" class="pt-4 align-middle">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center justify-center px-4 py-1.5 text-sm font-medium rounded-lg bg-red-500 hover:bg-red-600 text-white shadow-md transition duration-200">
                                        Delete
                                    </button>
                                </form>
                                @endrole
                            </div>

                        </li>


                    @empty
                        <div class="text-center text-gray-400 w-full py-10">
                            No songs available yet.
                        </div>
                    @endforelse
                </ul>
            </div>
        </div>



    </div>

    <x-music-player />




</x-layout>