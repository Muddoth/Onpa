<x-layout title="Profile Page">
    <div class="max-w-md p-8 sm:flex sm:space-x-6 bg-gray-800 text-white rounded-xl shadow-lg mx-auto mt-10">
        <div class="flex-shrink-0 w-full mb-6 h-44 sm:h-32 sm:w-32 sm:mb-0">
            <img src="{{ asset($profile->profile_picture ?? 'images/default-avatar.png') }}" alt="{{ $profile->name }}"
                class="object-cover object-center w-full h-full rounded-lg bg-gray-700">
        </div>

        <div class="flex flex-col space-y-4">
            <div>
                <h2 class="text-2xl font-semibold text-pink-400">{{ $profile->name }}</h2>
                <span class="text-sm text-gray-300">{{ $profile->gender }}, {{ $profile->age }} years old</span>
            </div>
            <div class="text-gray-400 text-sm italic">
                {{ $profile->bio ?? 'No bio available yet.' }}
            </div>
            <div>
                <span class="block text-sm text-gray-300">
                    Favourite Genres: {{ $profile->favourite_genres ?? 'Not specified' }}
                </span>
            </div>

            <div>
                <a href="{{ route('profiles.edit') }}"
                    class="inline-block mt-4 px-4 py-2 bg-pink-500 hover:bg-pink-600 rounded-lg text-sm font-semibold">
                    Edit Profile
                </a>

                <form id="form-delete" action="{{ route('profiles.delete', $profile->id) }}" method="POST"
                    class="inline-block mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-500 hover:bg-red-600 rounded-lg text-sm font-semibold">
                        Delete Profile
                    </button>
                </form>

            </div>

        </div>
    </div>
</x-layout>