<x-layoutlanding>
    <form method="POST" action="{{ route('login') }}" class="max-w-md mx-auto bg-gray-900 bg-opacity-70 rounded-3xl p-10 shadow-lg space-y-6 m-20">
        @csrf

        {{-- Email --}}
        <div class="flex flex-col">
            <label for="email" class="mb-2 font-semibold text-white">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                class="rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-pink-400 @error('email') border-pink-500 border-2 @enderror" />
            @error('email')
                <p class="mt-1 text-pink-400 text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="flex flex-col">
            <label for="password" class="mb-2 font-semibold text-white">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-pink-400 @error('password') border-pink-500 border-2 @enderror" />
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
                    class="text-pink-400 hover:text-pink-600 font-semibold transition text-center sm:text-right">
                    Forgot Your Password?
                </a>
            @endif
        </div>
    </form>
</x-layoutlanding>
