<x-layout title="Songs Page">
    @slot('headerButton')
        @can('create songs')
            <a href="{{ route('songs.create') }}"
                class="bg-cyan-500 hover:bg-cyan-600 text-white font-semibold px-4 py-2 rounded-lg">
                Create Song
            </a>
        @endcan
    @endslot

    {{-- Vue Parent Component --}}
    <div id="songs-app" class="text-white">
        {{-- Vue Child Components --}}
        <song-search :genres='@json($genres)' @search="fetchSongs"></song-search>
        <song-list :songs="songs" @select-song="currentSong = $event"   @refresh="handleRefresh"></song-list>
        {{-- <music-player :song="currentSong"></music-player> --}}
        <music-player :song="currentSong" :playlist="songs" @select-song="handleSelectSong"></music-player>

    </div>


    @vite('resources/js/app.js')
    
</x-layout>
