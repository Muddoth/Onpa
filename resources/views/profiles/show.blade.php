<x-layout title="Show Profile">

    <div class="max-w-lg mx-auto mt-10 bg-gray-800 text-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-semibold text-pink-400 mb-6">Profile Details</h2>

        @if ($profile->profile_picture)
            <div class="mb-4 text-center">
                {{-- <label class="block text-sm font-medium text-gray-400 mb-2">Profile Picture</label> --}}
                <img src="{{ asset($profile->profile_picture) }}" alt="Profile Picture"
                    class="rounded-full mx-auto w-32 h-32 object-cover border border-gray-600">
            </div>
        @endif


        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-400">Name</label>
            <p class="mt-1 text-lg font-semibold">{{ $profile->name }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-400">Age</label>
            <p class="mt-1">{{ $profile->age }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-400">Gender</label>
            <p class="mt-1">{{ $profile->gender }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-400">Bio</label>
            <p class="mt-1 whitespace-pre-line">{{ $profile->bio ?? 'No bio provided.' }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-400">Favourite Genres</label>
            <p class="mt-1">{{ $profile->favourite_genres ?? 'Not specified.' }}</p>
        </div>
        <div class="flex space-x-4">
            <a href="{{ route('profiles.edit', $profile->id) }}"
                class="px-4 py-2 bg-pink-500 hover:bg-pink-600 rounded-lg text-sm font-semibold">
                Edit
            </a>

            <form action="{{ route('profiles.delete', $profile->id) }}" method="POST"
                onsubmit="return confirm('Delete this profile?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 rounded-lg text-sm font-semibold">
                    Delete
                </button>
            </form>
        </div>


    </div>

</x-layout>
