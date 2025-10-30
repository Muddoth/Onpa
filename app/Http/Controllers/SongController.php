<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /** 
     * Display all songs
     */
    public function index()
    {
        $songs = Song::latest()->simplePaginate(10);
        return view('songs.index', compact('songs'));
    }

    /**
     * Show the form for creating a new song
     */
    public function create()
    {
        return view('songs.create');
    }

    /**
     * Store a new song
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'artist_name' => 'nullable|string|max:255',
            'album' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:255',
            'file_path' => 'required|string|max:255',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $song = Song::create($request->only('name', 'artist_name', 'album', 'genre', 'file_path'));

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $filename = str_replace(' ', '_', $song->name) . '.' . $image->getClientOriginalExtension();
            $path = 'images/songs/' . $filename;
            $image->move(public_path('images/songs'), $filename);
            $song->update(['image_path' => $path]);
        }

        return redirect()->route('songs.index')->with('success', 'Song added successfully!');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $song = Song::findOrFail($id);
        return view('songs.edit', compact('song'));
    }

    /**
     * Update a song
     */
    public function update(Request $request, $id)
    {
        $song = Song::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'artist_name' => 'nullable|string|max:255',
            'album' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:255',
            'file_path' => 'required|string|max:255',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $song->update($request->only('name', 'artist_name', 'album', 'genre', 'file_path'));

        if ($request->hasFile('image_path')) {
            if ($song->image_path && file_exists(public_path($song->image_path))) {
                unlink(public_path($song->image_path));
            }

            $image = $request->file('image_path');
            $filename = str_replace(' ', '_', $song->name) . '.' . $image->getClientOriginalExtension();
            $path = 'images/songs/' . $filename;
            $image->move(public_path('images/songs'), $filename);
            $song->update(['image_path' => $path]);
        }

        return redirect()->route('songs.index')->with('success', 'Song updated successfully!');
    }

    /**
     * Delete a song
     */
    public function destroy($id)
    {
        $song = Song::findOrFail($id);

        if ($song->image_path && file_exists(public_path($song->image_path))) {
            unlink(public_path($song->image_path));
        }

        $song->delete();
        return redirect()->route('songs.index')->with('success', 'Song deleted successfully!');
    }

    /**
     * Show individual song
     */
    public function show($id)
    {
        $song = Song::findOrFail($id);
        return view('songs.show', compact('song'));
    }
}
