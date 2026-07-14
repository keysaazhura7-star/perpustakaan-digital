<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Masuk - Perpustakaan Ceria</title>

    <!-- Fonts & Tailwind Styles -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Proteksi Tambahan: Memaksa Focus State Menjadi Pink & Menghilangkan Outline Biru -->
    <style>
        input:focus {
            border-color: #db2777 !important;
            box-shadow: 0 0 0 4px rgba(219, 39, 119, 0.15) !important;
            outline: none !important;
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-800 bg-slate-50">

    <!-- Background Wrapper dengan Gradasi Soft Rose -->
    <div class="min-h-screen w-full flex flex-col justify-center items-center bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-rose-100 via-rose-50/30 to-white relative overflow-hidden px-4 py-8">
        
        <!-- Ornamen Dekorasi Melingkar Lembut di Latar Belakang -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-pink-200/40 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-rose-200/40 rounded-full blur-3xl pointer-events-none"></div>

        <!-- 🌸 KARTU LOGIN (DIKUNCI UKURANNYA MENGGUNAKAN INLINE STYLE AGAR TIDAK MELAR) 🌸 -->
        <div class="w-full mx-auto px-8 py-10 bg-white/95 backdrop-blur-md border border-rose-100/80 shadow-2xl shadow-pink-100/40 rounded-[32px] relative z-10" 
             style="max-width: 440px !important;">
            
            <!-- Header Section (Logo & Ucapan) -->
            <div class="text-center mb-8">
                <div class="inline-flex p-4 bg-pink-50 rounded-2xl text-pink-500 shadow-inner mb-4">
                    <span class="text-3xl animate-bounce">📚</span>
                </div>
                <h2 class="font-black text-2xl bg-gradient-to-r from-rose-700 to-pink-600 bg-clip-text text-transparent tracking-tight">
                    Selamat Datang!
                </h2>
                <p class="text-xs font-semibold text-slate-400 mt-1.5">
                    Silakan masuk untuk membaca atau memantau buku
                </p>
            </div>

            <!-- Session Status Alert -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-xl border border-green-100">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Input Alamat Email -->
                <div>
                    <label for="email" class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1.5">
                        Alamat Email
                    </label>
                    <input id="email" 
                           class="block w-full rounded-2xl border border-rose-100/80 bg-white/60 text-sm p-3.5 transition-all duration-300" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           autocomplete="username" 
                           placeholder="nama@email.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-rose-600" />
                </div>

                <!-- Input Kata Sandi -->
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label for="password" class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">
                            Kata Sandi (password)
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-[10px] font-bold text-pink-500 hover:text-pink-600 transition-colors" href="{{ route('password.request') }}">
                                Lupa sandi?
                            </a>
                        @endif
                    </div>
                    <input id="password" 
                           class="block w-full rounded-2xl border border-rose-100/80 bg-white/60 text-sm p-3.5 transition-all duration-300" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="current-password" 
                           placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-rose-600" />
                </div>

                <!-- Remember Me (Ingat Saya) -->
                <div class="flex items-center">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                        <input id="remember_me" 
                               type="checkbox" 
                               class="rounded border-rose-200 text-pink-600 focus:ring-pink-500 focus:ring-opacity-30 w-4 h-4 shadow-sm transition-all" 
                               name="remember">
                        <span class="ms-2.5 text-xs font-semibold text-slate-400 hover:text-slate-600 transition-colors">Biarkan saya tetap masuk</span>
                    </label>
                </div>

                <!-- Tombol Submit Premium (Pink Nyala) -->
                <div class="pt-2">
                    <button type="submit" 
                            style="background-color: #db2777 !important; color: #ffffff !important;" 
                            class="w-full text-white font-black py-4 px-4 rounded-2xl shadow-md shadow-pink-100 hover:bg-pink-700 hover:shadow-lg hover:shadow-pink-200/50 transition-all active:scale-[0.96] cursor-pointer text-center block text-xs tracking-widest uppercase">
                        ✨ Masuk Sekarang
                    </button>
                </div>

                <!-- Divider -->
                <div class="relative flex py-2 items-center">
                    <div class="flex-grow border-t border-rose-100/50"></div>
                    <span class="flex-shrink mx-4 text-[10px] font-black text-slate-300 tracking-widest uppercase">ATAU</span>
                    <div class="flex-grow border-t border-rose-100/50"></div>
                </div>

                <!-- Link Daftar -->
                <div class="text-center">
                    <a href="{{ route('register') }}" class="text-xs font-bold text-pink-600 hover:text-pink-700 hover:underline transition-all">
                        Belum punya akun? Bikin di sini
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>