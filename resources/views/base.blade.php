<x-layoutlanding>
    

            {{-- Text Section --}}
            <div class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">
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
                    <a href=""
                        class="text-sm font-semibold text-white hover:text-pink-400 transition">
                        Log In <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>


            {{-- Image Section --}}
            <div class="relative mt-16 h-80 lg:mt-8">
                <img src="" alt="App screenshot"
                    class="absolute top-0 left-0 w-full max-w-none rounded-md bg-white/5 ring-1 ring-white/10" />
            </div>
        </div>
    </div>
    
</x-layoutlanding>