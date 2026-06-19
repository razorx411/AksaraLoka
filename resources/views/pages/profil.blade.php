@extends('layouts.app')

@section('title', 'Profil Pengguna')
@section('subtitle', 'Kelola pencapaian dan progres belajarmu')

@section('content')
<main class="max-w-7xl mx-auto w-full flex flex-col gap-8">

    {{-- ── Profile Header ────────────────────────────────────────── --}}
    <header class="flex flex-col md:flex-row items-center md:items-start gap-8 bg-surface-container-lowest p-8 rounded-xl tactile-card border border-outline-variant shadow-sm">
        <div class="relative shrink-0">
            @if(Auth::user()->avatar_url)
                <img src="{{ Auth::user()->avatar_url }}"
                     alt="Foto Profil"
                     class="w-32 h-32 rounded-full object-cover border-4 border-secondary-container" />
            @else
                <div class="w-32 h-32 rounded-full border-4 border-secondary-container p-1 bg-surface flex items-center justify-center text-4xl font-headline font-bold text-primary">
                    {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                </div>
            @endif
            <a href="{{ route('profil.edit') }}"
               class="absolute bottom-1 right-1 bg-secondary-container text-on-secondary-container w-8 h-8 rounded-full flex items-center justify-center border-2 border-surface shadow-sm cursor-pointer hover:scale-110 transition-transform">
                <span class="material-symbols-outlined text-[18px]">edit</span>
            </a>
        </div>

        <div class="flex-grow text-center md:text-left">
            <div class="flex flex-col md:flex-row md:items-center gap-2 mb-1">
                <h2 class="font-headline text-3xl text-on-surface font-bold">{{ Auth::user()->nama }}</h2>
                <span class="bg-secondary-fixed text-on-secondary-fixed-variant px-4 py-1 rounded-full text-xs font-bold inline-block w-fit mx-auto md:mx-0">Level {{ Auth::user()->getUserLevel() }}</span>
            </div>
            <p class="text-sm font-bold text-primary mb-2">@<span>{{ strtolower(str_replace(' ', '', Auth::user()->nama)) }}</span></p>
            <p class="text-base text-on-surface-variant max-w-2xl mb-4">
                {{ Auth::user()->bio ?? 'Melestarikan keanggunan Hanacaraka melalui latihan harian.' }}
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

    {{-- ── Stats + Skill Progress ────────────────────────────────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- Statistics --}}
        <section class="lg:col-span-4 flex flex-col gap-6">
            <div class="bg-surface-container-lowest p-8 rounded-xl tactile-card border border-outline-variant shadow-sm flex-grow">
                <h3 class="font-headline text-xl text-on-surface mb-6 font-bold">Statistik Belajar</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-lg border-l-4 border-secondary">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-secondary text-[32px]" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                            <div>
                                <p class="text-[10px] font-bold text-on-surface-variant uppercase">Hari Beruntun</p>
                                <p class="font-headline text-xl text-on-surface font-bold">{{ Auth::user()->streak_count ?? 0 }} Hari</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-outline-variant">chevron_right</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-lg border-l-4 border-primary">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-primary text-[32px]" style="font-variation-settings: 'FILL' 1;">stars</span>
                            <div>
                                <p class="text-[10px] font-bold text-on-surface-variant uppercase">Total XP</p>
                                <p class="font-headline text-xl text-on-surface font-bold">{{ number_format(Auth::user()->total_points ?? 0) }}</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-outline-variant">chevron_right</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-lg border-l-4 border-tertiary">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-tertiary text-[32px]" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                            <div>
                                <p class="text-[10px] font-bold text-on-surface-variant uppercase">Level Saat Ini</p>
                                <p class="font-headline text-xl text-on-surface font-bold">{{ Auth::user()->getUserLevel() }}</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-outline-variant">chevron_right</span>
                    </div>
                </div>
            </div>
        </section>

        {{-- Skill Progress (dynamic from chapter completion) --}}
        <section class="lg:col-span-8 bg-surface-container-lowest p-8 rounded-xl tactile-card border border-outline-variant shadow-sm">
            <div class="flex items-start justify-between mb-2">
                <h3 class="font-headline text-xl text-on-surface font-bold">Kemahiran Keahlian</h3>
            </div>
            <p class="text-xs text-on-surface-variant mb-8">
                Membaca: rata-rata penyelesaian semua chapter ÷ jumlah chapter
            </p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($skills as $skill)
                <div class="flex flex-col items-center gap-4 relative">

                    @if($skill['coming_soon'])
                    {{-- Coming Soon card --}}
                    <div class="relative w-24 h-24 flex items-center justify-center opacity-35">
                        <svg class="w-full h-full -rotate-90">
                            <circle class="text-surface-container-high" cx="48" cy="48" fill="transparent" r="40"
                                    stroke="currentColor" stroke-width="8"></circle>
                        </svg>
                        <span class="absolute font-headline text-sm text-on-surface-variant font-bold">0%</span>
                    </div>
                    <div class="text-center">
                        <p class="text-sm font-bold text-on-surface-variant">{{ $skill['name'] }}</p>
                        <span class="material-symbols-outlined text-on-surface-variant text-sm opacity-50">{{ $skill['icon'] }}</span>
                        <div class="mt-1">
                            <span class="inline-block text-[9px] font-bold bg-surface-container text-on-surface-variant px-2 py-0.5 rounded-full border border-outline-variant">
                                Coming Soon
                            </span>
                        </div>
                    </div>

                    @else
                    {{-- Membaca — real data --}}
                    <div class="relative w-24 h-24 flex items-center justify-center">
                        <svg class="w-full h-full -rotate-90">
                            <circle class="text-surface-container-high" cx="48" cy="48" fill="transparent" r="40"
                                    stroke="currentColor" stroke-width="8"></circle>
                            <circle class="text-primary skill-ring" cx="48" cy="48" fill="transparent" r="40"
                                    stroke="currentColor"
                                    stroke-dasharray="251.2"
                                    stroke-dashoffset="{{ 251.2 }}"
                                    data-offset="{{ 251.2 * (1 - $skill['progress'] / 100) }}"
                                    stroke-width="8" stroke-linecap="round"
                                    style="transition: stroke-dashoffset 1s ease-out;"></circle>
                        </svg>
                        <span class="absolute font-headline text-xl text-primary font-bold">{{ $skill['progress'] }}%</span>
                    </div>
                    <div class="text-center">
                        <p class="text-sm font-bold text-on-surface">{{ $skill['name'] }}</p>
                        <span class="material-symbols-outlined text-on-surface-variant text-sm">{{ $skill['icon'] }}</span>
                    </div>
                    @endif

                </div>
                @endforeach
            </div>
        </section>

    </div>

    {{-- ── Achievements Gallery (Dynamic) ───────────────────────── --}}
    <section class="bg-surface-container-lowest p-8 rounded-xl tactile-card border border-outline-variant shadow-sm">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h3 class="font-headline text-xl text-on-surface font-bold">Galeri Pencapaian</h3>
                <p class="text-xs text-on-surface-variant mt-1">
                    {{ $achievements->where('earned', true)->count() }} dari {{ $achievements->count() }} diraih
                </p>
            </div>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($achievements as $badge)
            @php
                $colors = [
                    'primary'   => ['bg' => 'bg-primary-container',   'text' => 'text-primary',   'border' => 'border-primary-container'],
                    'secondary' => ['bg' => 'bg-secondary-container', 'text' => 'text-secondary', 'border' => 'border-secondary-container'],
                    'tertiary'  => ['bg' => 'bg-tertiary-container',  'text' => 'text-tertiary',  'border' => 'border-tertiary-container'],
                ];
                $c = $colors[$badge['color']] ?? $colors['primary'];
            @endphp
            <div class="flex flex-col items-center text-center group {{ $badge['earned'] ? '' : 'opacity-40 grayscale' }}"
                 title="{{ $badge['description'] }}">
                <div class="w-16 h-16 {{ $badge['earned'] ? $c['bg'] : 'bg-surface-container' }} rounded-full flex items-center justify-center mb-3 border-2 {{ $badge['earned'] ? $c['border'] : 'border-outline-variant' }} shadow-sm group-hover:scale-110 transition-transform relative">
                    <span class="material-symbols-outlined text-[28px] {{ $badge['earned'] ? $c['text'] : 'text-on-surface-variant' }}"
                          style="{{ $badge['earned'] ? "font-variation-settings: 'FILL' 1;" : '' }}">
                        {{ $badge['earned'] ? $badge['icon'] : 'lock' }}
                    </span>
                    @if($badge['earned'])
                    <span class="absolute -top-1 -right-1 w-5 h-5 bg-primary rounded-full flex items-center justify-center border-2 border-surface">
                        <span class="material-symbols-outlined text-on-primary text-[12px]" style="font-variation-settings: 'FILL' 1;">check</span>
                    </span>
                    @endif
                </div>
                <p class="text-xs font-bold text-on-surface leading-tight">{{ $badge['name'] }}</p>
                <p class="text-[10px] font-medium {{ $badge['earned'] ? 'text-primary' : 'text-on-surface-variant' }} mt-0.5">
                    {{ $badge['earned'] ? '✓ '.$badge['date'] : $badge['description'] }}
                </p>
            </div>
            @endforeach
        </div>
    </section>

</main>

@push('scripts')
<script>
// Animate skill rings on load
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        document.querySelectorAll('.skill-ring').forEach(ring => {
            const target = ring.dataset.offset;
            ring.style.strokeDashoffset = target;
        });
    }, 200);
});
</script>
@endpush

@endsection
