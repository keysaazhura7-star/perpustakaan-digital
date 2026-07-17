<x-app-layout>
    <header class="bg-white border-b border-slate-100 py-6 mb-8">
    <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
        <div>
            <!-- Tambahkan font-black untuk ketebalan maksimal -->
            <h1 class="text-2xl font-black text-slate-800 tracking-tighter uppercase">
                Perpustakaan <span class="text-pink-600">Digital</span>
            </h1>
            <!-- Tambahkan font-black di sini juga -->
            <p class="text-xs text-slate-400 font-black uppercase tracking-widest">
                Sistem Kelola Buku & Peminjaman
            </p>
        </div>
        <!-- ... sisa kode lainnya ... -->
    </div>
</header>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        @if(session('sukses'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-3xl text-xs font-bold shadow-sm mb-6">
                ✅ {{ session('sukses') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-700 px-6 py-4 rounded-3xl text-xs font-bold shadow-sm mb-6">
                ⚠️ {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="py-12 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-rose-50/70 via-slate-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            {{-- PEMBERITAHUAN BUKU TERLAMBAT --}}
            @if(isset($bukuTerlambat) && $bukuTerlambat->count() > 0)
                <div class="bg-white/40 backdrop-blur-md border-l-4 border-pink-500 p-6 rounded-3xl shadow-sm border border-rose-100/80">
                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-red-50 text-red-500 rounded-2xl shadow-inner animate-bounce">
                            <span>⏰</span>
                        </div>
                        <div class="w-full">
                            <h3 class="text-xs font-black text-rose-900 tracking-widest mb-3 uppercase">Pemberitahuan Pengembalian Buku</h3>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-xs text-rose-950">
                                    <thead>
                                        <tr class="border-b border-rose-200/40 opacity-70">
                                            <th class="pb-2 font-bold uppercase tracking-wider text-rose-700">Nama Peminjam</th>
                                            <th class="pb-2 font-bold uppercase tracking-wider text-rose-700">Judul Buku</th>
                                            <th class="pb-2 text-right font-bold uppercase tracking-wider text-rose-700">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-rose-100/30">
    @foreach($bukuTerlambat as $pinjam)
        <tr class="hover:bg-rose-100/20 transition-colors">
            <td class="py-3 font-semibold">{{ $pinjam->nama_peminjam }}</td>
            <td class="py-3 italic text-rose-800/90">"{{ $pinjam->judul_buku }}"</td>
            <td class="py-3 text-right">
                @if($pinjam->denda > 0)
                    <div class="flex flex-col items-end">
                        <span class="font-bold text-pink-600 animate-pulse uppercase text-[10px]">TERLAMBAT</span>
                        <span class="text-red-700 font-bold text-xs">
                            Rp {{ number_format($pinjam->denda, 0, ',', '.') }}
                        </span>
                    </div>
                @else
                    <span class="text-green-600 font-bold text-xs uppercase">Aman</span>
                @endif
            </td>
        </tr>
    @endforeach
</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- KATEGORI RAK BUKU --}}
            <div class="bg-white/80 backdrop-blur-md p-2.5 rounded-3xl shadow-sm border border-rose-100/60 flex flex-col sm:flex-row gap-4 items-center justify-between">
                <div class="flex items-center gap-3 pl-3">
                    <span class="text-rose-400 text-sm">🎀</span>
                    <span class="text-xs font-black text-slate-500 uppercase tracking-widest">Kategori Rak Buku</span>
                </div>
                <div class="flex flex-wrap gap-1 bg-slate-100/80 p-1 rounded-2xl w-full sm:w-auto">
                    <a href="/dashboard" class="text-xs font-bold px-5 py-2.5 rounded-xl transition-all duration-300 text-center flex-1 sm:flex-none {{ !request('kategori') ? 'bg-white text-pink-600 shadow-sm font-black' : 'text-slate-600 hover:text-slate-900' }}">Semua</a>
                    <a href="/dashboard?kategori=Sains" class="text-xs font-bold px-5 py-2.5 rounded-xl transition-all duration-300 text-center flex-1 sm:flex-none {{ request('kategori') == 'Sains' ? 'bg-white text-pink-600 shadow-sm font-black' : 'text-slate-600 hover:text-slate-900' }}">🔬 Sains</a>
                    <a href="/dashboard?kategori=Fiksi" class="text-xs font-bold px-5 py-2.5 rounded-xl transition-all duration-300 text-center flex-1 sm:flex-none {{ request('kategori') == 'Fiksi' ? 'bg-white text-pink-600 shadow-sm font-black' : 'text-slate-600 hover:text-slate-900' }}">📖 Fiksi</a>
                    <a href="/dashboard?kategori=Sejarah" class="text-xs font-bold px-5 py-2.5 rounded-xl transition-all duration-300 text-center flex-1 sm:flex-none {{ request('kategori') == 'Sejarah' ? 'bg-white text-pink-600 shadow-sm font-black' : 'text-slate-600 hover:text-slate-900' }}">📜 Sejarah</a>
                </div>
            </div>

            {{-- GRID UTAMA --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @if(isset($semuaBuku) && $semuaBuku->count() > 0)
                    
                    {{-- TAMBAH BUKU (KHUSUS PENJAGA) --}}

                    {{-- LINK AKSES DAFTAR PINJAMAN (Diletakkan sebelum form tambah buku) --}}
                        @if(Auth::check() && Auth::user()->role == 'penjaga')
                            <div class="max-w-2xl mx-auto mb-6 flex justify-end">
                                <a href="{{ route('peminjaman.index') }}" 
                                class="bg-pink-600 hover:bg-pink-700 text-gray font-bold py-2 px-6 rounded-2xl shadow-lg transition-all text-xs uppercase tracking-widest">
                                📋 Lihat Daftar Peminjaman Buku
                                </a>
                            </div>
                        @endif

                    @if(Auth::check() && Auth::user()->role == 'penjaga')
                        <div class="bg-white/80 backdrop-blur-md p-8 rounded-[32px] border border-rose-100/60 shadow-sm max-w-2xl mx-auto mb-10 col-span-full w-full">
                            <h3 class="font-black text-slate-800 text-lg uppercase tracking-wider mb-6">📚 Tambah Buku Baru</h3>
                            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                                @csrf
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Judul Buku</label>
                                    <input type="text" name="judul" required class="w-full rounded-2xl border-slate-200 focus:border-pink-500 focus:ring-pink-500 text-sm p-3.5">
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Penulis</label>
                                        <input type="text" name="penulis" required class="w-full rounded-2xl border-slate-200 focus:border-pink-500 focus:ring-pink-500 text-sm p-3.5">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Kategori</label>
                                        <select name="kategori" class="w-full rounded-2xl border-slate-200 focus:border-pink-500 focus:ring-pink-500 text-sm p-3.5 bg-white">
                                            <option value="Sains">🔬 Sains</option>
                                            <option value="Fiksi">📖 Fiksi</option>
                                            <option value="Sejarah">📜 Sejarah</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="status" value="Tersedia">
                                <button type="submit" class="w-full py-3.5 bg-red-600 text-black font-black rounded-2xl text-xs uppercase tracking-widest cursor-pointer">
                                    💾 Simpan Buku
                                </button>
                            </form>
                        </div>
                    @endif
                    
                    {{-- KARTU BUKU --}}
                    @foreach($semuaBuku as $item)
                        <div class="group bg-white rounded-[32px] overflow-hidden border border-rose-100/40 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col justify-between">
                            <div class="p-8">
                                <div class="flex items-center justify-between mb-5">
                                    <span class="text-[10px] uppercase tracking-widest bg-rose-50 text-pink-600 font-black px-3 py-1.5 rounded-xl">{{ $item->kategori ?? 'UMUM' }}</span>
                                </div>

                                <div class="w-full h-[180px] bg-slate-50 border border-slate-100/70 rounded-2xl overflow-hidden mb-4 flex items-center justify-center">
                                    @if($item->cover)
                                        <img src="{{ asset('storage/' . $item->cover) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-4xl">📖</span>
                                    @endif
                                    {{-- BAGIAN GANTI SAMPUL (HANYA PENJAGA) --}}
                                        @if(Auth::check() && Auth::user()->role == 'penjaga')
                                            <form action="{{ route('books.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                                                @csrf @method('PUT')
                                                
                                                <label class="block w-full cursor-pointer bg-slate-100 hover:bg-slate-200 text-slate-600 text-[10px] text-center py-2 rounded-lg font-bold transition">
                                                    <span id="label-file-{{$item->id}}">PILIH FOTO SAMPUL</span>
                                                    <input type="file" name="cover" required class="hidden" 
                                                        onchange="document.getElementById('label-file-{{$item->id}}').innerText = this.files[0].name">
                                                </label>
                                                
                                                <button type="submit" class="w-full mt-2 bg-pink-600 text-white text-[10px] font-bold py-2 rounded-lg hover:bg-pink-700 transition">
                                                    💾 SIMPAN PERUBAHAN
                                                </button>
                                            </form>
                                        @endif
                                </div>

                                <h3 class="font-black text-slate-800 text-xl mb-1">{{ $item->judul }}</h3>
                                <p class="text-xs text-slate-400 mb-4">by {{ $item->penulis }}</p>

                                @if(Auth::check() && Auth::user()->role == 'penjaga')
                                    <form action="{{ route('books.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                                        @csrf @method('PUT')
                                        <input type="file" name="cover" required class="w-full text-[10px] mb-2">
                                        <button type="submit" class="bg-pink-600 text-white text-[10px] px-3 py-1 rounded-lg">Ganti Sampul</button>
                                    </form>
                                @endif
                            </div>  
 
                            {{-- TOMBOL AKSI DENGAN DEBUG --}}
                            <div class="p-6 bg-slate-50/50 border-t border-slate-100/80">
                                <div class="mb-4 text-[9px] font-mono text-rose-500 bg-rose-100 p-2 rounded italic text-center border border-rose-200">
                                    Status DB: [{{ $item->status }}]
                                </div>

                                {{-- Gunakan cara ini untuk memastikan perbandingannya bersih --}}
@if($item->status == 'Tersedia')
    <form method="POST" action="{{ route('books.pinjam') }}">
        @csrf
        <input type="hidden" name="judul_buku" value="{{ $item->judul }}">
        <button type="submit" class="w-full flex items-center justify-center gap-3 py-4 bg-red-600 text-white font-bold py-2 px-4 rounded">
            <span> PINJAM BUKU </span>
            <span> 💖 </span>
        </button>
    </form>
@else
    <form method="POST" action="{{ route('books.kembalikan') }}">
        @csrf
        <input type="hidden" name="judul_buku" value="{{ $item->judul }}">
        <button type="submit" class="w-full flex items-center justify-center gap-3 py-4 bg-blue-600 text-white font-bold py-2 px-4 rounded">
            ↩️ KEMBALIKAN
        </button>
    </form>
@endif
                            </div>
                        </div>
                    @endforeach

                @else
                    <div class="col-span-full py-24 text-center">
                        <h4 class="text-base font-black text-rose-900">Rak Buku Kosong</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <footer class="mt-20 py-10 border-t border-slate-100 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <p class="text-slate-400 font-bold text-xs uppercase tracking-widest">
            &copy; {{ date('Y') }} Perpustakaan Digital. All rights reserved.
        </p>
        <p class="text-slate-300 text-[10px] mt-2">
            Dibangun dengan sepenuh hati untuk memudahkan akses literasi.
        </p>
    </div>
</footer>
</x-app-layout>