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
        $genres = Song::select('genre')
            ->distinct()
            ->pluck('genre');

        return view('songs.create', compact('genres'));
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
            'audio' => 'required|mimes:mp3,wav,ogg|max:10240',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $song = Song::create($request->only('name', 'artist_name', 'album', 'genre'));

        // Handle audio
        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $audioFilename = str_replace(' ', '_', $song->name) . '.' . $audio->getClientOriginalExtension();
            $audioPath = 'audio/' . $audioFilename;
            $audio->move(public_path('audio'), $audioFilename);
            $song->update(['file_path' => $audioPath]);
        }

        // Handle image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageFilename = str_replace(' ', '_', $song->name) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'images/songs/' . $imageFilename;
            $image->move(public_path('images/songs'), $imageFilename);
            $song->update(['image_path' => $imagePath]);
        }

        return redirect()->route('songs.index')->with('success', 'Song added successfully!');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $song = Song::findOrFail($id);
        $genres = Song::select('genre')
            ->distinct()
            ->pluck('genre');


        return view('songs.edit', compact('song', 'genres'));
    }

    /**
     * Update a song
     */
    public function update(Request $request, Song $song)
    {
        // validate - allow artist/album/genre to be nullable if you want
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'artist_name' => 'nullable|string|max:255',
            'album' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:100',
            'audio' => 'nullable|mimes:mp3,wav,ogg|file|max:20480',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|file|max:5120',
        ]);

        // start with the fields we know we want to update
        $data = [
            'name' => $validated['name'],
            'artist_name' => $validated['artist_name'] ?? $song->artist_name,
            'album' => $validated['album'] ?? $song->album,
            'genre' => $validated['genre'] ?? $song->genre,
        ];

        // handle audio upload (replace existing and update DB path)
        if ($request->hasFile('audio')) {
            // optionally delete old audio
            if ($song->file_path && file_exists(public_path($song->file_path))) {
                @unlink(public_path($song->file_path));
            }

            $audio = $request->file('audio');
            $audioName = time() . '_' . preg_replace('/\s+/', '_', $audio->getClientOriginalName());
            $audio->move(public_path('audio'), $audioName);
            $data['file_path'] = 'audio/' . $audioName;
        }

        // handle image upload (replace existing and update DB path)
        if ($request->hasFile('image')) {
            if ($song->image_path && file_exists(public_path($song->image_path))) {
                @unlink(public_path($song->image_path));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . preg_replace('/\s+/', '_', $image->getClientOriginalName());
            $image->move(public_path('images/songs'), $imageName);
            $data['image_path'] = 'images/songs/' . $imageName;
        }

        // actually update and check result
        $updated = $song->update($data);

        if (! $updated) {
            // helpful debug: store in log
            \Log::error('Song update failed', ['song_id' => $song->id, 'data' => $data]);
            return back()->with('error', 'Failed to update song. Check logs.');
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
