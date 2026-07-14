<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Borrowing;
use Carbon\Carbon;

class libraryController extends Controller
{
    // Fungsi untuk menampilkan halaman utama
    public function index(Request $request)
    {
        $query = Book::query();
        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori', $request->kategori);
        }
        $semuaBuku = $query->get();
        $bukuTerlambat = Borrowing::where('tanggal_kembali', '<', Carbon::now())->get();

        return view('dashboard', compact('semuaBuku', 'bukuTerlambat'));
    }

    // Fungsi Pinjam
    public function prosesPinjam(Request $request)
    {
        $request->validate(['judul_buku' => 'required']);
        $buku = Book::where('judul', trim($request->judul_buku))->first();

        if ($buku && $buku->status === 'Tersedia') {
            $buku->update(['status' => 'Dipinjam']);
            Borrowing::create([
                'nama_peminjam' => Auth::user()->name,
                'judul_buku'    => $buku->judul,
                'tanggal_kembali' => Carbon::now()->addDays(7)
            ]);
            return redirect()->back()->with('sukses', 'Berhasil meminjam: ' . $buku->judul);
        }
        return redirect()->back()->with('error', 'Buku tidak tersedia!');
    }

    // Fungsi Kembali
    public function prosesKembali(Request $request)
    {
        $request->validate(['judul_buku' => 'required']);
        $buku = Book::where('judul', trim($request->judul_buku))->first();

        if ($buku) {
            $buku->update(['status' => 'Tersedia']);
            Borrowing::where('judul_buku', $buku->judul)->delete();
            return redirect()->back()->with('sukses', 'Buku ' . $buku->judul . ' dikembalikan.');
        }
        return redirect()->back()->with('error', 'Gagal memproses pengembalian.');
    }
}