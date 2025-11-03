<?php

use App\Models\Song;
use App\Models\Playlist;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlaylistController;

Route::get('/', function () {
    $totalSongs = Song::count();
    $totalGenres = Song::distinct('genre')->count('genre');
    $totalPlaylists = Playlist::count();
    $latestSongs = Song::latest()->take(5)->get();

    return view('dashboard', compact('totalSongs', 'totalGenres', 'latestSongs', 'totalPlaylists'));
})->name('dashboard');

// 🎵 SONG ROUTES
Route::prefix('songs')->controller(SongController::class)->group(function () {
    Route::get('/', 'index')->name('songs.index');
    Route::get('/create', 'create')->name('songs.create');
    Route::post('/', 'store')->name('songs.store');
    Route::get('/{id}/edit', 'edit')->name('songs.edit');
    Route::patch('/{song}', 'update')->name('songs.update');
    Route::delete('/{id}', 'destroy')->name('songs.delete');
    Route::get('/{id}', 'show')->name('songs.show');
});

Route::prefix('profiles')->name('profiles.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::post('/update', [ProfileController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProfileController::class, 'destroy'])->name('delete');
});

Route::prefix('playlists')->name('playlists.')->group(function () {
    Route::get('/', [PlaylistController::class, 'index'])->name('index');
    Route::get('/create', [PlaylistController::class, 'create'])->name('create');
    Route::post('/', [PlaylistController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [PlaylistController::class, 'edit'])->name('edit');
    Route::patch('/{song}', [PlaylistController::class, 'update'])->name('update');
    Route::delete('/{id}', [PlaylistController::class, 'destroy'])->name('delete');
    Route::get('/{id}', [PlaylistController::class, 'show'])->name('show');
});
