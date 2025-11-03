<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;
use App\Models\Song;

Route::get('/', function () {
    $totalSongs = Song::count();
    $totalGenres = Song::distinct('genre')->count('genre');
    $latestSongs = Song::latest()->take(5)->get();

    return view('dashboard', compact('totalSongs', 'totalGenres', 'latestSongs'));
})->name('dashboard');



// Song CRUD routes
Route::get('/songs', [SongController::class, 'index'])->name('songs.index');
Route::get('/songs/create', [SongController::class, 'create'])->name('songs.create');
Route::post('/songs', [SongController::class, 'store'])->name('songs.store');
Route::get('/songs/{id}/edit', [SongController::class, 'edit'])->name('songs.edit');
Route::patch('/songs/{song}', [SongController::class, 'update'])->name('songs.update');
Route::delete('/songs/{id}', [SongController::class, 'destroy'])->name('songs.delete');
Route::get('/songs/{id}', [SongController::class, 'show'])->name('songs.show');


//Profile CRUD
Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
Route::get('/profiles/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
Route::post('/profiles/update', [ProfileController::class, 'update'])->name('profiles.update');

Route::get('/playlist', function () {
    return view('playlist');
})->name('playlist');
