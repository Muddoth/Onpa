<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/songs', function () {
    return view('songs');
})->name('songs');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/record', function () {
    return view('record');
})->name('record');
