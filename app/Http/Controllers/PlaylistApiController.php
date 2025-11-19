<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
// use Illuminate\Http\Request;

class PlaylistApiController extends Controller
{
public function index() {
  $playlists = Playlist::with('songs')->paginate(10);
  return response()->json([
    'data' => $playlists->items(),
    'meta' => [
      'total' => $playlists->total(),
      'per_page' => $playlists->perPage(),
      'current_page' => $playlists->currentPage(),
    ],
  ]);
}

}
