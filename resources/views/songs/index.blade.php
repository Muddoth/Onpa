<x-layout title="Songs Page">
    <div
        class="bg-gray-800 rounded-2xl shadow-lg p-6 hover:scale-105 transition-transform duration-300 hover:shadow-xl border border-gray-700 flex w-8/12 overflow-hidden mx-auto">
        <div class="flex flex-col w-full">
            <ul role="list" class="divide-y divide-white/5">
                @foreach ($songs as $song)
                    <li class="flex justify-between gap-x-6 py-5">
                        <div class="flex min-w-0 gap-x-4">
                            <img src="{{ asset('images/song-icon.png') }}" alt="Song Icon"
                                class="size-12 flex-none rounded-full bg-gray-800 outline -outline-offset-1 outline-white/10" />
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm/6 font-semibold text-white">{{ $song->name }} by {{ $song->artist_name }}</p>
                                <p class="mt-1 truncate text-xs/5 text-gray-400">{{ $song->genre }}</p>
                            </div>
                        </div>
                        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <p class="text-sm/6 text-white">Album: {{ $song->album}}</p>
                        </div>
                    </li>
                @endforeach
            </ul>

        </div>
    </div>
    <div class="mt-6">
        {{ $songs->links() }}
    </div>
</x-layout>