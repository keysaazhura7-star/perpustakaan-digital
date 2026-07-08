<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Masuk Perpustakaan Ceria</title>
        <!-- Kita panggil Tailwind CSS lewat internet biar praktis dan langsung cantk -->
         <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <body class="bg-gradient-to-tr from-blue-600 to-indigo-800 font-sans min-h-screen flex items-center justify-center p-4">
        
         <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md border border-white/20">
        
         <div class="text-center mb-8">
            <div class="bg-blue-100 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-md">
                <span class="text-3xl">📚</span>  
         </div>
         <h1 class="text-2xl font-extrabold text-slate-800">Selamat Datang!</h1>
            <p class="text-slate-500 text-sm mt-1">Silahkan masuk untuk membaca atau memantau buku</p>
        </div>

        @if($errors->any())
         <div class="mb-4 p-3 bg-red-50 text-red-600 rounded-xl text-sm font-medium brder border-red-200">   🚨 Aduh, email atau password-mu salah nih. Coba cek lagi ya!</div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-bold text-slate-700 mb-1.5">Alamat Email</label>
                <input type="email" id="email"name="email" :value="old('email')" required autofocus placeholder="nama@email.com" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-slate-800">
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-slate-700 mb-1.5">Kata Sandi (password)</label>
                <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="....." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-slate-800">
            </div>

            <div class="flex items-center">
                <input type="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500 curson-pointe">
                <label for="remember_me" class="ml-2 text-sm text-slate-600 curson-pointer select-none">Biarkan saya tetap masuk</label>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg hover:shadow-blue-500/30 transition-all curson-pointer transform active:scale-95 text-center block">Masuk Sekarang</button>
        </form>

            <div class="relative flex py-4 items-center">
                <div class="flex-grow border-t border-slate-200"></div>
                <span class="flex-shrink mx-4 text-slate-400 text-xs uppercase">Atau</span>
                <div class="flex-grow border-t border-slate-200"></div>
            </div>

            <div class="text-center">
                <a href="{{ route('register') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">Belum punya akun? Bikin di sini</a>
            </div>
    
        </div>
    </body>
</html>