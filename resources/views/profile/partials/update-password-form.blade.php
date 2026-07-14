<section>
    <header class="mb-6">
        <h3 class="text-lg font-black text-slate-800 flex items-center gap-2">
            🔑 {{ __('Ubah Kata Sandi') }}
        </h3>
        <p class="mt-1 text-xs font-semibold text-slate-400">
            {{ __('Pastikan akun kamu menggunakan kata sandi yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1.5">Kata Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="block w-full rounded-2xl border border-rose-100/80 bg-white/60 text-sm p-3.5 focus:border-pink-500 focus:ring focus:ring-pink-100/80 transition-all duration-300" style="outline: none !important;" autocomplete="current-password" placeholder="••••••••" />
            <x-input-error class="mt-2 text-xs text-rose-600" :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div>
            <label for="update_password_password" class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1.5">Kata Sandi Baru</label>
            <input id="update_password_password" name="password" type="password" class="block w-full rounded-2xl border border-rose-100/80 bg-white/60 text-sm p-3.5 focus:border-pink-500 focus:ring focus:ring-pink-100/80 transition-all duration-300" style="outline: none !important;" autocomplete="new-password" placeholder="••••••••" />
            <x-input-error class="mt-2 text-xs text-rose-600" :messages="$errors->updatePassword->get('password')" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1.5">Ulangi Kata Sandi Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full rounded-2xl border border-rose-100/80 bg-white/60 text-sm p-3.5 focus:border-pink-500 focus:ring focus:ring-pink-100/80 transition-all duration-300" style="outline: none !important;" autocomplete="new-password" placeholder="••••••••" />
            <x-input-error class="mt-2 text-xs text-rose-600" :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" style="background-color: #db2777 !important; color: #ffffff !important;" class="text-white font-black py-3 px-6 rounded-2xl shadow-md shadow-pink-100 hover:bg-pink-700 hover:shadow-lg hover:shadow-pink-200/50 transition-all active:scale-[0.96] cursor-pointer text-xs tracking-widest uppercase">
                💾 {{ __('Perbarui Sandi') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1.5 rounded-full border border-green-100">{{ __('Sandi Diperbarui!') }}</p>
            @endif
        </div>
    </form>
</section>