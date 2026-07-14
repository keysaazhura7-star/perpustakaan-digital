<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between dynamic-header">
            <div>
                <span class="text-[10px] font-black tracking-widest text-pink-500 uppercase">Personal Settings</span>
                <h2 class="text-2xl font-black text-slate-800 tracking-tight mt-0.5 flex items-center gap-2">
                    ✨ {{ __('Pengaturan Akun') }}
                </h2>
            </div>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-slate-100 hover:bg-pink-600 text-xs font-black text-slate-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md active:scale-[0.95] cursor-pointer uppercase tracking-wider">
                ⬅️ Ke Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-rose-100/60 via-slate-50 to-white min-h-screen relative overflow-hidden px-4 sm:px-6 lg:px-8">
        
        <div class="absolute -top-20 -left-20 w-[450px] h-[450px] bg-pink-300/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-10 right-10 w-[500px] h-[500px] bg-rose-200/20 rounded-full blur-[150px] pointer-events-none"></div>

        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 relative z-10">
            
            <div class="lg:col-span-7 space-y-8">
                <div class="p-6 sm:p-8 bg-white/80 backdrop-blur-xl border border-rose-100/80 shadow-[0_20px_50px_rgba(244,63,94,0.05)] rounded-[32px] hover:shadow-[0_20px_50px_rgba(244,63,94,0.08)] transition-all duration-300 relative group overflow-hidden">
                    <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-pink-500 to-rose-400"></div>
                    <div class="max-w-2xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 space-y-8">
                <div class="p-6 sm:p-8 bg-white/80 backdrop-blur-xl border border-slate-100 shadow-[0_20px_50px_rgba(0,0,0,0.02)] rounded-[32px] hover:border-rose-100/50 transition-all duration-300">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-6 sm:p-8 bg-rose-50/30 backdrop-blur-xl border border-rose-100/40 shadow-sm rounded-[32px]">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>