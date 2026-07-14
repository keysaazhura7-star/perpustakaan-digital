<section class="space-y-6">
    <header>
        <h3 class="text-lg font-black text-slate-800 flex items-center gap-2">
            🚨 {{ __('Hapus Akun') }}
        </h3>
        <p class="mt-1 text-xs font-medium text-slate-400">
            {{ __('Setelah akun kamu dihapus, semua data dan riwayat peminjaman akan dihapus secara permanen.') }}
        </p>
    </header>

    <!-- Tombol Pemicu Modal Hapus Akun -->
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        style="background-color: #e11d48 !important; color: #ffffff !important;"
        class="text-xs font-black py-3 px-6 rounded-2xl shadow-sm shadow-rose-100 hover:bg-rose-700 transition-all active:scale-[0.96] cursor-pointer tracking-widest uppercase"
    >
        {{ __('Hapus Akun Permanen') }}
    </button>

    <!-- Pop-up / Modal Konfirmasi Hapus Akun -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white rounded-3xl border border-rose-100/50">
            @csrf
            @method('delete')

            <h2 class="text-lg font-black text-slate-800">
                {{ __('Apakah kamu yakin ingin menghapus akun ini?') }}
            </h2>

            <p class="mt-1 text-xs font-medium text-slate-400">
                {{ __('Silakan masukkan kata sandi kamu untuk mengonfirmasi bahwa kamu benar-benar ingin menghapus akun ini secara permanen.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Kata Sandi') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full rounded-2xl border-rose-100/80 focus:border-pink-500 focus:ring-pink-500 shadow-sm text-sm p-3.5"
                    placeholder="{{ __('Kata Sandi Kamu') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-xs" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <!-- Tombol Batal -->
                <button 
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="text-xs font-bold px-5 py-3 rounded-2xl bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors uppercase tracking-wider"
                >
                    {{ __('Batal') }}
                </button>

                <!-- Tombol Konfirmasi Hapus -->
                <button 
                    type="submit"
                    style="background-color: #e11d48 !important; color: #ffffff !important;"
                    class="text-xs font-black px-5 py-3 rounded-2xl shadow-sm hover:bg-rose-700 transition-all uppercase tracking-wider cursor-pointer"
                >
                    {{ __('Ya, Hapus Akun') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>