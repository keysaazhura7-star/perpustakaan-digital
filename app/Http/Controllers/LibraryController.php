<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Borrowing;

class libraryController extends Controller
{
    // 1. Mengatur tampilan halaman berdasarkan Role pengguna yang login
    public function arahkanHalaman()
    {
        $user = Auth::user();

        if ($user->role == 'penjaga') {
            $semuaPinjaman = Borrowing::all();
            return view('halaman_penjaga', compact('semuaPinjaman'));
        } else {
            $semuaBuku = Book::all();
            return view('halaman_buku', compact('semuaBuku'));
        }
    }

    // 2. Memproses aksi peminjaman buku dari siswa/peminjam
    public function prosesPinjam(Request $request)
    {
        // Ambil judul buku dari input form hidden (name="judul_buku")
        $judulBukuDariForm = $request->judul_buku;

        // Cari data buku yang sesuai di database
        $buku = Book::where('judul', $judulBukuDariForm)->first();

        // Pengaman: Jika buku tidak ditemukan, gagalkan proses
        if (!$buku) {
            return redirect('/dashboard')->with('error', 'Aduh, buku tidak ditemukan!');
        }

        // Ubah status buku tersebut menjadi 'Dipinjam'
        $buku->status = 'Dipinjam';
        $buku->save();

        // Catat riwayat transaksi ke dalam tabel borrowings
        Borrowing::create([
            'nama_peminjam' => Auth::user()->name,
            'judul_buku'    => $buku->judul
        ]);

        // Kembalikan ke halaman dashboard dengan membawa pesan sukses
        return redirect('/dashboard')->with('sukses', 'Berhasil meminjam buku ' . $buku->judul . '!');
    }


    //buat satu fungsi yang digunakan untuk menerima buku yang dipinjam
    
}