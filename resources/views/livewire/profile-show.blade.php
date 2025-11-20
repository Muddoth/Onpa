<div>
    @if ($profile)
        <div class="text-white p-4 rounded flex items-start justify-between bg-gray-800">
            <h1 class="font-bold text-xl">{{ $profile->name }}</h1>
            <p>Age: {{ $profile->age }}</p>
            <p>Gender: {{ $profile->gender }}</p>
            <p>{{ $profile->bio }}</p>
            <a href="{{ route('profiles.show', ['id' => $profile->id]) }}" class="text-blue-600 underline" target="_blank"
                {{-- optional: open in new tab --}}>
                View Page
            </a>

        </div>
    @endif
</div>
