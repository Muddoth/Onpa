<x-layout title="Create Playlist">
    <div class="max-w-4xl mx-auto mt-10 bg-gray-800/70 p-8 rounded-2xl shadow-lg border border-gray-700">
        <h1 class="text-3xl font-bold text-cyan-400 mb-8 text-center">Create a New Playlist</h1>

        <form action="{{ route('playlists.store') }}" method="POST">
            @csrf

            <!-- Playlist Name -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Playlist Name</label>
                <input type="text" name="name" id="name" required
                    class="w-full px-4 py-2 bg-gray-900 text-white rounded-lg border border-gray-700 focus:border-cyan-400 focus:ring focus:ring-cyan-400/20 transition">
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full px-4 py-2 bg-gray-900 text-white rounded-lg border border-gray-700 focus:border-cyan-400 focus:ring focus:ring-cyan-400/20 transition"></textarea>
            </div>

            <!-- Song Selection -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-cyan-400 mb-4">Select Songs to Include</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 max-h-80 overflow-y-auto">
                    @forelse ($songs as $song)
                        <label class="flex items-center bg-gray-900/60 hover:bg-gray-700/60 transition p-3 rounded-lg cursor-pointer">
                            <input type="checkbox" name="songs[]" value="{{ $song->id }}"
                                class="mr-3 text-cyan-400 focus:ring-cyan-500">
                            <div>
                                <p class="text-white font-medium">{{ $song->name }}</p>
                                <p class="text-gray-400 text-sm">{{ $song->artist_name }}</p>
                            </div>
                        </label>
                    @empty
                        <p class="text-gray-400 text-center col-span-full">No songs available to add.</p>
                    @endforelse
                </div>
            </div>

            <!-- Submit -->
            <div class="text-center">
                <button type="submit"
                    class="px-8 py-3 bg-cyan-500 hover:bg-cyan-600 text-white font-semibold rounded-lg shadow-md transition">
                    Create Playlist
                </button>
            </div>
        </form>
    </div>
</x-layout>
