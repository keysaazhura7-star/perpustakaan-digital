<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjaga</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-teal-50 font-sans min-h-screen flex flex-col items-center justify-center p-6">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-3xl border border-teal-100">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-teal-600 mb-2">🕵️‍♂️ Ruang Kerja Penjaga</h1>
            <p class="text-slate-500">Halaman rahasia khusus petugas untuk memantau peminjaman buku.</p>
        </div>

        <h3 class="text-xl font-bold text-slate-700 mb-4 border-b pb-2 border-teal-100">Daftar Buku Yang Sedang Dipinjam:</h3>
        
        <div class="overflow-hidden rounded-xl border border-slate-200 shadow-sm mb-8">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-teal-600 text-white font-bold">
                        <th class="p-4">Nama Teman</th>
                        <th class="p-4">Buku yang Dipinjam</th>
                        <th class="p-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($semuaPinjaman as $p)
                    <tr class="hover:bg-slate-50 bg-white transition-colors">
                        <td class="p-4 font-semibold text-slate-800">👤 {{ $p->nama_peminjam }}</td>
                        <td class="p-4 text-slate-600 italic">📖 "{{ $p->judul_buku }}"</td>
                        <td class="p-4">
                            <span class="bg-amber-100 text-amber-700 text-xs px-2.5 py-1 rounded-md font-bold">Belum Kembali</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="p-8 text-center text-slate-400 bg-slate-50 italic">
                            Aman! Belum ada teman yang meminjam buku hari ini. ☕
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex justify-end">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-slate-700 hover:bg-slate-800 text-white font-bold py-2.5 px-5 rounded-xl shadow-md transition-all cursor-pointer">
                    Keluar Aplikasi 🚪
                </button>
            </form>
        </div>

    </div>

</body>
</html>