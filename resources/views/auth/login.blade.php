<x-layoutlanding>
    <form method="POST" action="{{ route('login') }}" class="w-477 max-w-md mx-auto bg-gray-900 bg-opacity-70 rounded-3xl p-10 shadow-lg space-y-6 m-20">
        @csrf

        {{-- Email --}}
        <div class="flex flex-col">
            <label for="email" class="mb-2 font-semibold text-white">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white placeholder:text-gray-500 focus:outline-2 focus:outline-indigo-500 sm:text-sm/6 @error('email') border-pink-500 border-2 @enderror" />
            @error('email')
                <p class="mt-1 text-pink-400 text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="flex flex-col">
            <label for="password" class="mb-2 font-semibold text-white">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white placeholder:text-gray-500 focus:outline-2 focus:outline-indigo-500 sm:text-sm/6 @error('password') border-pink-500 border-2 @enderror" />
            @error('password')
                <p class="mt-1 text-pink-400 text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center space-x-3">
            <input id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}
                class="rounded text-pink-500 focus:ring-pink-400">
            <label for="remember" class="text-white font-semibold select-none cursor-pointer">Remember Me</label>
        </div>

        {{-- Buttons --}}
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-4 sm:space-y-0">
            <button type="submit"
                class="w-full sm:w-auto bg-pink-500 hover:bg-pink-600 text-white font-semibold py-3 px-8 rounded-lg shadow-md transition">
                Login
            </button>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="ml-10 text-pink-400 hover:text-pink-600 font-semibold transition text-center sm:text-right">
                    Forgot Password?
                </a>
            @endif
        </div>
    </form>
</x-layoutlanding>
