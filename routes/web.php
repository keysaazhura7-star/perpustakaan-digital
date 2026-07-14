<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\libraryController;
use Illuminate\Support\Facades\Route;

// 1. Rute Halaman Login
Route::get('/', function () { 
    return view('auth.login'); 
});

// 2. Rute Dashboard (Menggunakan fungsi 'index' di libraryController)
Route::get('/dashboard', [libraryController::class, 'index'])
     ->middleware(['auth', 'verified'])
     ->name('dashboard');

// 3. Rute yang memerlukan Autentikasi (Wajib Login)
Route::middleware('auth')->group(function () {
    
    // Manajemen Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manajemen Buku (Tambah, Update Sampul)
    Route::post('/profile/avatar', [libraryController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::post('/buku', [libraryController::class, 'storeBook'])->name('books.store');
    Route::put('/buku/{id}', [libraryController::class, 'updateBook'])->name('books.update');

    // FITUR UTAMA: Pinjam & Kembalikan
    // Perhatikan: Menggunakan Route::post karena form menggunakan method POST
    Route::post('/pinjam-buku', [libraryController::class, 'prosesPinjam'])->name('books.pinjam');
    Route::post('/kembalikan-buku', [libraryController::class, 'prosesKembali'])->name('books.kembalikan');
});

require __DIR__.'/auth.php';