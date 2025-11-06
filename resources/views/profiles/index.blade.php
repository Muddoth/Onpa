<x-layout title="Profile Page">
    @slot('headerButton')
    @role('admin')
    <a href="{{ route('profiles.create') }}"
        class="bg-cyan-500 hover:bg-cyan-600 text-white font-semibold px-4 py-2 rounded-lg">
        Create User
    </a>
    @endrole

    @endslot
    @if(auth()->user()->hasRole('admin'))
        <div class="grid grid-cols-3 gap-6 max-w-7xl mx-auto p-6">
            @foreach($profiles as $profile)
                <div class="bg-gray-800 text-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <img src="{{ asset($profile->profile_picture ?? 'images/default-avatar.png') }}"
                            alt="{{ $profile->name }}" class="w-16 h-16 rounded-full object-cover bg-gray-700">
                        <div>
                            <h3 class="text-lg font-semibold text-pink-400">{{ $profile->name }}</h3>
                            <p class="text-gray-300 text-sm">{{ $profile->gender }}, {{ $profile->age }} years old</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm italic mb-4">{{ $profile->bio ?? 'No bio available yet.' }}</p>
                    <p class="text-gray-300 text-sm mb-4">
                        Favourite Genres: {{ $profile->favourite_genres ?? 'Not specified' }}
                    </p>

                    <div class="flex space-x-4">
                        <a href="{{ route('profiles.edit', $profile->id) }}"
                            class="px-4 py-2 bg-pink-500 hover:bg-pink-600 rounded-lg text-sm font-semibold">
                            Edit
                        </a>

                        <form action="{{ route('profiles.delete', $profile->id) }}" method="POST"
                            onsubmit="return confirm('Delete this profile?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 bg-red-500 hover:bg-red-600 rounded-lg text-sm font-semibold">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6 max-w-7xl mx-auto px-6">
            {{ $profiles->links() }}
        </div>
    @else
        <div class="max-w-md p-8 sm:flex sm:space-x-6 bg-gray-800 text-white rounded-xl shadow-lg mx-auto mt-10">
            <div class="flex-shrink-0 w-full mb-6 h-44 sm:h-32 sm:w-32 sm:mb-0">
                <img src="{{ asset($profiles->profile_picture ?? 'images/default-avatar.png') }}"
                    alt="{{ $profiles->name }}" class="object-cover object-center w-full h-full rounded-lg bg-gray-700">
            </div>

            <div class="flex flex-col space-y-4">
                <div>
                    <h2 class="text-2xl font-semibold text-pink-400">{{ $profiles->name }}</h2>
                    <span class="text-sm text-gray-300">{{ $profiles->gender }}, {{ $profiles->age }} years old</span>
                </div>
                <div class="text-gray-400 text-sm italic">
                    {{ $profiles->bio ?? 'No bio available yet.' }}
                </div>
                <div>
                    <span class="block text-sm text-gray-300">
                        Favourite Genres: {{ $profiles->favourite_genres ?? 'Not specified' }}
                    </span>
                </div>

                <div>
                    <a href="{{ route('profiles.edit', $profiles->id) }}"
                        class="inline-block mt-4 px-4 py-2 bg-pink-500 hover:bg-pink-600 rounded-lg text-sm font-semibold">
                        Edit Profile
                    </a>

                    <form id="form-delete" action="{{ route('profiles.delete', $profiles->id) }}" method="POST"
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
    @endif

</x-layout>