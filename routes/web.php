<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;
use App\Models\Song;

Route::get('/', function () {
    $totalSongs = Song::count();
    $totalGenres = Song::distinct('genre')->count('genre');
    return view('dashboard', compact('totalSongs', 'totalGenres'));
})->name('dashboard');



// Song CRUD routes
Route::get('/songs', [SongController::class, 'index'])->name('songs.index');
Route::get('/songs/create', [SongController::class, 'create'])->name('songs.create');
Route::post('/songs', [SongController::class, 'store'])->name('songs.store');
Route::get('/songs/{id}/edit', [SongController::class, 'edit'])->name('songs.edit');
Route::patch('/songs/{id}', [SongController::class, 'update'])->name('songs.update');
Route::delete('/songs/{id}', [SongController::class, 'destroy'])->name('songs.delete');
Route::get('/songs/{id}', [SongController::class, 'show'])->name('songs.show');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/record', function () {
    return view('record');
})->name('record');
