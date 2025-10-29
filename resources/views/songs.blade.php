<x-layout title="Songs Page">
    <div
        class="bg-gray-800 rounded-2xl shadow-lg p-6 hover:scale-105 transition-transform duration-300 hover:shadow-xl border border-gray-700 flex w-8/12 overflow-hidden mx-auto">
        <div class="flex flex-col w-full">
            <ul role="list" class="divide-y divide-white/5">
                <!--start loop here-->
                <li class="flex justify-between gap-x-6 py-5">
                    <div class="flex min-w-0 gap-x-4">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt=""
                            class="size-12 flex-none rounded-full bg-gray-800 outline -outline-offset-1 outline-white/10" />
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm/6 font-semibold text-white">Leslie Alexander</p>
                            <p class="mt-1 truncate text-xs/5 text-gray-400">leslie.alexander@example.com</p>
                        </div>
                    </div>
                    <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                        <p class="text-sm/6 text-white">Co-Founder / CEO</p>
                        <p class="mt-1 text-xs/5 text-gray-400">Last seen <time datetime="2023-01-23T13:23Z">3h ago</time></p>
                    </div>
                </li>
                <!--end loop here-->

              
            </ul>
        </div>
    </div>
</x-layout>
