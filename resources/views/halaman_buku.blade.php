<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Ceria</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-100 font-sans min-h-screen flex flex-col items-center justify-center p-6">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-2xl border border-slate-200">
        
        <div class="text-center mb-8">
            <div class="flex justify-center mb-3">
               

            <h1 class="text-3xl font-extrabold text-blue-600 mb-2">📚 Perpustakaan Ceria</h1>
            <p class="text-slate-500">Halo Teman Peminjam! Selamat memilih-lihat koleksi buku terbaik kami ya.</p>
            
            @if(session('sukses'))
                <div class="mt-4 p-3 bg-green-100 text-green-700 rounded-xl text-sm font-bold border border-green-200 text-center animate-bounce">
                    🎉 {{ session('sukses') }}
                </div>
            @endif
             @if(session('error'))
                <div class="mt-4 p-3 bg-green-100 text-red-700 rounded-xl text-sm font-bold border border-green-200 text-center animate-bounce">
                    ❌ {{ session('error') }}
                </div>
            @endif
        </div>

        <h3 class="text-xl font-bold text-slate-700 mb-4 border-b pb-2 border-slate-200">Daftar Buku Tersedia:</h3>
        
        <div class="space-y-3 mb-8">
    @foreach($semuaBuku as $buku)
    <div class="p-4 rounded-xl flex justify-between items-center border 
        {{ $buku->status == 'Tersedia' ? 'bg-blue-50 border-blue-100' : 'bg-gray-100 border-gray-200' }}">
        
        <div>
            <h4 class="font-bold text-slate-800 text-lg">{{ $buku->judul }}</h4>
            <p class="text-sm text-slate-500 mb-1">✏️ Ditulis oleh: <span class="italic font-medium">{{ $buku->penulis }}</span></p>
            
            <span class="text-xs px-2 py-0.5 rounded font-bold 
                {{ $buku->status == 'Tersedia' ? 'bg-blue-200 text-blue-800' : 'bg-red-200 text-red-800' }}">
                {{ $buku->status }}
            </span>
        </div>

        @if($buku->status == 'Tersedia')
            <form method="POST" action="/pinjam-buku">
                @csrf
                <input type="hidden" name="judul_buku" value="{{ $buku->judul }}">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-xs font-bold cursor-pointer transition-all active:scale-95">
                    Pinjam Buku
                </button>
            </form>
        @else
           <form method="POST" action="/kembalikan-buku">
                        @csrf
                        <input type="hidden" name="judul_buku" value="{{ $buku->judul }}">
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2.5 rounded-xl text-xs font-bold cursor-pointer transition-all active:scale-95">
                            Kembalikan Buku ↩️
                        </button>
                    </form>
        @endif

    </div>
    @endforeach
</div>

        <div class="flex justify-end">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2.5 px-5 rounded-xl shadow-md hover:shadow-lg transition-all cursor-pointer">
                    Keluar Aplikasi 🚪
                </button>
            </form>
        </div>

    </div>

</body>
</html>