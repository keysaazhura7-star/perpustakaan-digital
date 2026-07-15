<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        {{-- Tombol Kembali ke Dashboard --}}
        <div classs="mb-6">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-slate-500 hover:text-pink-600 font-bold transition duration-300 ease-in-out">
                <span class="mr-2 text-xl">←</span> KEMBALI KE DASHBOARD
            </a>
        </div>
        
        <h2 class="text-3xl font-black text-slate-800 mb-8 uppercase tracking-widest">
            📋 Daftar Buku Sedang Dipinjam
        </h2>

        <div class="bg-white p-6 rounded-[32px] shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-slate-400 text-xs font-bold uppercase tracking-widest border-b border-slate-100">
                        <th class="p-4">Peminjam</th>
                        <th class="p-4">Judul Buku</th>
                        <th class="p-4">Tenggat Waktu</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-slate-700">
                    @foreach($peminjaman as $data)
                    <tr class="border-b border-slate-50 hover:bg-slate-50 transition">
                        <td class="p-4 font-semibold">{{ $data->nama_peminjam }}</td>
                        <td class="p-4 font-medium">{{ $data->judul_buku }}</td>
                        <td class="p-4 text-sm">{{ \Carbon\Carbon::parse($data->tanggal_kembali)->format('d M Y') }}</td>
                        <td class="p-4 text-center">
                            {{-- Tombol Kembalikan --}}
                            <form action="{{ route('books.kembalikan') }}" method="POST">
                                @csrf
                                <input type="hidden" name="judul_buku" value="{{ $data->judul_buku }}">
                                <button type="submit" class="text-xs bg-pink-100 text-pink-600 font-bold px-4 py-2 rounded-xl hover:bg-pink-600 hover:text-white transition">
                                    KEMBALIKAN
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>