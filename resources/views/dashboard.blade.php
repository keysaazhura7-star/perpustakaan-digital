<x-app-layout>
    <header class="bg-white border-b border-slate-100 py-6 mb-8">
    <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tighter uppercase">
                Perpustakaan <span class="text-pink-600">Digital</span>
            </h1>
            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Sistem Kelola Buku & Peminjaman</p>
        </div>
        <div class="text-right">
            <span class="text-[10px] bg-slate-100 text-slate-600 px-3 py-1 rounded-full font-bold uppercase">
                {{ now()->format('d M Y') }}
            </span>
        </div>
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
                    
                    {{-- LINK AKSES DAFTAR PINJAMAN (KHUSUS PENJAGA) --}}
                    @if(Auth::check() && Auth::user()->role == 'penjaga')
                        <div class="col-span-full flex justify-end">
                            <a href="{{ route('peminjaman.index') }}" 
                            class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-6 rounded-2xl shadow-lg transition-all text-xs uppercase tracking-widest">
                            📋 Lihat Daftar Peminjaman Buku
                            </a>
                        </div>

                        {{-- TAMBAH BUKU BARU (KHUSUS PENJAGA) --}}
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
                                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Deskripsi</label>
                                        <input type="text" name="deskripsi" required class="w-full rounded-2xl border-slate-200 focus:border-pink-500 focus:ring-pink-500 text-sm p-3.5">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Kategori</label>
                                        <select name="kategori" class="w-full rounded-2xl border-slate-200 focus:border-pink-500 focus:ring-pink-500 text-sm p-3.5 bg-white">
                                            <option value="Sains">🔬 Sains</option>
                                            <option value="Fiksi">📖 Fiksi</option>
                                            <option value="Sejarah">📜 Sejarah</option>
                                        </select>
                                    </div>
                                    <div>
                                 <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Pilih File Sampul</label>
                                <input type="file" name="cover" class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:bg-red-50 file:text-red-700">
                                    </div>
                                </div>
                                <input type="hidden" name="status" value="Tersedia">
                                <button type="submit" class="w-full py-3.5 bg-pink-600 text-black font-black rounded-2xl text-xs uppercase tracking-widest cursor-pointer">
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
                                   {{-- TOMBOL HAPUS BUKU MODERN (KHUSUS PENJAGA) --}}
                                    @if(Auth::check() && strtolower(Auth::user()->role) == 'penjaga')
                                        <form id="form-delete-{{ $item->id }}" action="{{ route('books.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                    onclick="konfirmasiHapus({{ $item->id }}, '{{ addslashes($item->judul) }}')" 
                                                    class="flex items-center gap-1.5 text-rose-500 hover:text-rose-700 text-xs font-bold bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-xl transition-all shadow-sm active:scale-95" 
                                                    title="Hapus Buku">
                                                <span>🗑️</span>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                <div class="w-full h-[180px] bg-slate-50 border border-slate-100/70 rounded-2xl overflow-hidden mb-4 flex items-center justify-center">
                                    @if($item->cover)
                                        <img src="{{ asset('storage/' . $item->cover) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-4xl">📖</span>
                                    @endif
                                </div>

                                {{-- FORM GANTI SAMPUL (HANYA PENJAGA) --}}
@if(Auth::check() && strtolower(Auth::user()->role) == 'penjaga')
    <form action="{{ route('books.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="mb-4 pt-3 border-t border-dashed border-slate-100">
        @csrf 
        @method('PUT')
        
        {{-- Kirim data pendukung agar lolos validasi Controller --}}
        <input type="hidden" name="judul" value="{{ $item->judul }}">
        <input type="hidden" name="penulis" value="{{ $item->penulis }}">
        <input type="hidden" name="kategori" value="{{ $item->kategori }}">
        <input type="hidden" name="status" value="{{ $item->status }}">
        <input type="hidden" name="deskripsi" value="{{ $item->deskripsi }}">

        <label class="block w-full cursor-pointer bg-slate-100 hover:bg-slate-200 text-slate-600 text-[10px] text-center py-2 rounded-lg font-bold transition mb-2">
            <span id="label-file-{{$item->id}}">PILIH FOTO SAMPUL</span>
            {{-- Hapus atribut value dan sesuaikan required jika opsional --}}
            <input type="file" name="cover" class="hidden" 
                onchange="document.getElementById('label-file-{{$item->id}}').innerText = this.files[0].name">
        </label>
        
        <button type="submit" class="w-full bg-pink-600 text-white text-[10px] font-bold py-2 rounded-lg hover:bg-pink-700 transition">
            💾 SIMPAN PERUBAHAN
        </button>
    </form>
@endif

@if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-3xl text-xs font-bold shadow-sm mb-6">
        <ul>
            @foreach ($errors->all() as $error)
                <li>⚠️ {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                                <h3 class="font-black text-slate-800 text-xl mb-1">{{ $item->judul }}</h3>
                                <p class="text-xs text-slate-400 mb-4">by {{ $item->penulis }}</p>
                                <p class="text-xs text-slate-600 italic leading-relaxed h-20 overflow-y-auto mb-4">
                                    {{ $item->deskripsi }}
                                </p>
                            </div>  
 
                            {{-- TOMBOL AKSI PEMINJAMAN --}}
                            <div class="p-6 bg-slate-50/50 border-t border-slate-100/80">
                                <div class="mb-4 text-[9px] font-mono text-rose-500 bg-rose-100 p-2 rounded italic text-center border border-rose-200">
                                    Status : [{{ $item->status }}]
                                </div>

                                @if($item->status == 'Tersedia')
                                    <form method="POST" action="{{ route('books.pinjam') }}">
                                        @csrf
                                        <input type="hidden" name="judul_buku" value="{{ $item->judul }}">
                                        <button type="submit" class="w-full flex items-center justify-center gap-3 py-3 bg-red-600 text-white font-bold px-4 rounded-xl text-xs uppercase tracking-wider">
                                            <span> PINJAM BUKU </span>
                                            <span> 💖 </span>
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('books.kembalikan') }}">
                                        @csrf
                                        <input type="hidden" name="judul_buku" value="{{ $item->judul }}">
                                        <button type="submit" class="w-full flex items-center justify-center gap-3 py-3 bg-blue-600 text-white font-bold px-4 rounded-xl text-xs uppercase tracking-wider">
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
 {{-- CDN SWEETALERT2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- SCRIPT JAVASCRIPT UNTUK POP-UP SWEETALERT2 --}}
    <script>
        // 1. Function Pop-up Konfirmasi Hapus
        function konfirmasiHapus(id, judul) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus buku "${judul}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-3xl p-6 shadow-xl',
                    confirmButton: 'px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider',
                    cancelButton: 'px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-delete-' + id).submit();
                }
            });
        }

        // 2. Pop-up Otomatis Jika Berhasil (Flash Session Sukses)
        @if(session('sukses'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('sukses') }}",
                timer: 2500,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-3xl p-6 shadow-xl'
                }
            });
        @endif

        // 3. Pop-up Otomatis Jika Error (Flash Session Error)
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#ef4444',
                customClass: {
                    popup: 'rounded-3xl p-6 shadow-xl'
                }
            });
        @endif
    </script>
</x-app-layout>