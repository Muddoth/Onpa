<div class="p-6">

    <div class="flex ">
        <input type="text" class="border rounded p-2 w-full mx-5" placeholder="Search profiles..."
            wire:model.live.debounce.300ms="search">

        @error('search')
            {{$message}}
        @enderror

        <button wire:click.prevent="clearSearch" class="mx-5 mt-2 bg-purple-600 text-white px-3 py-1 rounded"
            {{ empty($search) ? 'disabled' : '' }}>
            Clear
        </button>
    </div>

    <div class="mt-4 space-y-4">

        @forelse ($profiles as $profile)
            <div class="text-white p-4 rounded flex items-start justify-between bg-gray-800">
                <div>
                    <h2 class="font-bold text-lg">{{ $profile->name }}</h2>
                    <p class="text-sm text-white">{{ $profile->bio }}</p>
                </div>

                <button wire:click="$emit('show-profile', { id: {{ $profile->id }} })"
                    class="text-blue-600 underline">
                    Show
                </button>
            </div>
        @empty
            @if (!empty($search))
                <p class="text-white">No profiles found.</p>
            @endif
        @endforelse

    </div>

</div>
