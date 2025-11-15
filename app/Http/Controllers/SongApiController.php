<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use App\Http\Resources\SongResource;

class SongApiController extends Controller
{
    public function index(Request $request)
    {
        
        $user=$request->user();
        $query = Song::query();

        if ($request->has('q') && $request->q !== '') {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('album', 'LIKE', '%' . $request->q . '%')
                    ->orWhereHas('artist', function ($q2) use ($request) {
                        $q2->where('name', 'LIKE', '%' . $request->q . '%');
                    });
            });
        }

        if ($request->has('genre') && $request->genre !== '' && $request->genre !== 'all') {
            $query->whereJsonContains('genre', $request->genre);
        }

        // $sql = $query->toSql();
        // $bindings = $query->getBindings();
        // $count = $query->count();

        $songs = $query->with('artist')->paginate(10);

        return response()->json([

            'user' => $user ? $user->only('id', 'name', 'email') : null,
            'roles' => $user ? $user->getRoleNames() : [],
            'is_admin' => $user ? $user->hasRole('admin') : false,

            'success' => true,
            'count' => $songs->total(),
            'page' => $songs->currentPage(),
            'data' => SongResource::collection($songs),//simply used for formating json->array

            'query' => $query,
            'genre' =>  $request->genre,

            // // DEBUG INFO below - remove later
            // 'debug_sql' => $sql,
            // 'debug_bindings' => $bindings,
            // 'debug_count' => $count,
        ]);
    }
}
