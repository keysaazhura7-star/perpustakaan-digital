<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\libraryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', [libraryController::class, 'arahkanHalaman'])
     ->middleware(['auth', 'verified'])
     ->name('dashboard');

Route::post('/pinjam-buku/{judul?}', [libraryController::class, 'prosesPinjam'])
    ->middleware('auth');

Route::post('/kembalikan-buku', [LibraryController::class, 'prosesKembali'])
    ->middleware('auth');

Route::post('/upload-foto', [libraryController::class, 'uploadFoto'])
    ->middleware('auth');

    
require __DIR__.'/auth.php';