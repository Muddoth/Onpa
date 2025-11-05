<x-layoutlanding>
    <form method="POST" action="{{ route('register') }}"
        class="max-w-3xl mx-auto bg-gray-900 bg-opacity-70 rounded-3xl p-10 shadow-lg m-20 grid grid-cols-2 gap-6">
        @csrf

        {{-- Name --}}
        <div class="flex flex-col">
            <label for="name" class="block text-white font-semibold mb-2">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                class="block w-full rounded-md bg-white/5 px-3 py-2 text-base text-white placeholder:text-gray-500 focus:outline-2 focus:outline-indigo-500 sm:text-sm/6 @error('name') border-pink-500 border-2 @enderror" />
            @error('name')
                <p class="mt-1 text-pink-400 text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="flex flex-col">
            <label for="email" class="block text-white font-semibold mb-2">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                class="block w-full rounded-md bg-white/5 px-3 py-2 text-base text-white placeholder:text-gray-500 focus:outline-2 focus:outline-indigo-500 sm:text-sm/6 @error('email') border-pink-500 border-2 @enderror" />
            @error('email')
                <p class="mt-1 text-pink-400 text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="flex flex-col">
            <label for="password" class="block text-white font-semibold mb-2">Password</label>
            <input id="password" type="password" name="password" required
                class="block w-full rounded-md bg-white/5 px-3 py-2 text-base text-white placeholder:text-gray-500 focus:outline-2 focus:outline-indigo-500 sm:text-sm/6 @error('password') border-pink-500 border-2 @enderror" />
            @error('password')
                <p class="mt-1 text-pink-400 text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="flex flex-col">
            <label for="password-confirm" class="block text-white font-semibold mb-2">Confirm Password</label>
            <input id="password-confirm" type="password" name="password_confirmation" required
                class="block w-full rounded-md bg-white/5 px-3 py-2 text-base text-white placeholder:text-gray-500 focus:outline-2 focus:outline-indigo-500 sm:text-sm/6" />
        </div>

        {{-- Spacer --}}
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
