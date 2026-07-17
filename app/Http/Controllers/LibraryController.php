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

    // Tambahkan array deskripsi di sini
    $deskripsiBuku = [
       "Sejarah Indonesia Modern 1200-2008" => "Sebuah karya referensi akademis yang otoritatif, melacak transformasi mendalam Indonesia dari masa kerajaan-kerajaan besar hingga dinamika politik era kontemporer, memberikan pemahaman komprehensif mengenai fondasi sosial-politik bangsa.",
    "Babad Tanah Jawi" => "Naskah sastra klasik yang menelusuri silsilah para penguasa di tanah Jawa sejak masa purba hingga Mataram Islam, memadukan catatan kronologis sejarah dengan elemen mitologi yang membentuk identitas kultural masyarakat Jawa.",
    "Indonesia Menggugat" => "Pledoi legendaris yang disampaikan oleh Soekarno di hadapan pengadilan kolonial Belanda, yang bukan sekadar pembelaan diri, melainkan kritik tajam terhadap imperialisme dan seruan bagi kemerdekaan bangsa Indonesia.",
    "Sapiens: A Brief History of Humankind" => "Penelusuran ambisius mengenai evolusi manusia, mulai dari spesies purba yang tidak signifikan hingga menjadi penguasa planet berkat kemampuan unik kita untuk menciptakan mitos bersama seperti uang, negara, dan agama.",
    "Guns, Germs, and Steel" => "Eksplorasi mendalam mengenai bagaimana faktor geografis, ketersediaan sumber daya alam, dan lingkungan fisik menentukan keberhasilan atau kegagalan peradaban manusia dalam menguasai teknologi dan dominasi global.",
    "A Brief History of Time" => "Stephen Hawking membawa pembaca menjelajahi misteri terbesar alam semesta, mulai dari teori Big Bang, lubang hitam, hingga konsep waktu, disajikan dengan bahasa yang membuat topik kosmologi rumit menjadi dapat dipahami.",
    "The Selfish Gene" => "Buku revolusioner yang mengubah paradigma biologi dengan mengajukan argumen bahwa gen, bukan organisme, adalah unit utama seleksi alam, menjelaskan evolusi melalui sudut pandang genetik yang dingin namun fascinasi.",
    "Silent Spring" => "Karya monumental yang memicu lahirnya gerakan kesadaran lingkungan global, dengan mengungkap bahaya penggunaan pestisida kimia secara berlebihan yang mengancam keseimbangan ekosistem, burung, dan kesehatan manusia.",
    "The Gene" => "Kisah epik mengenai sejarah penemuan genetika yang menghubungkan sains, sejarah keluarga, dan masa depan manusia, mengeksplorasi bagaimana kode genetik menentukan identitas, keturunan, dan etika medis modern.",
    "Cosmos" => "Sebuah perjalanan naratif melalui ruang dan waktu yang merayakan keindahan sains, menghubungkan evolusi alam semesta selama miliaran tahun dengan sejarah perkembangan umat manusia dalam upaya memahami tempat kita di alam semesta.",
    "Laskar Pelangi" => "Kisah inspiratif tentang sepuluh anak dari keluarga kurang mampu di Belitung yang berjuang melawan keterbatasan fasilitas demi menuntut ilmu, sebuah ode untuk persahabatan, kegigihan, dan kekuatan impian yang melampaui kemiskinan.",
    "Bumi" => "Petualangan fantastis tentang tiga remaja yang menemukan rahasia besar bahwa dunia mereka bukanlah satu-satunya tempat, melainkan bagian dari dunia paralel yang menyimpan kekuatan luar biasa dan misteri kuno.",
    "Harry Potter and the Philosopher's Stone" => "Awal dari perjalanan epik seorang anak yatim piatu yang menemukan bahwa dirinya adalah seorang penyihir, memulai petualangan ajaib di sekolah sihir Hogwarts sambil menghadapi ancaman kekuatan kegelapan.",
    "The Hobbit" => "Perjalanan tak terduga Bilbo Baggins, seorang Hobbit yang enggan berpetualang namun terpaksa bergabung dengan para kurcaci dalam misi berbahaya untuk merebut kembali harta mereka dari cengkeraman naga Smaug.",
    "To Kill a Mockingbird" => "Kisah klasik yang menyentuh tentang keadilan, moralitas, dan hilangnya kepolosan di tengah prasangka rasial yang pekat di Amerika Selatan, dilihat dari kacamata seorang anak kecil bernama Scout Finch.",
    "The Man Who Mistook His Wife for a Hat" => "Kumpulan studi kasus klinis yang unik dari seorang neurolog, menceritakan kisah nyata para pasien dengan gangguan otak aneh namun tetap menjaga martabat dan kemanusiaan mereka di tengah keterbatasan saraf.",
    "Api Sejarah" => "Pemaparan sejarah bangsa Indonesia yang menyajikan perspektif alternatif, dengan penekanan kuat pada kontribusi signifikan tokoh-tokoh dan organisasi Islam dalam perjuangan melawan kolonialisme yang sering terabaikan.",
    "The Great Gatsby" => "Kisah tragis yang memotret dekadensi dan kemewahan era 'Jazz Age' di Amerika, menelusuri tema obsesi, cinta yang tak terbalas, dan kesia-siaan mengejar impian Amerika yang semu."
    ];

    return view('dashboard', compact('semuaBuku', 'bukuTerlambat', 'deskripsiBuku'));

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
            'deskripsi' => 'required',
        ]);


        \App\Models\Book::create([
            'judul'     => $request->judul,
            'penulis'   => $request->penulis,
            'kategori'  => $request->kategori,
            'status'    => 'Tersedia',
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('sukses', 'Buku berhasil ditambahkan!');
    }
    
    

}