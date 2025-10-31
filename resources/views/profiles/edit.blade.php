<x-layout title="Edit Profile">

    <div class="max-w-lg mx-auto mt-10 bg-gray-800 text-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-semibold text-pink-400 mb-6">Edit Profile</h2>

        <form action="{{ route('profiles.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium">Name</label>
                <input type="text" name="name" value="{{ old('name', $profile->name) }}"
                    class="w-full rounded-md bg-gray-700 px-3 py-2 text-white focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium">Age</label>
                <input type="number" name="age" value="{{ old('age', $profile->age) }}"
                    class="w-full rounded-md bg-gray-700 px-3 py-2 text-white focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium">Gender</label>
                <select name="gender" class="w-full rounded-md bg-gray-700 px-3 py-2 text-white focus:outline-none">
                    <option value="Male" {{ $profile->gender == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ $profile->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ $profile->gender == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium">Bio</label>
                <textarea name="bio" rows="3"
                    class="w-full rounded-md bg-gray-700 px-3 py-2 text-white focus:outline-none">{{ old('bio', $profile->bio) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Favourite Genres</label>
                <input type="text" name="favourite_genres"
                    value="{{ old('favourite_genres', $profile->favourite_genres) }}"
                    class="w-full rounded-md bg-gray-700 px-3 py-2 text-white focus:outline-none"
                    placeholder="Pop, Rock, Jazz...">
            </div>

            <div>
                <label class="block text-sm font-medium">Profile Picture</label>
                <input type="file" name="profile_picture" accept="image/*"
                    class="block w-full text-sm text-gray-300 border border-gray-600 rounded-lg cursor-pointer bg-gray-700 focus:outline-none">
            </div>

            <div class="flex justify-end gap-x-4 mt-6">
                <a href="{{ route('profiles.index') }}" class="text-sm font-semibold text-gray-300">Cancel</a>
                <button type="submit"
                    class="bg-pink-500 px-4 py-2 rounded-lg text-white font-semibold hover:bg-pink-600">
                    Save Changes
                </button>
            </div>
        </form>
    </div>


</x-layout>