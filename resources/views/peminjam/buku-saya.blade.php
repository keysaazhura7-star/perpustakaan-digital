<x-app-layout>
    <header class="bg-white border-b border-slate-100 py-6 mb-8">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-black text-slate-800 tracking-tighter uppercase">
                    Perpustakaan <span class="text-pink-600">Digital</span>
                </h1>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Buku Pinjaman Saya</p>
            </div>
            <div class="text-right">
                <a href="{{ route('dashboard') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-xl text-xs font-bold transition">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
    </header>

    <div class="py-12 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-rose-50/70 via-slate-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-md p-8 rounded-[32px] border border-rose-100/60 shadow-sm">
                
                <h2 class="text-lg font-black text-slate-800 uppercase tracking-wider mb-6">📚 Daftar Buku yang Sedang Anda Pinjam</h2>

                @if($peminjamanSaya->isEmpty())
                    <div class="bg-blue-50 border border-blue-200 text-blue-700 px-6 py-4 rounded-2xl text-xs font-bold">
                        Anda belum meminjam buku apapun saat ini. Yuk cari buku di dashboard!
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs text-slate-700">
                            <thead>
                                <tr class="border-b border-slate-100 text-slate-400 font-bold uppercase tracking-wider">
                                    <th class="pb-3 px-4">No</th>
                                    <th class="pb-3 px-4">Judul Buku</th>
                                    <th class="pb-3 px-4">Tanggal Pinjam</th>
                                    <th class="pb-3 px-4">Batas Pengembalian</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($peminjamanSaya as $index => $item)
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="py-4 px-4 font-bold">{{ $index + 1 }}</td>
                                    <td class="py-4 px-4 font-black text-slate-800">{{ $item->judul_buku }}</td>
                                    <td class="py-4 px-4 text-slate-500">{{ $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-' }}</td>
                                    <td class="py-4 px-4 text-pink-600 font-bold">{{ $item->tanggal_kembali }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>