<x-layoutlanding>

    <form action="{{ route('profiles.store') }}" method="POST" enctype="multipart/form-data" class="mx-auto space-y-4">
        @csrf

        <!-- Profile Information -->
        <div class="border-b border-white/10 pb-12">
            <h2 class="text-base/7 font-semibold text-white">Profile Information</h2>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">

                <!-- Name -->
                <div class="sm:col-span-1">
                    <label for="name" class="block text-sm/6 font-medium text-white">Name</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="name"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white placeholder:text-gray-500 focus:outline-2 focus:outline-indigo-500 sm:text-sm/6" />
                    </div>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Age -->
                <div class="sm:col-span-1">
                    <label for="age" class="block text-sm/6 font-medium text-white">Age</label>
                    <div class="mt-2">
                        <input type="number" name="age" id="age"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white placeholder:text-gray-500 focus:outline-2 focus:outline-indigo-500 sm:text-sm/6" />
                    </div>
                    @error('age')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gender -->
                <div class="sm:col-span-1">
                    <label for="gender" class="block text-sm/6 font-medium text-white">Gender</label>
                    <div class="mt-2">
                        <select name="gender" id="gender"
                            class="block w-full rounded-md bg-gray-800 px-3 py-1.5 text-base text-white focus:outline-2 focus:outline-indigo-500 sm:text-sm/6">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    @error('gender')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Favourite Genres -->
                <div class="sm:col-span-1">
                    <label for="favourite_genres" class="block text-sm/6 font-medium text-white">Favourite
                        Genres</label>
                    <div class="mt-2">
                        <input type="text" name="favourite_genres" id="favourite_genres" placeholder="e.g. Pop, Jazz"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white placeholder:text-gray-500 focus:outline-2 focus:outline-indigo-500 sm:text-sm/6" />
                    </div>
                    @error('favourite_genres')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bio -->
                <div class="sm:col-span-2">
                    <label for="bio" class="block text-sm/6 font-medium text-white">Bio</label>
                    <div class="mt-2">
                        <textarea name="bio" id="bio" rows="4"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white placeholder:text-gray-500 focus:outline-2 focus:outline-indigo-500 sm:text-sm/6"
                            placeholder="Tell us something about yourself..."></textarea>
                    </div>
                    @error('bio')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Profile Picture -->
                <div class="sm:col-span-2">
                    <label for="profile_picture" class="block text-sm/6 font-medium text-white">Profile
                        Picture</label>
                    <input type="file" name="profile_picture" id="profile_picture" accept="image/*"
                        class="block w-full mt-2 text-sm text-gray-300 border border-gray-600 rounded-lg cursor-pointer bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('profile_picture')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        <!-- Submit -->
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ route('profiles.index') }}" class="text-sm/6 font-semibold text-white">Cancel</a>
            <button type="submit"
                class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-indigo-500">Save</button>
        </div>
    </form>
</x-layoutlanding>