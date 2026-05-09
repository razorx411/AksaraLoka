@extends('layouts.landing')

@section('title', 'Daftar Aksaraloka')

@section('content')
<main class="min-h-screen flex items-center justify-center pt-20 pb-10 bg-surface-container-low">
    <div class="max-w-[1000px] w-full px-6 grid grid-cols-1 md:grid-cols-2 gap-0 bg-white rounded-[2.5rem] overflow-hidden shadow-2xl border border-surface-variant">
        <!-- Left Side: Branding/Image -->
        <div class="hidden md:block relative bg-secondary p-12 overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <span class="material-symbols-outlined text-[400px] absolute -right-20 -bottom-20" style="font-variation-settings: 'FILL' 1;">temple_buddhist</span>
            </div>
            <div class="relative z-10 h-full flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">auto_stories</span>
                        </div>
                        <span class="font-headline text-2xl font-bold text-white">Aksaraloka</span>
                    </div>
                    <h2 class="font-headline text-4xl text-white font-bold leading-tight mb-4">Mulai Perjalanan Budayamu</h2>
                    <p class="text-white/80 text-base">Bergabunglah dengan komunitas pembelajar Aksara Jawa terbesar di Indonesia.</p>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center gap-4 p-4 bg-white/10 backdrop-blur rounded-xl border border-white/20">
                        <span class="material-symbols-outlined text-white">verified</span>
                        <p class="text-white text-xs font-bold uppercase tracking-wider">Gratis Selamanya</p>
                    </div>
                    <div class="flex items-center gap-4 p-4 bg-white/10 backdrop-blur rounded-xl border border-white/20">
                        <span class="material-symbols-outlined text-white">group</span>
                        <p class="text-white text-xs font-bold uppercase tracking-wider">50,000+ Pelajar Aktif</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="p-10 md:p-16 flex flex-col justify-center">
            <div class="mb-10">
                <h1 class="font-headline text-3xl text-primary font-bold mb-2">Buat Akun</h1>
                <p class="text-sm text-on-surface-variant">Hanya butuh 1 menit untuk bergabung.</p>
            </div>

            <div id="notif" class="hidden mb-6 p-4 rounded-xl text-sm font-bold"></div>

            <form id="registrationForm" class="space-y-4">
                @csrf
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1" for="nama">Nama Pengguna</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-[20px]">person</span>
                        <input class="w-full pl-12 pr-4 py-3 bg-surface-container-low border-2 border-transparent focus:border-primary rounded-xl transition-all outline-none text-sm font-medium" id="nama" name="nama" placeholder="Contoh: Raden Mas" type="text" required/>
                    </div>
                    <p id="namaErr" class="hidden text-[10px] text-error font-bold ml-1"></p>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1" for="email">Alamat Email</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-[20px]">mail</span>
                        <input class="w-full pl-12 pr-4 py-3 bg-surface-container-low border-2 border-transparent focus:border-primary rounded-xl transition-all outline-none text-sm font-medium" id="email" name="email" placeholder="nama@email.com" type="email" required/>
                    </div>
                    <p id="emailErr" class="hidden text-[10px] text-error font-bold ml-1"></p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1" for="password">Kata Sandi</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-[20px]">lock</span>
                            <input class="w-full pl-12 pr-12 py-3 bg-surface-container-low border-2 border-transparent focus:border-primary rounded-xl transition-all outline-none text-sm font-medium" id="password" name="password" placeholder="••••••••" type="password" required/>
                            <button type="button" id="eyeBtn" class="absolute right-4 top-1/2 -translate-y-1/2 text-outline">
                                <img id="eyeIcon" src="/assets/icons/icon_hidden.png" class="w-4 h-4 opacity-50" alt="View"/>
                            </button>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1" for="confirmPassword">Konfirmasi</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-[20px]">shield</span>
                            <input class="w-full pl-12 pr-12 py-3 bg-surface-container-low border-2 border-transparent focus:border-primary rounded-xl transition-all outline-none text-sm font-medium" id="confirmPassword" name="confirmPassword" placeholder="••••••••" type="password" required/>
                            <button type="button" id="eyeBtn2" class="absolute right-4 top-1/2 -translate-y-1/2 text-outline">
                                <img id="eyeIcon2" src="/assets/icons/icon_hidden.png" class="w-4 h-4 opacity-50" alt="View"/>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="px-1 space-y-2">
                    <div class="flex gap-1 h-1.5">
                        <div id="bar1" class="flex-1 bg-surface-container-highest rounded-full transition-colors"></div>
                        <div id="bar2" class="flex-1 bg-surface-container-highest rounded-full transition-colors"></div>
                        <div id="bar3" class="flex-1 bg-surface-container-highest rounded-full transition-colors"></div>
                        <div id="bar4" class="flex-1 bg-surface-container-highest rounded-full transition-colors"></div>
                    </div>
                    <div class="flex justify-between items-center">
                        <p id="strengthLabel" class="hidden text-[10px] font-bold uppercase"></p>
                        <div class="flex gap-2">
                            <p id="passErr" class="hidden text-[10px] text-error font-bold"></p>
                            <p id="confirmErr" class="hidden text-[10px] text-error font-bold"></p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full py-4 bg-primary text-on-primary font-bold rounded-xl tactile-button flex items-center justify-center gap-2 mt-2">
                    Buat Akun
                    <span class="material-symbols-outlined">rocket_launch</span>
                </button>
            </form>

            <div class="mt-10 pt-10 border-t border-surface-variant text-center">
                <p class="text-sm text-on-surface-variant">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</main>
@endsection
