<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        // Get the profile related to the currently authenticated user
        $profile = auth()->user()->profile;

        // Optional: If the user has no profile yet, redirect or show a message
        if (!$profile) {
            return redirect()->route('profiles.create')->with('error', 'Please create your profile first.');
        }

        return view('profiles.index', compact('profile'));
    }

    public function create()
    {

        return view('profiles.create');
    }

    /**
     * Store a new profile
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'gender' => 'required|string|max:50',
            'bio' => 'nullable|string',
            'favourite_genres' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Add user_id from logged-in user
        $data = $request->only('name', 'age', 'gender', 'bio', 'favourite_genres');
        $data['user_id'] = auth()->id(); // or Auth::id()

        // Create the profile with user_id
        $profile = Profile::create($data);


        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageFilename = str_replace(' ', '_', $profile->name) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'images/profiles/' . $imageFilename;
            $image->move(public_path('images/profiles'), $imageFilename);
            $profile->update(['profile_picture' => $imagePath]);
        }

        return redirect()->route('dashboard')->with('success', 'Profile created successfully!');
    }


    public function edit()
    {
        $profile = auth()->user()->profile;
        return view('profiles.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = auth()->user()->profile;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'bio' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'favourite_genres' => 'nullable|string',
        ]);

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/profiles'), $filename);
            $validated['profile_picture'] = 'images/profiles/' . $filename;
        }

        $profile->update($validated);

        return redirect()->route('profiles.index')->with('success', 'Profile updated successfully!');
    }

    public function destroy($id)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $profile = $user->profile;

        if ($profile) {
            $profile->delete();
        }

        $user->delete();

        return redirect()->route('base')->with('success', 'Profile and user deleted successfully.');
    }
}
