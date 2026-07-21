<x-app-layout>
    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-6">
            
            {{-- Tombol Kembali --}}
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-xs font-bold text-slate-500 hover:text-blue-600 transition mb-6">
                ← Kembali ke Dashboard
            </a>

            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm grid grid-cols-1 md:grid-cols-3 gap-8">
                
                {{-- Sampul Buku Besar --}}
                <div class="md:col-span-1">
                    @if($buku->cover)
                        <img src="{{ asset('storage/' . $buku->cover) }}" class="w-full aspect-[2/3] object-cover rounded-2xl shadow-md" alt="{{ $buku->judul }}">
                    @else
                        <div class="w-full aspect-[2/3] bg-slate-100 rounded-2xl flex flex-col items-center justify-center text-slate-400">
                            <span class="text-4xl">📁</span>
                            <span class="text-xs font-bold mt-2">Tidak Ada Sampul</span>
                        </div>
                    @endif
                </div>

                {{-- Detail Informasi Buku --}}
                <div class="md:col-span-2 flex flex-col justify-between">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider bg-blue-50 text-blue-600 px-3 py-1 rounded-full">
                            {{ $buku->kategori }}
                        </span>
                        
                        <h1 class="text-2xl font-black text-slate-800 mt-3">{{ $buku->judul }}</h1>
                        <p class="text-sm font-semibold text-slate-400 mt-1">Penulis: <span class="text-slate-600">{{ $buku->penulis }}</span></p>

                        <div class="mt-6 border-t border-slate-100 pt-4">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Deskripsi Buku</h3>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                {{ $buku->deskripsi ?? 'Belum ada deskripsi untuk buku ini.' }}
                            </p>
                        </div>
                    </div>

                   <div class="pt-2">
                        @if($buku->status == 'Tersedia')
                            <form method="POST" action="{{ route('books.pinjam') }}">
                                @csrf
                                <input type="hidden" name="judul_buku" value="{{ $buku->judul }}">
                                <button type="submit" class="w-full flex items-center justify-center gap-3 py-3 bg-pink-600 hover:bg-pink-700 text-white font-bold rounded-2xl text-xs uppercase tracking-wider shadow-lg shadow-pink-600/20 transition-all active:scale-95 cursor-pointer">
                                    <span>Pinjam Buku Ini</span>
                                    <span>💖</span>
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('books.kembalikan') }}">
                                @csrf
                                <input type="hidden" name="judul_buku" value="{{ $buku->judul }}">
                                <button type="submit" class="w-full flex items-center justify-center gap-3 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl text-xs uppercase tracking-wider shadow-lg shadow-blue-600/20 transition-all active:scale-95 cursor-pointer">
                                    <span>↩️</span>
                                    <span>Kembalikan Buku</span>
                                </button>
                            </form>
                        @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>