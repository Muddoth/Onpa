<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        // For now, we’ll just fetch the first profile record
        $profile = Profile::first();

        return view('profiles.index', compact('profile'));
    }

    public function edit()
    {
        $profile = Profile::first();
        return view('profiles.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::first();

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
}
