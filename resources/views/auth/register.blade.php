<x-layoutlanding>
    <form method="POST" action="{{ route('register') }}"
        class="grid grid-cols-2 gap-x-8 gap-y-6 max-w-3xl bg-gray-900 bg-opacity-70 rounded-3xl p-10 shadow-lg m-20 mx-auto">
        @csrf

        {{-- Name --}}
        <div class="flex flex-col">
            <label for="name" class="block text-white font-semibold mb-2">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                class="w-full rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-pink-400 @error('name') border-pink-500 border-2 @enderror" />
            @error('name')
                <p class="mt-1 text-pink-400 text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="flex flex-col">
            <label for="email" class="block text-white font-semibold mb-2">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                class="w-full rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-pink-400 @error('email') border-pink-500 border-2 @enderror" />
            @error('email')
                <p class="mt-1 text-pink-400 text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="flex flex-col">
            <label for="password" class="block text-white font-semibold mb-2">Password</label>
            <input id="password" type="password" name="password" required
                class="w-full rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-pink-400 @error('password') border-pink-500 border-2 @enderror" />
            @error('password')
                <p class="mt-1 text-pink-400 text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="flex flex-col">
            <label for="password-confirm" class="block text-white font-semibold mb-2">Confirm Password</label>
            <input id="password-confirm" type="password" name="password_confirmation" required
                class="w-full rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-pink-400" />
        </div>

        {{-- Empty div to fill grid space --}}
        <div></div>

        {{-- Submit Button aligned bottom right --}}
        <div class="flex justify-end items-end">
            <button type="submit"
                class="bg-pink-500 hover:bg-pink-600 text-white font-semibold py-3 px-8 rounded-lg shadow-md transition">
                Next >>
            </button>
        </div>
    </form>


</x-layoutlanding>