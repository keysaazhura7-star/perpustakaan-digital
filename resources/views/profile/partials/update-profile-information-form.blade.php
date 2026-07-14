<section>
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-pink-50 text-xs font-black text-slate-600 hover:text-pink-600 transition-all duration-200 active:scale-[0.97] uppercase tracking-wider">
            ⬅️ Kembali ke Dashboard
        </a>
    </div>

    <header class="mb-8">
        <h3 class="text-xl font-black text-slate-800 tracking-tight flex items-center gap-2.5">
            <span class="p-2 bg-pink-100 text-pink-600 rounded-xl text-base shadow-sm">👤</span>
            {{ __('Informasi Profil') }}
        </h3>
        <p class="mt-2 text-xs font-medium text-slate-400 max-w-md leading-relaxed">
            Kelola data personal identitas akun perpustakaanmu dan perbarui alamat surel secara berkala di sini.
        </p>
    </header>

    <form method="post" action="{{ route('profile.avatar.update') }}" enctype="multipart/form-data" class="space-y-6 w-full">
        @csrf
        @method('post')

        <div class="flex items-center gap-6 p-5 bg-gradient-to-r from-pink-50/40 to-rose-50/20 rounded-[24px] border border-rose-100/70 w-full shadow-inner">
            <div class="relative flex-shrink-0" style="width: 80px; height: 80px;">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-3xl object-cover border-4 border-white shadow-md shadow-pink-200 block" style="width: 80px; height: 80px; min-width: 80px; min-height: 80px; max-width: 80px; max-height: 80px;">
                @else
                    <div class="rounded-3xl bg-gradient-to-tr from-rose-400 to-pink-500 flex items-center justify-center text-white text-2xl font-black border-4 border-white shadow-md shadow-pink-200" style="width: 80px; height: 80px; min-width: 80px; min-height: 80px;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
                <div class="absolute -bottom-1 -right-1 bg-white p-1 rounded-lg border border-pink-100 shadow-sm text-[10px]" style="z-index: 10;">📸</div>
            </div>
            
            <div class="flex-1 space-y-1">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">
                    Foto Avatar Akun
                </span>
                
                <label class="inline-block">
                    <input id="avatar" name="avatar" type="file" accept="image/*" class="hidden" required onchange="updateFileName(this)" />
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-pink-200 bg-white text-xs font-black text-pink-600 shadow-sm hover:bg-pink-600 hover:text-white hover:border-pink-600 transition-all duration-300 cursor-pointer active:scale-[0.97] uppercase tracking-wider">
                        📂 Ganti Foto
                    </span>
                </label>
                
                <span id="file-chosen" class="block text-[11px] font-semibold text-slate-400 italic">Belum ada file dipilih</span>
                <x-input-error class="mt-2 text-xs text-rose-600" :messages="$errors->get('avatar')" />
            </div>
        </div>

        <div class="space-y-1.5">
            <label for="name" class="text-[10px] font-black text-slate-400 uppercase tracking-widest block ml-1">
                Nama Lengkap
            </label>
            <input id="name" name="name" type="text" class="block w-full rounded-2xl border border-slate-200 bg-white/80 text-sm p-4 text-slate-700 focus:border-pink-500 focus:ring-4 focus:ring-pink-100/50 focus:bg-white transition-all duration-300 shadow-sm outline-none" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-1 text-xs text-rose-600" :messages="$errors->get('name')" />
        </div>

        <div class="space-y-1.5">
            <label for="email" class="text-[10px] font-black text-slate-400 uppercase tracking-widest block ml-1">
                Alamat Email
            </label>
            <input id="email" name="email" type="email" class="block w-full rounded-2xl border border-slate-200 bg-white/80 text-sm p-4 text-slate-700 focus:border-pink-500 focus:ring-4 focus:ring-pink-100/50 focus:bg-white transition-all duration-300 shadow-sm outline-none" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-1 text-xs text-rose-600" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" style="background-color: #db2777 !important; color: #ffffff !important;" class="text-white font-black py-4 px-8 rounded-2xl shadow-lg shadow-pink-200 hover:bg-pink-700 hover:shadow-xl hover:shadow-pink-300/50 transition-all active:scale-[0.96] cursor-pointer text-xs tracking-widest uppercase flex items-center gap-2">
                💾 {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated' || session('sukses'))
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)" class="text-xs font-bold text-emerald-600 bg-emerald-50 px-4 py-2 rounded-xl border border-emerald-100 shadow-sm animate-fade-in">
                    ✨ Berhasil Diperbarui!
                </p>
            @endif
        </div>
    </form>

    <script>
        function updateFileName(input) {
            const fileNameSpan = document.getElementById('file-chosen');
            if (input.files && input.files.length > 0) {
                fileNameSpan.textContent = '📄 ' + input.files[0].name;
                fileNameSpan.classList.remove('text-slate-400');
                fileNameSpan.classList.add('text-pink-600', 'font-black');
            } else {
                fileNameSpan.textContent = 'Belum ada file dipilih';
                fileNameSpan.classList.remove('text-pink-600', 'font-black');
                fileNameSpan.classList.add('text-slate-400');
            }
        }
    </script>
</section>