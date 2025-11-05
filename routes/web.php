<?php

use App\Models\Song;
use App\Models\Playlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;




Route::get('/', function () {

    return view('base');
})->name('base');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
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

    // PROFILE CRUD
    Route::prefix('profiles')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'index')->name('profiles.index');
        Route::get('/create', 'create')->name('profiles.create');
        Route::post('/', 'store')->name('profiles.store');
        Route::patch('/{id}', 'update')->name('profiles.update');
        Route::get('/{id}/edit', 'edit')->name('profiles.edit');
        Route::delete('/{id}', 'destroy')->name('profiles.delete');
        Route::get('/{id}', 'show')->name('profiles.show');
    });

    Route::prefix('playlists')->name('playlists.')->group(function () {
        Route::get('/', [PlaylistController::class, 'index'])->name('index');
        Route::get('/create', [PlaylistController::class, 'create'])->name('create');
        Route::post('/', [PlaylistController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PlaylistController::class, 'edit'])->name('edit');
        Route::patch('/{playlist}', [PlaylistController::class, 'update'])->name('update');
        Route::delete('/{id}', [PlaylistController::class, 'destroy'])->name('delete');
        Route::get('/{id}', [PlaylistController::class, 'show'])->name('show');
    });
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
