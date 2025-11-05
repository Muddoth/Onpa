<x-layoutlanding>



    <h2 class="text-4xl font-bold tracking-tight text-pink-400 sm:text-5xl">
        Welcome to Onpa
    </h2>
    <p class="mt-6 text-lg text-gray-300">
        Discover, play, and share your favorite tracks — your music journey starts here.
    </p>
    <div class="mt-10 flex items-center justify-center gap-x-6 lg:justify-start">
        <a href="{{ route('register') }}"
            class="rounded-md bg-pink-500 px-5 py-2.5 text-sm font-semibold text-white shadow-md hover:bg-pink-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pink-400 transition">
            Sign Up
        </a>
        <a href="{{ route('login') }}" class="text-sm font-semibold text-white hover:text-pink-400 transition">
            Log In <span aria-hidden="true">→</span>
        </a>
    </div>


    </div>
    </div>

</x-layoutlanding>