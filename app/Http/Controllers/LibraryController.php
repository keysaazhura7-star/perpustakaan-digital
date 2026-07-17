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

        if ($buku && trim($buku->status) === 'Tersedia') {
            $buku->update(['status' => 'Dipinjam']);

            Borrowing::create([
                'nama_peminjam'   => Auth::user()->name,
                'judul_buku'      => $buku->judul,
                'tanggal_kembali' => Carbon::now()->addDays(7)
            ]);

            return redirect()->back()->with('sukses', 'Berhasil meminjam: ' . $buku->judul);
        }

        return redirect()->back()->with('error', 'Maaf, buku tidak tersedia!');
    }

    // Fungsi Kembali
    public function prosesKembali(Request $request)
    {
        $request->validate(['judul_buku' => 'required']);
        $buku = Book::where('judul', trim($request->judul_buku))->first();

        if ($buku) {
            $buku->update(['status' => 'Tersedia']);
            Borrowing::where('judul_buku', $buku->judul)->delete();
            
            return redirect()->back()->with('sukses', 'Buku ' . $buku->judul . ' berhasil dikembalikan.');
        }
        
        return redirect()->back()->with('error', 'Gagal memproses pengembalian.');
    }

    public function daftarPeminjaman()
    {
        $peminjaman = Borrowing::all();
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function kembalikan(Request $request) 
    {
        $peminjaman = Borrowing::findOrFail($request->id);
        // Logika pengembalian bisa ditambahkan di sini jika perlu
        $peminjaman->delete();
        
        return redirect()->back()->with('sukses', 'Buku berhasil dikembalikan.');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate(['cover' => 'required|image|mimes:jpeg,png,jpg|max:2028']);

        $buku = Book::findOrFail($id);  
        
        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $buku->cover = $path;
            $buku->save();
        }
        return redirect()->back()->with('sukses', 'Sampul berhasil diperbarui!');
    }

    public function storeBook(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'penulis'   => 'required|string|max:255',
            'kategori'  => 'required|string',
        ]);

        \App\Models\Book::create([
            'judul'     => $request->judul,
            'penulis'   => $request->penulis,
            'kategori'  => $request->kategori,
            'status'    => 'Tersedia',
        ]);

        return redirect()->back()->with('sukses', 'Buku berhasil ditambahkan!');
    }

}