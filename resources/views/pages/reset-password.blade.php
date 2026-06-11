@extends('layouts.landing')

@section('title', 'Atur Ulang Sandi Aksaraloka')

@section('content')
<main class="min-h-screen flex items-center justify-center pt-20 pb-10 bg-surface-container-low">
    <div class="max-w-[1000px] w-full px-6 grid grid-cols-1 md:grid-cols-2 gap-0 bg-white rounded-[2.5rem] overflow-hidden shadow-2xl border border-surface-variant">
        <!-- Left Side: Branding/Image -->
        <div class="hidden md:block relative bg-primary p-12 overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <span class="material-symbols-outlined text-[400px] absolute -right-20 -bottom-20" style="font-variation-settings: 'FILL' 1;">lock_open</span>
            </div>
            <div class="relative z-10 h-full flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">auto_stories</span>
                        </div>
                        <span class="font-headline text-2xl font-bold text-white">Aksaraloka</span>
                    </div>
                    <h2 class="font-headline text-4xl text-white font-bold leading-tight mb-4">Buat Sandi yang Lebih Kuat</h2>
                    <p class="text-white/80 text-base">Pastikan kata sandi baru Anda berisi kombinasi huruf besar, angka, dan simbol untuk keamanan ekstra.</p>
                </div>
                <div class="p-6 bg-white/10 backdrop-blur rounded-2xl border border-white/20">
                    <p class="text-white text-sm italic font-medium">"Wong waspada mesthi slamet."</p>
                    <p class="text-white/60 text-[10px] mt-2 uppercase tracking-widest font-bold">— Pepatah Jawa</p>
                </div>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="p-10 md:p-16 flex flex-col justify-center">
            <div class="mb-8">
                <h1 class="font-headline text-3xl text-primary font-bold mb-2">Kata Sandi Baru</h1>
                <p class="text-sm text-on-surface-variant">Atur ulang kata sandi Anda untuk mengamankan akun.</p>
            </div>

            <div id="notif" class="hidden mb-6 p-4 rounded-xl text-sm font-bold"></div>

            <form id="resetPasswordForm" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}"/>
                <input type="hidden" name="email" value="{{ $email }}"/>

                <!-- Email Display (Read-Only) -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1" for="emailDisplay">Alamat Email</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-[20px]">mail</span>
                        <input class="w-full pl-12 pr-4 py-3 bg-surface-container-highest rounded-xl text-sm font-medium text-on-surface-variant outline-none border-2 border-transparent cursor-not-allowed" id="emailDisplay" value="{{ $email }}" type="email" readonly tabindex="-1"/>
                    </div>
                </div>

                <!-- New Password -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1" for="password">Kata Sandi Baru</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-[20px]">lock</span>
                        <input class="w-full pl-12 pr-12 py-3 bg-surface-container-low border-2 border-transparent focus:border-primary rounded-xl transition-all outline-none text-sm font-medium" id="password" name="password" placeholder="••••••••" type="password" required/>
                        <button type="button" id="eyeBtn" class="absolute right-4 top-1/2 -translate-y-1/2 text-outline">
                            <img id="eyeIcon" src="/assets/icons/icon_hidden.png" class="w-4 h-4 opacity-50" alt="View"/>
                        </button>
                    </div>
                    <p id="passErr" class="hidden text-[10px] text-error font-bold ml-1"></p>
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1" for="confirmPassword">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-[20px]">shield</span>
                        <input class="w-full pl-12 pr-12 py-3 bg-surface-container-low border-2 border-transparent focus:border-primary rounded-xl transition-all outline-none text-sm font-medium" id="confirmPassword" name="confirmPassword" placeholder="••••••••" type="password" required/>
                        <button type="button" id="eyeBtn2" class="absolute right-4 top-1/2 -translate-y-1/2 text-outline">
                            <img id="eyeIcon2" src="/assets/icons/icon_hidden.png" class="w-4 h-4 opacity-50" alt="View"/>
                        </button>
                    </div>
                    <p id="confirmErr" class="hidden text-[10px] text-error font-bold ml-1"></p>
                </div>

                <!-- Strength Indicator -->
                <div class="px-1 space-y-2">
                    <div class="flex gap-1 h-1.5">
                        <div id="bar1" class="flex-1 bg-surface-container-highest rounded-full transition-colors"></div>
                        <div id="bar2" class="flex-1 bg-surface-container-highest rounded-full transition-colors"></div>
                        <div id="bar3" class="flex-1 bg-surface-container-highest rounded-full transition-colors"></div>
                        <div id="bar4" class="flex-1 bg-surface-container-highest rounded-full transition-colors"></div>
                    </div>
                    <div class="flex justify-between items-center">
                        <p id="strengthLabel" class="hidden text-[10px] font-bold uppercase"></p>
                    </div>
                </div>

                <button type="submit" class="w-full py-4 bg-primary text-on-primary font-bold rounded-xl tactile-button flex items-center justify-center gap-2 mt-4">
                    Simpan Kata Sandi Baru
                    <span class="material-symbols-outlined">save</span>
                </button>
            </form>
        </div>
    </div>
</main>
@endsection
