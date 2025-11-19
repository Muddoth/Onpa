<x-layout title="Playlist">
    {{-- <script>
        window.playlists = @json($playlists);
    </script> --}}

    @slot('headerButton')
        <a href="{{ route('playlists.create') }}"
            class="bg-cyan-500 hover:bg-cyan-600 text-white font-semibold px-4 py-2 rounded-lg">
            Create Playlist
        </a>
    @endslot    

    <div id="songs-app" class="text-white">
        {{-- <playlist-list :playlists="playlists" /> --}}
        <playlist-list :playlists="playlists"></playlist-list>

    </div>

    @vite('resources/js/app.js')
</x-layout>
