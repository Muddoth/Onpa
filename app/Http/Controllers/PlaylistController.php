<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the playlists.
     */
    public function index()
    {
        $playlists = Playlist::with('songs')->latest()->simplePaginate(10);
        return view('playlists.index', compact('playlists'));
    }

    /**
     * Show the form for creating a new playlist.
     */
    public function create()
    {
        $songs = Song::all(); // so user can pick songs for playlist
        return view('playlists.create', compact('songs'));
    }

    /**
     * Store a newly created playlist in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'song_ids' => 'nullable|array', // from checkboxes or multiselect
            'song_ids.*' => 'exists:songs,id',
        ]);

        $playlist = Playlist::create([
            'name' => $validated['name'],
        ]);

        if (!empty($validated['song_ids'])) {
            $playlist->songs()->sync($validated['song_ids']);
        }

        return redirect()->route('playlists.index')->with('success', 'Playlist created successfully.');
    }

    /**
     * Display the specified playlist.
     */
    public function show($id)
    {
        $playlist = Playlist::with('songs')->findOrFail($id);
        return view('playlists.show', compact('playlist'));
    }

    /**
     * Show the form for editing the specified playlist.
     */
    public function edit($id)
    {
        $playlist = Playlist::with('songs')->findOrFail($id);
        $songs = Song::all();
        return view('playlists.edit', compact('playlist', 'songs'));
    }

    /**
     * Update the specified playlist in storage.
     */
    public function update(Request $request, Playlist $song) // 'song' because of your route param name
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'song_ids' => 'nullable|array',
            'song_ids.*' => 'exists:songs,id',
        ]);

        $song->update(['name' => $validated['name']]);

        if (!empty($validated['song_ids'])) {
            $song->songs()->sync($validated['song_ids']);
        } else {
            $song->songs()->detach();
        }

        return redirect()->route('playlists.index')->with('success', 'Playlist updated successfully.');
    }

    /**
     * Remove the specified playlist from storage.
     */
    public function destroy($id)
    {
        $playlist = Playlist::findOrFail($id);
        $playlist->songs()->detach();
        $playlist->delete();

        return redirect()->route('playlists.index')->with('success', 'Playlist deleted successfully.');
    }
}
