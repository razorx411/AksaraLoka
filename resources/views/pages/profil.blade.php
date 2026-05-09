@extends('layouts.app')

@section('title', 'Profil Pengguna')
@section('subtitle', 'Kelola pencapaian dan progres belajarmu')

@section('content')
<main class="max-w-7xl mx-auto w-full flex flex-col gap-8">
    <!-- Profile Header Section -->
    <header class="flex flex-col md:flex-row items-center md:items-start gap-8 bg-surface-container-lowest p-8 rounded-xl tactile-card border border-outline-variant shadow-sm">
        <div class="relative">
            <div class="w-32 h-32 rounded-full border-4 border-secondary-container p-1 bg-surface flex items-center justify-center text-4xl font-headline font-bold text-primary" id="avatarInitial">
                {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
            </div>
            <a href="{{ route('profil.edit') }}" class="absolute bottom-1 right-1 bg-secondary-container text-on-secondary-container w-8 h-8 rounded-full flex items-center justify-center border-2 border-surface shadow-sm cursor-pointer hover:scale-110 transition-transform">
                <span class="material-symbols-outlined text-[18px]">edit</span>
            </a>
        </div>
        <div class="flex-grow text-center md:text-left">
            <div class="flex flex-col md:flex-row md:items-center gap-2 mb-1">
                <h2 id="profileName" class="font-headline text-3xl text-on-surface font-bold">{{ Auth::user()->nama }}</h2>
                <span class="bg-secondary-fixed text-on-secondary-fixed-variant px-4 py-1 rounded-full text-xs font-bold inline-block w-fit mx-auto md:mx-0">Pelajar Elit</span>
            </div>
            <p id="profileUsername" class="text-sm font-bold text-primary mb-2">@<span>{{ strtolower(str_replace(' ', '', Auth::user()->nama)) }}</span></p>
            <p class="text-base text-on-surface-variant max-w-2xl mb-4">
                {{ Auth::user()->bio ?? 'Melestarikan keanggunan Hanacaraka melalui latihan harian. Menelusuri naskah kuno untuk membuka kearifan leluhur.' }}
            </p>
            <div class="flex flex-wrap justify-center md:justify-start gap-6">
                <div class="flex items-center gap-2 text-on-surface-variant">
                    <span class="material-symbols-outlined text-primary">calendar_today</span>
                    <span class="text-sm font-semibold">Bergabung {{ Auth::user()->created_at->format('M Y') }}</span>
                </div>
                <div class="flex items-center gap-2 text-on-surface-variant">
                    <span class="material-symbols-outlined text-primary">location_on</span>
                    <span class="text-sm font-semibold">Indonesia</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Bento Grid for Stats and Skills -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Statistics Bento Cell -->
        <section class="lg:col-span-4 flex flex-col gap-6">
            <div class="bg-surface-container-lowest p-8 rounded-xl tactile-card border border-outline-variant shadow-sm flex-grow">
                <h3 class="font-headline text-xl text-on-surface mb-6 font-bold">Statistik Belajar</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-lg border-l-4 border-secondary">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-secondary text-[32px]" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                            <div>
                                <p class="text-[10px] font-bold text-on-surface-variant uppercase">Hari Beruntun</p>
                                <p class="font-headline text-xl text-on-surface font-bold">42 Hari</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-outline-variant">chevron_right</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-lg border-l-4 border-primary">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-primary text-[32px]" style="font-variation-settings: 'FILL' 1;">stars</span>
                            <div>
                                <p class="text-[10px] font-bold text-on-surface-variant uppercase">Total XP</p>
                                <p class="font-headline text-xl text-on-surface font-bold">12,450</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-outline-variant">chevron_right</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Skill Progress Bento Cell -->
        <section class="lg:col-span-8 bg-surface-container-lowest p-8 rounded-xl tactile-card border border-outline-variant shadow-sm">
            <h3 class="font-headline text-xl text-on-surface mb-8 font-bold">Kemahiran Keahlian</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @php
                    $skills = [
                        ['name' => 'Menulis', 'progress' => 80, 'icon' => 'edit_note'],
                        ['name' => 'Membaca', 'progress' => 65, 'icon' => 'menu_book'],
                        ['name' => 'Berbicara', 'progress' => 45, 'icon' => 'record_voice_over'],
                        ['name' => 'Budaya', 'progress' => 90, 'icon' => 'temple_buddhist'],
                    ];
                @endphp

                @foreach($skills as $skill)
                <div class="flex flex-col items-center gap-4">
                    <div class="relative w-24 h-24 flex items-center justify-center">
                        <svg class="w-full h-full -rotate-90">
                            <circle class="text-surface-container-high" cx="48" cy="48" fill="transparent" r="40" stroke="currentColor" stroke-width="8"></circle>
                            <circle class="text-primary" cx="48" cy="48" fill="transparent" r="40" stroke="currentColor" stroke-dasharray="251.2" stroke-dashoffset="{{ 251.2 * (1 - $skill['progress']/100) }}" stroke-width="8" stroke-linecap="round"></circle>
                        </svg>
                        <span class="absolute font-headline text-xl text-primary font-bold">{{ $skill['progress'] }}%</span>
                    </div>
                    <div class="text-center">
                        <p class="text-sm font-bold text-on-surface">{{ $skill['name'] }}</p>
                        <span class="material-symbols-outlined text-on-surface-variant text-sm">{{ $skill['icon'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>

    <!-- Achievements Gallery -->
    <section class="bg-surface-container-lowest p-8 rounded-xl tactile-card border border-outline-variant shadow-sm">
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-headline text-xl text-on-surface font-bold">Galeri Pencapaian</h3>
            <button class="text-primary text-sm font-bold flex items-center gap-1 hover:underline">
                Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </button>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-8">
            @php
                $badges = [
                    ['name' => 'Aksara Pertama', 'date' => '02/06/23', 'earned' => true, 'color' => 'secondary', 'icon' => 'workspace_premium'],
                    ['name' => '7 Hari Beruntun', 'date' => '09/06/23', 'earned' => true, 'color' => 'tertiary', 'icon' => 'hotel_class'],
                    ['name' => 'Kupu-kupu Sosial', 'date' => '15/07/23', 'earned' => true, 'color' => 'primary', 'icon' => 'diversity_3'],
                    ['name' => 'Juru Tulis Emas', 'date' => 'Terkunci', 'earned' => false, 'color' => 'outline', 'icon' => 'lock'],
                    ['name' => 'Bijak Wayang', 'date' => 'Terkunci', 'earned' => false, 'color' => 'outline', 'icon' => 'lock'],
                    ['name' => 'Pendongeng Epik', 'date' => 'Terkunci', 'earned' => false, 'color' => 'outline', 'icon' => 'lock'],
                ];
            @endphp

            @foreach($badges as $badge)
            <div class="flex flex-col items-center text-center group {{ $badge['earned'] ? '' : 'opacity-40 grayscale' }}">
                <div class="w-16 h-16 {{ $badge['earned'] ? 'bg-'.$badge['color'].'-fixed' : 'bg-surface-container' }} rounded-full flex items-center justify-center mb-3 border-2 {{ $badge['earned'] ? 'border-'.$badge['color'].'-container' : 'border-outline-variant' }} shadow-sm group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-[32px] {{ $badge['earned'] ? 'text-'.$badge['color'] : 'text-on-surface-variant' }}" style="{{ $badge['earned'] ? "font-variation-settings: 'FILL' 1;" : '' }}">
                        {{ $badge['icon'] }}
                    </span>
                </div>
                <p class="text-xs font-bold text-on-surface">{{ $badge['name'] }}</p>
                <p class="text-[10px] font-medium text-on-surface-variant">{{ $badge['date'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Current Quest Widget -->
    <section class="bg-gradient-to-r from-primary-container to-tertiary-container rounded-xl p-8 text-on-primary-container relative overflow-hidden shadow-lg">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="flex-grow">
                <span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-[10px] font-bold mb-3 inline-block">Misi Aktif</span>
                <h3 class="font-headline text-2xl text-white mb-1 font-bold">Ahli Sandhangan</h3>
                <p class="text-sm text-primary-fixed max-w-xl opacity-90">Selesaikan 5 pelajaran tentang vokal kompleks untuk mendapatkan lencana Pena Perak dan bonus 500 XP.</p>
                <div class="mt-6 w-full max-w-md h-2 bg-white/20 rounded-full overflow-hidden">
                    <div class="h-full bg-secondary-container w-[60%]"></div>
                </div>
                <p class="mt-2 text-[10px] font-bold text-white/80">3 dari 5 pelajaran selesai</p>
            </div>
            <button class="bg-surface text-primary font-bold py-3 px-8 rounded-xl tactile-button flex items-center gap-2 self-start md:self-center text-sm">
                Lanjutkan Misi
                <span class="material-symbols-outlined">play_arrow</span>
            </button>
        </div>
        <!-- Decorative background element -->
        <div class="absolute -right-12 -top-12 opacity-10">
            <span class="material-symbols-outlined text-[240px]">auto_awesome</span>
        </div>
    </section>
</main>
@endsection
