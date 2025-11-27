<div wire:ignore >
    <livewire:profile-search />
</div>

<div  class="grid grid-cols-3 gap-6 max-w-7xl mx-auto p-6">
    @foreach ($profiles as $profile)
        <div  wire:key="profile-{{ $profile->id }}" class="bg-gray-800 text-white rounded-xl shadow-lg p-6">
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
