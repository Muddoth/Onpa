<x-layout title="Edit Song">
    <div class="vw-80%">
        <form action="{{ route('songs.update', $song->id) }}" method="POST" enctype="multipart/form-data" class="mx-auto space-y-4">
            @csrf
            @method('PATCH')

            <!-- Song Information -->
            <div class="border-b border-white/10 pb-12">
                <h2 class="text-base/7 font-semibold text-white">Edit Song</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">

                    <!-- Name -->
                    <div class="sm:col-span-1">
                        <label for="name" class="block text-sm/6 font-medium text-white">Song Name</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name"
                                value="{{ old('name', $song->name) }}"
                                class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white placeholder:text-gray-500 focus:outline-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Artist Name -->
                    <div class="sm:col-span-1">
                        <label for="artist_name" class="block text-sm/6 font-medium text-white">Artist Name</label>
                        <div class="mt-2">
                            <input type="text" name="artist_name" id="artist_name"
                                value="{{ old('artist_name', $song->artist_name) }}"
                                class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white placeholder:text-gray-500 focus:outline-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                        @error('artist_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Album -->
                    <div class="sm:col-span-1">
                        <label for="album" class="block text-sm/6 font-medium text-white">Album</label>
                        <div class="mt-2">
                            <input type="text" name="album" id="album"
                                value="{{ old('album', $song->album) }}"
                                class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white placeholder:text-gray-500 focus:outline-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                        @error('album')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Genre -->
                    <div class="sm:col-span-1">
                        <label for="genre" class="block text-sm/6 font-medium text-white">Genre</label>
                        <div class="mt-2">
                            <select name="genre" id="genre"
                                class="block w-full rounded-md bg-gray-800 px-3 py-1.5 text-base text-white focus:outline-2 focus:outline-indigo-500 sm:text-sm/6">
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre }}" {{ old('genre', $song->genre) == $genre ? 'selected' : '' }}>
                                        {{ $genre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('genre')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Audio File -->
                    <div class="sm:col-span-1">
                        <label for="audio" class="block text-sm/6 font-medium text-white">Audio File</label>
                        <input type="file" name="audio" id="audio" accept="audio/*"
                            class="block w-full mt-2 text-sm text-gray-300 border border-gray-600 rounded-lg cursor-pointer bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @if ($song->file_path)
                            <p class="mt-2 text-gray-400 text-sm">Current: {{ basename($song->file_path) }}</p>
                            <audio controls class="mt-2 w-full">
                                <source src="{{ asset($song->file_path) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        @endif
                        @error('audio')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image File -->
                    <div class="sm:col-span-1">
                        <label for="image" class="block text-sm/6 font-medium text-white">Cover Image</label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="block w-full mt-2 text-sm text-gray-300 border border-gray-600 rounded-lg cursor-pointer bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @if ($song->image_path)
                            <p class="mt-2 text-gray-400 text-sm">Current Image:</p>
                            <img src="{{ asset($song->image_path) }}" alt="Current Cover"
                                class="w-24 h-24 mt-2 object-cover rounded-md border border-gray-700">
                        @endif
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Submit -->
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="{{ route('songs.index') }}" class="text-sm/6 font-semibold text-white">Cancel</a>
                <button type="submit"
                    class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-indigo-500">Update</button>
            </div>
        </form>
    </div>
</x-layout>
