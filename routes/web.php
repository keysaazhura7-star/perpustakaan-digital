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

    
    // Tampilkan Halaman Form Edit Buku (Baru Ditambahkan!)
    Route::get('/buku/{id}/edit', [libraryController::class, 'editBook'])->name('books.edit');
    
    // Update Data Buku & Ganti Sampul
    Route::put('/buku/{id}', [libraryController::class, 'update'])->name('books.update');
    
    // Hapus Buku (Baru Ditambahkan!)
    Route::delete('/buku/{id}', [libraryController::class, 'destroy'])->name('books.destroy');




    // FITUR UTAMA: Pinjam & Kembalikan
    // Perhatikan: Menggunakan Route::post karena form menggunakan method POST
    Route::post('/pinjam-buku', [libraryController::class, 'prosesPinjam'])->name('books.pinjam');

    Route::post('/kembalikan-buku', [libraryController::class, 'prosesKembali'])->name('books.kembalikan');

    Route::get('/daftar-peminjaman', [libraryController::class, 'daftarPeminjaman'])->name('peminjaman.index');

    Route::put('/books/{id}', [LibraryController::class, 'update'])->name('books.update');
   
});

require __DIR__.'/auth.php';