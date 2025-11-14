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

<x-layout title="Songs Page">
    @slot('headerButton')
        @can('create songs')
            <a href="{{ route('songs.create') }}"
                class="bg-cyan-500 hover:bg-cyan-600 text-white font-semibold px-4 py-2 rounded-lg">
                Create Song
            </a>
        @endcan
    @endslot

    <!--Genre Loops-->
    <div class="genre-filters flex flex-wrap gap-3 mb-6 justify-center">
        <button data-genre="all"
            class="genre-btn px-4 py-2 rounded-full bg-indigo-600 text-white hover:bg-indigo-700">All</button>
        @foreach ($genres as $genre)
            <button data-genre="{{ $genre }}"
                class="genre-btn px-4 py-2 rounded-full bg-gray-600 text-white hover:bg-gray-700">
                {{ $genre }}
            </button>
        @endforeach
    </div>


    <!-- Music Player Cards -->
    <div class="w-full space-y-8 pb-60">
        <div class="bg-gray-800  rounded-2xl shadow-lg p-6 border border-gray-700 flex w-11/12 overflow-hidden mx-auto">

            <div class="flex flex-col w-full">
                <ul role="list" class="divide-y divide-white/5">
                    @forelse ($songs as $song)
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
                                    <p class="mt-1 truncate text-xs text-white">
                                        {{ is_array($song->genre) ? implode(', ', $song->genre) : $song->genre ?? '' }}
                                    </p>
                                    <p class="text-sm text-white">Album: {{ $song->album }}</p>
                                </div>
                            </div>

                            <!-- Right side: Buttons -->
                            <div class="flex gap-3 items-center">
                                <a href="{{ route('songs.show', $song->id) }}"
                                    class="inline-flex items-center justify-center px-4 py-1.5 text-sm font-medium rounded-lg bg-purple-500 hover:bg-purple-600 text-white shadow-md transition duration-200">
                                    View
                                </a>

                                @can('update', $song)
                                    <a href="{{ route('songs.edit', $song->id) }}"
                                        class="inline-flex items-center justify-center px-4 py-1.5 text-sm font-medium rounded-lg bg-pink-400 hover:bg-pink-500 text-white shadow-md transition duration-200">
                                        Edit
                                    </a>
                                @endcan

                                @can('delete', $song)
                                    <form action="{{ route('songs.delete', $song->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this song?');" class="pt-4 align-middle">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center px-4 py-1.5 text-sm font-medium rounded-lg bg-red-500 hover:bg-red-600 text-white shadow-md transition duration-200">
                                            Delete
                                        </button>
                                    </form>
                                @endcan
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

    <div class="fixed bottom-28 left-0 w-full flex justify-center z-40">
        <div class="px-4 py-2">
            <div class="pagination gap-2">
                {{ $songs->links() }}
            </div>
        </div>
    </div>
    <x-music-player />



    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const buttons = document.querySelectorAll('.genre-btn');
            const songList = document.querySelector('ul[role="list"]');

            // Helper mimics Laravel's asset()
            const asset = (path) => `/${path.replace(/^\/+/, '')}`;

            buttons.forEach(button => {
                button.addEventListener('click', async () => {
                    const genre = button.dataset.genre;

                    // Visual active state
                    buttons.forEach(btn => btn.classList.remove('bg-indigo-600'));
                    button.classList.add('bg-indigo-600');

                    // Fetch filtered songs from API
                    const res = await fetch(`/api/songs?genre=${encodeURIComponent(genre)}`);
                    const songs = await res.json();

                    // Clear current list
                    songList.innerHTML = '';

                    if (songs.length === 0) {
                        songList.innerHTML =
                            `<div class="text-center text-gray-400 w-full py-10">No songs available for "${genre}".</div>`;
                        return;
                    }

                    // Render new song items
                    songs.forEach(song => {
                        const li = document.createElement('li');
                        li.className =
                            'song-item flex justify-between items-center gap-x-6 py-5 hover:scale-105 transition-transform duration-300 hover:shadow-xl rounded-lg px-3 border-b border-gray-700';

                        li.setAttribute('data-audio', asset(song.file_path));

                        const image = song.image_path ? asset(song.image_path) : asset(
                            'images/song-icon.png');
                        li.setAttribute('data-image', image);
                        li.setAttribute('data-name', song.name);
                        li.setAttribute('data-artist', song.artist_name);

                        // Conditional buttons HTML
                        let editButton = '';
                        let deleteForm = '';

                        if (song.can_update) {
                            editButton =
                                `<a href="/songs/${song.id}/edit" class="inline-flex items-center justify-center px-4 py-1.5 text-sm font-medium rounded-lg bg-pink-400 hover:bg-pink-500 text-white shadow-md transition duration-200">Edit</a>`;
                        }

                        if (song.can_delete) {
                            deleteForm = `
                        <form action="/songs/${song.id}" method="POST" onsubmit="return confirm('Delete this song?');" class="pt-4 align-middle">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="inline-flex items-center justify-center px-4 py-1.5 text-sm font-medium rounded-lg bg-red-500 hover:bg-red-600 text-white shadow-md transition duration-200">Delete</button>
                        </form>`;

                        }

                        li.innerHTML = `
                <div class="flex items-center gap-x-4">
                    <img src="${image}" alt="Song Icon" class="w-20 h-20 object-cover rounded-full bg-gray-700" />
                    <div class="min-w-0">
                        <p>
                            <span class="text-lg font-semibold text-purple-500">${song.name}</span>
                            <span class="text-sm text-white"> by ${song.artist_name}</span>
                        </p>
                        <p class="mt-1 truncate text-xs text-white">${Array.isArray(song.genre) ? song.genre.join(', ') : song.genre || ''}</p>
                        <p class="text-sm text-white">Album: ${song.album || ''}</p>
                    </div>
                </div>
                <div class="flex gap-3 items-center">
                    <a href="/songs/${song.id}" class="inline-flex items-center justify-center px-4 py-1.5 text-sm font-medium rounded-lg bg-purple-500 hover:bg-purple-600 text-white shadow-md transition duration-200">View</a>
                    ${editButton}
                    ${deleteForm}
                </div>
            `;

                        songList.appendChild(li);
                        bindSongClicks();
                    });
                });
            });
        });
    </script>


</x-layout>
