@extends('layouts.landing')

@section('title', 'Masuk ke Aksaraloka')

@section('content')
<main class="min-h-screen flex items-center justify-center pt-20 pb-10 bg-surface-container-low">
    <div class="max-w-[1000px] w-full px-6 grid grid-cols-1 md:grid-cols-2 gap-0 bg-white rounded-[2.5rem] overflow-hidden shadow-2xl border border-surface-variant">
        <!-- Left Side: Branding/Image -->
        <div class="hidden md:block relative bg-primary p-12 overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <span class="material-symbols-outlined text-[400px] absolute -right-20 -bottom-20" style="font-variation-settings: 'FILL' 1;">history_edu</span>
            </div>
            <div class="relative z-10 h-full flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">auto_stories</span>
                        </div>
                        <span class="font-headline text-2xl font-bold text-white">Aksaraloka</span>
                    </div>
                    <h2 class="font-headline text-4xl text-white font-bold leading-tight mb-4">Kembali Menjelajah Hanacaraka</h2>
                    <p class="text-on-primary-container text-base opacity-80">Lanjutkan progres belajarmu dan raih peringkat tertinggi di Liga Aksara.</p>
                </div>
                <div class="p-6 bg-white/10 backdrop-blur rounded-2xl border border-white/20">
                    <p class="text-white text-sm italic font-medium">"Wong Jowo ojo lali Jawane."</p>
                    <p class="text-white/60 text-[10px] mt-2 uppercase tracking-widest font-bold">— Pepatah Jawa</p>
                </div>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="p-10 md:p-16 flex flex-col justify-center">
            <div class="mb-10">
                <h1 class="font-headline text-3xl text-primary font-bold mb-2">Selamat Datang</h1>
                <p class="text-sm text-on-surface-variant">Silakan masuk untuk melanjutkan perjalananmu.</p>
            </div>

            <div id="notif" class="hidden mb-6 p-4 rounded-xl text-sm font-bold"></div>

            <form id="loginForm" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1" for="email">Alamat Email</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-[20px]">mail</span>
                        <input class="w-full pl-12 pr-4 py-3 bg-surface-container-low border-2 border-transparent focus:border-primary rounded-xl transition-all outline-none text-sm font-medium" id="email" name="email" placeholder="nama@email.com" type="email" required/>
                    </div>
                    <p id="emailErr" class="hidden text-[10px] text-error font-bold ml-1"></p>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center px-1">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider" for="password">Kata Sandi</label>
                        <a href="#" class="text-[10px] font-bold text-primary hover:underline">Lupa Sandi?</a>
                    </div>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-[20px]">lock</span>
                        <input class="w-full pl-12 pr-12 py-3 bg-surface-container-low border-2 border-transparent focus:border-primary rounded-xl transition-all outline-none text-sm font-medium" id="password" name="password" placeholder="••••••••" type="password" required/>
                        <button type="button" id="eyeBtn" class="absolute right-4 top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors">
                            <img id="eyeIcon" src="/assets/icons/icon_hidden.png" class="w-5 h-5 opacity-50" alt="Toggle Password"/>
                        </button>
                    </div>
                    <p id="passErr" class="hidden text-[10px] text-error font-bold ml-1"></p>
                </div>

                <button type="submit" class="w-full py-4 bg-primary text-on-primary font-bold rounded-xl tactile-button flex items-center justify-center gap-2 mt-4">
                    Masuk Sekarang
                    <span class="material-symbols-outlined">login</span>
                </button>
            </form>

            <div class="mt-10 pt-10 border-t border-surface-variant text-center">
                <p class="text-sm text-on-surface-variant">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-primary font-bold hover:underline">Daftar Gratis</a>
                </p>
            </div>
        </div>
    </div>
</main>
@endsection
