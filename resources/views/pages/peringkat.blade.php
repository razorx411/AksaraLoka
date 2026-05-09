@extends('layouts.app')

@section('title', 'Papan Peringkat')
@section('subtitle', 'Liga Niskala — Bersaing untuk menjadi yang terbaik')

@section('content')
<main class="max-w-[1200px] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Left Column: Leaderboard -->
    <section class="lg:col-span-7 flex flex-col gap-6">
        <div class="bg-surface-container-lowest p-6 rounded-xl tactile-card border border-outline-variant shadow-sm">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h3 class="font-headline text-2xl text-primary font-bold">Liga Niskala</h3>
                    <p class="text-sm text-on-surface-variant">10 pemain teratas naik ke Liga Prana</p>
                </div>
                <div class="bg-tertiary-container text-on-tertiary-container px-4 py-1.5 rounded-full flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">schedule</span>
                    <span class="text-xs font-bold">Sisa 2h 14j</span>
                </div>
            </div>
            
            <!-- Leaderboard Table -->
            <div class="flex flex-col gap-2">
                @foreach($leaderboard as $player)
                @php
                    $isMe = (Auth::user()->nama == $player['nama']);
                @endphp
                <div class="flex items-center gap-4 p-4 rounded-xl hover:bg-surface-container-low transition-colors group {{ $isMe ? 'bg-secondary-fixed/30 border-2 border-secondary-fixed-dim border-secondary' : '' }}">
                    <span class="w-8 font-headline text-xl font-bold {{ $player['rank'] == 1 ? 'text-secondary' : ($player['rank'] == 2 ? 'text-outline' : 'text-on-surface-variant/50') }}">
                        {{ $player['rank'] }}
                    </span>
                    <div class="w-12 h-12 rounded-full overflow-hidden border-2 {{ $player['rank'] == 1 ? 'border-secondary' : 'border-outline-variant' }}">
                        <div class="w-full h-full bg-primary flex items-center justify-center text-on-primary font-bold">
                            {{ strtoupper(substr($player['nama'], 0, 1)) }}
                        </div>
                    </div>
                    <div class="flex-grow">
                        <div class="flex items-center gap-2">
                            <p class="text-sm font-bold text-on-surface">{{ $isMe ? 'Anda' : $player['nama'] }}</p>
                            @if($player['badge'])
                                <span class="text-lg">{{ $player['badge'] }}</span>
                            @endif
                        </div>
                        <p class="text-[10px] font-medium text-on-surface-variant">Level {{ $player['level'] }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-primary">{{ number_format($player['xp']) }} XP</p>
                    </div>
                </div>
                @endforeach
            </div>
            
            <button class="w-full mt-8 py-3 text-primary text-sm font-bold rounded-xl hover:bg-primary-container/10 transition-colors">
                Lihat Peringkat Lengkap
            </button>
        </div>
    </section>

    <!-- Right Column: Social -->
    <aside class="lg:col-span-5 flex flex-col gap-8">
        <!-- Find Friends Panel -->
        <div class="bg-surface-container-lowest p-6 rounded-xl tactile-card border border-outline-variant shadow-sm">
            <h3 class="font-headline text-xl text-on-surface mb-6 font-bold">Teman</h3>
            <div class="relative mb-6">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input class="w-full pl-12 pr-4 py-3 bg-surface-container-low border-2 border-transparent focus:border-primary rounded-xl transition-all outline-none text-sm font-medium" placeholder="Cari teman..." type="text"/>
            </div>
            
            <div class="flex flex-col gap-4">
                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Teman Daring</p>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="w-10 h-10 rounded-full overflow-hidden border border-outline-variant">
                            <img alt="Friend" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD5NGlLpekvislF1yCic2JH4qPiRdaBLR4uj7YEltUTlYKU15BiHvV8RSDxfWLF7wuy8Aj50Lo2awzv9I1V4_0_cdCp3v3i1o2duNYYZv6phebAYq-On2rtHsjYz4r-SOYpsnjkLZwXKWd5_zLp7tCTk0YWDO6YAyUgyd2Azatvx2WF8kSpMqq3DlsTb4pg5bA7onMj6YkOIkm1CiM9iizFtPWqHoWMg1Qv_mGXgqXrb3olZ0WLLsxLS1i4BcvurpFu9tCUctiKiUw" class="w-full h-full object-cover"/>
                        </div>
                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-tertiary rounded-full border-2 border-surface"></div>
                    </div>
                    <div class="flex-grow">
                        <p class="text-sm font-bold">Dimas_Pratama</p>
                        <p class="text-[10px] font-medium text-tertiary">Belajar Sintaksis Jawa</p>
                    </div>
                    <button class="material-symbols-outlined text-primary-container hover:scale-110 transition-transform">chat_bubble</button>
                </div>
            </div>
        </div>

        <!-- Recent Activity Feed -->
        <div class="bg-surface-container-lowest p-6 rounded-xl tactile-card border border-outline-variant shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-headline text-xl text-on-surface font-bold">Aktivitas Terkini</h3>
                <button class="material-symbols-outlined text-on-surface-variant">more_horiz</button>
            </div>
            
            <div class="flex flex-col gap-8">
                <!-- Activity Item 1 -->
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                        <img alt="Avatar" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBMJV4ksjjKD2uUzgqfT_RjCZbPr2LAFYwk4BA8bMWSdZb00_A2wFwSNLkqzDq7deqifUMUpi8tktEm8phuMbNH7ZgD4_Z0e0O21o63EY61LlibtdUjXZbI7ono9QyGbQLJNgN4XXC0JwWtkPUXmIDGdfbsKp6-V-mCheouW-hfqa4QzNfMLpEAuczBYmLwmSsy40bHoxqYmuO_VeynM6dPerxInrahKCRb14rNTGW6GCnLDXP3G4nTdvGQrBfpqdYp9ECmpDmMcI0" class="w-full h-full object-cover"/>
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-sm text-on-surface">
                            <span class="font-bold">Eko_Santoso</span> mencapai <span class="text-secondary font-bold">10 hari berturut-turut!</span> 🔥
                        </p>
                        <p class="text-[10px] font-medium text-on-surface-variant">2 jam yang lalu</p>
                        <div class="flex gap-2 mt-2">
                            <button class="flex items-center gap-2 px-4 py-1 bg-surface-container border border-outline-variant rounded-full hover:bg-primary/10 transition-colors group">
                                <span class="material-symbols-outlined text-[18px] group-hover:text-primary" style="font-variation-settings: 'FILL' 1;">favorite</span>
                                <span class="text-[10px] font-bold">12</span>
                            </button>
                            <button class="flex items-center gap-2 px-4 py-1 bg-surface-container border border-outline-variant rounded-full hover:bg-primary/10 transition-colors text-[10px] font-bold">
                                <span class="material-symbols-outlined text-[18px]">celebration</span>
                                Beri Selamat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</main>
@endsection
