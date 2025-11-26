<div class="p-6">

    <!--Prevent clearing when clicking inside the search container-->
    <div x-data @click.stop>

        <div class="flex ">
            <input type="text" class="border rounded p-2 w-full mx-5" placeholder="Search profiles..."
                wire:model.live.debounce.300ms="search">

            @error('search')
                {{ $message }}
            @enderror

            <livewire:profile-show />

            <button wire:click.prevent="clearSearch" class="mx-5 mt-2 bg-purple-600 text-white px-3 py-1 rounded"
                {{ empty($search) ? 'disabled' : '' }}>
                Clear
            </button>
        </div>

        @if (count($profiles) > 0 || !empty($search))
            <div class="mt-4 absolute bg-gray-800 p-4 rounded w-200 max-w-full h-72 flex flex-col mt-10"
                style="max-height: 300px;">
                <!-- Nested child component -->
                @if ($selectedProfile)
                    @livewire('profile-show', ['profile' => $selectedProfile], key($selectedProfile->id))
                @endif
                <div class="overflow-y-auto space-y-4 flex-grow">
                    @forelse ($profiles as $profile)
                        <div
                            class="text-white p-4 rounded flex items-start justify-between bg-gray-900 border border-purple-700">
                            <div>
                                <h2 class="font-bold text-lg">{{ $profile->name }}</h2>
                                <p class="text-sm text-white">{{ $profile->bio }}</p>
                            </div>

                            <button wire:click="loadProfile({{ $profile->id }})" class="text-blue-600 underline">
                                Show
                            </button>
                        </div>
                    @empty
                        @if (!empty($search))
                            <p class="text-white text-center w-full">No profiles found.</p>
                        @endif
                    @endforelse
                </div>
            </div>
        @endif

    </div>


</div>
