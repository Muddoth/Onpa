<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Song::query();

        // Filter by song name
        if ($request->has('name') && $request->name !== '') {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        // Filter by genre
        // Filter by genre (JSON)
        if ($request->has('genre') && $request->genre !== '') {
            $query->whereJsonContains('genre', $request->genre);
        }


        // Filter by artist name
        if ($request->has('artist') && $request->artist !== '') {
            $query->whereHas('artist', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->artist . '%');
            });
        }

        // Paginate - default 10 items
        $songs = $query->paginate(10);

        return response()->json([
            'success' => true,
            'count' => $songs->total(),
            'page' => $songs->currentPage(),
            'data' => $songs->items(),
        ]);
    }
}
