<x-layout title="Playlist Page">
    @slot('headerButton')
    <a href="{{ route('songs.create') }}"
        class="bg-teal-500 hover:bg-teal-600 text-white font-semibold px-4 py-2 rounded-lg">
        Create Playlist
    </a>

    @endslot
</x-layout>