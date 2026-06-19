@extends('layouts.app')

@section('title', $chapter->title)
@section('subtitle', $chapter->description ?? 'Pilih level untuk mulai belajar')

@push('styles')
<style>
    /* ── Path trail animation ── */
    .path-trail {
        stroke-dasharray: 12 6;
        animation: trail-march 1.2s linear infinite;
    }
    @keyframes trail-march {
        to { stroke-dashoffset: -36; }
    }

    /* ── Node entrance ── */
    .node-enter {
        opacity: 0;
        transform: scale(0.5) translateY(20px);
        animation: node-pop 0.45s cubic-bezier(0.34,1.56,0.64,1) forwards;
    }
    @keyframes node-pop {
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    /* ── Active node glow pulse ── */
    .node-active-glow {
        animation: glow-pulse 2s ease-in-out infinite;
    }
    @keyframes glow-pulse {
        0%,100% { box-shadow: 0 0 0 0 rgba(107,58,0,0.3), 0 0 0 8px rgba(107,58,0,0.1); }
        50%      { box-shadow: 0 0 0 8px rgba(107,58,0,0.15), 0 0 0 16px rgba(107,58,0,0.05); }
    }

    /* ── Floating stars background ── */
    @keyframes float-up {
        0%   { transform: translateY(0) rotate(0deg); opacity: 0; }
        10%  { opacity: 0.6; }
        90%  { opacity: 0.2; }
        100% { transform: translateY(-120px) rotate(180deg); opacity: 0; }
    }
    .floaty {
        position: absolute;
        pointer-events: none;
        animation: float-up linear infinite;
        font-size: 10px;
        color: #c4933a;
        user-select: none;
    }

    /* ── Connector SVG path ── */
    .connector-svg { overflow: visible; }

    /* ── Subchapter badge slide-in ── */
    .sub-badge-enter {
        opacity: 0;
        transform: translateY(12px);
        animation: badge-in 0.4s ease forwards;
    }
    @keyframes badge-in {
        to { opacity: 1; transform: translateY(0); }
    }

    /* ── Completed checkmark draw ── */
    .check-draw {
        stroke-dasharray: 30;
        stroke-dashoffset: 30;
        animation: draw-check 0.4s ease forwards 0.1s;
    }
    @keyframes draw-check {
        to { stroke-dashoffset: 0; }
    }

    /* ── Label fade in ── */
    .label-fade {
        opacity: 0;
        animation: fade-in 0.3s ease forwards;
    }
    @keyframes fade-in {
        to { opacity: 1; }
    }

    /* ── XP reward pop ── */
    .xp-badge {
        transition: transform 0.2s cubic-bezier(0.34,1.56,0.64,1);
    }
    .xp-badge:hover { transform: scale(1.15); }
</style>
@endpush

@section('content')
<div class="flex min-h-[calc(100vh-8rem)]">

    <!-- ══ MAIN PATH COLUMN ══════════════════════════════════ -->
    <section class="flex-grow flex flex-col items-center py-10 relative overflow-hidden">

        {{-- Floating ambient particles --}}
        <div id="particles" class="absolute inset-0 pointer-events-none overflow-hidden z-0"></div>

        <!-- Chapter Hero Banner -->
        <div class="w-full max-w-xl px-6 mb-12 relative z-10">
            <div class="rounded-3xl p-7 relative overflow-hidden shadow-xl"
                 style="background: linear-gradient(135deg,#6B3A00 0%,#8B5200 60%,#A06820 100%);">

                {{-- Animated background texture --}}
                <div class="absolute inset-0 opacity-5" style="background-image: repeating-linear-gradient(45deg,#fff 0,#fff 1px,transparent 0,transparent 50%); background-size: 12px 12px;"></div>

                <div class="relative z-10">
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-white/70 hover:text-white transition-colors mb-4 bg-white/10 hover:bg-white/20 px-3 py-1.5 rounded-full">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        Kembali
                    </a>

                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-widest text-white/50 mb-0.5">UNIT {{ $chapter->order_index }}</p>
                            <h2 class="font-headline text-2xl font-bold text-white leading-tight">{{ $chapter->title }}</h2>
                            @if($chapter->description)
                                <p class="text-xs text-white/60 mt-1.5 leading-relaxed">{{ $chapter->description }}</p>
                            @endif
                        </div>
                        {{-- Circular progress --}}
                        <div class="shrink-0 relative w-16 h-16">
                            <svg viewBox="0 0 64 64" class="w-full h-full -rotate-90">
                                <circle cx="32" cy="32" r="26" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="5"/>
                                <circle cx="32" cy="32" r="26" fill="none" stroke="#FFA726" stroke-width="5"
                                        stroke-linecap="round"
                                        stroke-dasharray="{{ round(163.36 * ($totalCount > 0 ? $completedCount / $totalCount : 0)) }} 163.36"/>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-white font-bold text-sm leading-none">{{ $totalCount > 0 ? round(($completedCount / $totalCount) * 100) : 0 }}%</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 mt-5 pt-4 border-t border-white/10">
                        <div class="flex items-center gap-1.5 text-white/70">
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1;">check_circle</span>
                            <span class="text-xs font-bold">{{ $completedCount }}/{{ $totalCount }} selesai</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-[#FFA726]">
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1;">stars</span>
                            <span class="text-xs font-bold">{{ $totalXpAvailable }} XP tersedia</span>
                        </div>
                    </div>
                </div>

                <div class="absolute right-[-20px] bottom-[-20px] opacity-[0.07] pointer-events-none">
                    <span class="material-symbols-outlined text-[160px] text-white" style="font-variation-settings:'FILL' 1;">history_edu</span>
                </div>
            </div>
        </div>

        {{-- ════ PATH ════ --}}
        @php $globalLevelIndex = 0; @endphp

        @foreach($chapter->subChapters as $subChapter)

            {{-- SubChapter Header --}}
            <div class="w-full max-w-xl px-6 mb-8 relative z-10 sub-badge-enter"
                 style="animation-delay: {{ $loop->index * 0.08 }}s">
                <div class="flex items-center gap-3">
                    <div class="h-px flex-1 bg-outline-variant/60"></div>
                    <div class="flex items-center gap-2 bg-surface-container border border-outline-variant rounded-full px-4 py-1.5 shadow-sm">
                        <div class="w-5 h-5 rounded-full bg-[#6B3A00]/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[#6B3A00]" style="font-size:13px;font-variation-settings:'FILL' 1;">folder_open</span>
                        </div>
                        <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">
                            Bagian {{ $loop->index + 1 }}
                        </span>
                        <span class="text-[10px] font-bold text-on-surface">· {{ $subChapter->title }}</span>
                    </div>
                    <div class="h-px flex-1 bg-outline-variant/60"></div>
                </div>
            </div>

            {{-- Level Nodes --}}
            <div class="flex flex-col items-center w-full max-w-xl relative z-10">
                @foreach($subChapter->levels as $level)
                    @php
                        $status = $levelStatuses[$level->id] ?? 'locked';
                        $shiftClass = '';
                        if ($globalLevelIndex % 4 == 1)     $shiftClass = 'md:translate-x-20 translate-x-8';
                        elseif ($globalLevelIndex % 4 == 3) $shiftClass = 'md:-translate-x-20 -translate-x-8';
                        $delay = ($globalLevelIndex * 0.07) . 's';
                        $globalLevelIndex++;
                    @endphp

                    <div class="flex flex-col items-center">
                        {{-- Node --}}
                        <div class="node-enter {{ $shiftClass }} flex flex-col items-center group"
                             style="animation-delay: {{ $delay }}">

                            @if($status === 'completed')
                                {{-- COMPLETED NODE --}}
                                <div class="relative">
                                    {{-- Tooltip --}}
                                    <div class="absolute -top-12 left-1/2 -translate-x-1/2 bg-surface border-2 border-[#8B6914] shadow-lg px-3 py-1.5 rounded-xl whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-200 z-30 pointer-events-none">
                                        <p class="text-[11px] font-bold text-[#8B6914]">{{ $level->title }}</p>
                                        <div class="absolute left-1/2 -translate-x-1/2 top-full w-0 h-0 border-l-[5px] border-r-[5px] border-t-[5px] border-transparent border-t-[#8B6914]"></div>
                                    </div>
                                    <a href="{{ route('level.show', $level->id) }}"
                                       class="w-14 h-14 rounded-full flex items-center justify-center border-b-4 active:translate-y-0.5 active:border-b-2 transition-all duration-150 hover:scale-110 shadow-md"
                                       style="background:#8B6914; border-bottom-color:#5a4000;">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                            <path class="check-draw" d="M5 13l4 4L19 7" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                    {{-- XP badge --}}
                                    <div class="xp-badge absolute -right-1 -top-1 bg-[#FFA726] text-[8px] font-bold text-[#5a2e00] px-1.5 py-0.5 rounded-full shadow-sm">
                                        +{{ $level->xp_reward ?? 10 }}
                                    </div>
                                </div>

                            @elseif($status === 'active')
                                {{-- ACTIVE NODE --}}
                                <div class="relative">
                                    {{-- Outer pulse rings --}}
                                    <div class="absolute -inset-3 rounded-full bg-[#6B3A00]/8 animate-ping pointer-events-none"></div>
                                    <div class="absolute -inset-1.5 rounded-full bg-[#6B3A00]/12 animate-pulse pointer-events-none"></div>
                                    {{-- Tooltip --}}
                                    <div class="absolute -top-14 left-1/2 -translate-x-1/2 bg-surface border-2 border-[#6B3A00] shadow-lg px-3 py-1.5 rounded-xl whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-200 z-30 pointer-events-none">
                                        <p class="text-[11px] font-bold text-[#6B3A00]">{{ $level->title }}</p>
                                        <p class="text-[9px] text-on-surface-variant mt-0.5">Klik untuk mulai!</p>
                                        <div class="absolute left-1/2 -translate-x-1/2 top-full w-0 h-0 border-l-[5px] border-r-[5px] border-t-[5px] border-transparent border-t-[#6B3A00]"></div>
                                    </div>
                                    <a href="{{ route('level.show', $level->id) }}"
                                       class="node-active-glow relative z-10 w-20 h-20 rounded-full flex items-center justify-center border-b-[6px] active:translate-y-0.5 active:border-b-[3px] transition-all duration-150 hover:scale-110 shadow-xl"
                                       style="background:#6B3A00; border-bottom-color:#3d1f00;">
                                        <span class="material-symbols-outlined text-white text-4xl" style="font-variation-settings:'FILL' 1;">play_arrow</span>
                                    </a>
                                    {{-- XP badge --}}
                                    <div class="xp-badge absolute -right-1 -top-1 bg-[#FFA726] text-[8px] font-bold text-[#5a2e00] px-1.5 py-0.5 rounded-full shadow-sm">
                                        +{{ $level->xp_reward ?? 10 }}
                                    </div>
                                </div>

                            @else
                                {{-- LOCKED NODE --}}
                                <div class="relative">
                                    {{-- Tooltip --}}
                                    <div class="absolute -top-12 left-1/2 -translate-x-1/2 bg-surface border border-outline-variant shadow-md px-3 py-1.5 rounded-xl whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-200 z-30 pointer-events-none">
                                        <p class="text-[11px] font-bold text-outline">Terkunci</p>
                                        <div class="absolute left-1/2 -translate-x-1/2 top-full w-0 h-0 border-l-[5px] border-r-[5px] border-t-[5px] border-transparent border-t-outline-variant"></div>
                                    </div>
                                    <button disabled
                                       class="w-14 h-14 rounded-full flex items-center justify-center border-b-4 cursor-not-allowed shadow-inner opacity-60"
                                       style="background: var(--md-sys-color-surface-container, #e8e8e8); border-bottom-color: rgba(0,0,0,0.1);">
                                        <span class="material-symbols-outlined text-2xl text-outline" style="font-variation-settings:'FILL' 1;">lock</span>
                                    </button>
                                </div>
                            @endif

                            {{-- Level label --}}
                            <p class="label-fade mt-2 text-[10px] font-bold text-center max-w-[80px] leading-snug"
                               style="animation-delay: {{ $delay }}; color: {{ $status === 'active' ? '#6B3A00' : ($status === 'completed' ? 'var(--md-sys-color-on-surface-variant,#666)' : 'var(--md-sys-color-outline,#999)') }}">
                                {{ $level->title }}
                            </p>
                        </div>

                        {{-- Animated connector --}}
                        @if(!$loop->last)
                            <div class="relative my-0.5" style="height:44px; width: 20px;">
                                <svg class="connector-svg w-full h-full" viewBox="0 0 20 44" preserveAspectRatio="none">
                                    @if($status === 'completed')
                                        <line x1="10" y1="0" x2="10" y2="44"
                                              stroke="#8B6914" stroke-width="3" stroke-linecap="round"
                                              class="path-trail" opacity="0.6"/>
                                    @elseif($status === 'active')
                                        <line x1="10" y1="0" x2="10" y2="44"
                                              stroke="#6B3A00" stroke-width="3" stroke-linecap="round"
                                              class="path-trail" opacity="0.8"/>
                                    @else
                                        <line x1="10" y1="0" x2="10" y2="44"
                                              stroke="#ccc" stroke-width="2.5" stroke-linecap="round"
                                              stroke-dasharray="4 4" opacity="0.5"/>
                                    @endif
                                </svg>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- Between subchapter spacer --}}
            @if(!$loop->last)
                <div class="relative z-10 my-2" style="height:32px; width:20px;">
                    <svg class="w-full h-full" viewBox="0 0 20 32">
                        <line x1="10" y1="0" x2="10" y2="32" stroke="#ccc" stroke-width="2" stroke-dasharray="3 4" opacity="0.4"/>
                    </svg>
                </div>
            @endif
        @endforeach

        <div class="h-20"></div>
    </section>

    <!-- ══ RIGHT SIDEBAR ═══════════════════════════════════════ -->
    <aside class="w-80 p-6 hidden xl:flex flex-col gap-5 sticky top-24 h-[calc(100vh-10rem)]">

        <!-- Stats Card -->
        <div class="bg-surface-container-low border-2 border-surface-variant rounded-2xl p-5 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-xs font-bold text-on-surface uppercase tracking-wider">Statistik</h4>
                <span class="material-symbols-outlined text-[#6B3A00] text-lg" style="font-variation-settings:'FILL' 1;">bar_chart</span>
            </div>

            {{-- Circular progress big --}}
            <div class="flex items-center gap-4 mb-4 pb-4 border-b border-outline-variant/50">
                <div class="relative w-16 h-16 shrink-0">
                    <svg viewBox="0 0 64 64" class="w-full h-full -rotate-90">
                        <circle cx="32" cy="32" r="26" fill="none" stroke="var(--md-sys-color-surface-container-highest,#e0e0e0)" stroke-width="6"/>
                        <circle cx="32" cy="32" r="26" fill="none" stroke="#6B3A00" stroke-width="6"
                                stroke-linecap="round"
                                stroke-dasharray="{{ round(163.36 * ($totalCount > 0 ? $completedCount / $totalCount : 0)) }} 163.36"
                                style="transition: stroke-dasharray 1s ease;"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-sm font-bold text-[#6B3A00]">{{ $totalCount > 0 ? round(($completedCount / $totalCount) * 100) : 0 }}%</span>
                    </div>
                </div>
                <div>
                    <p class="text-xs text-on-surface-variant font-medium">Progress bagian ini</p>
                    <p class="text-base font-bold text-on-surface mt-0.5">{{ $completedCount }} dari {{ $totalCount }} level</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div class="bg-surface-container rounded-xl p-3 text-center">
                    <p class="text-xl font-bold text-[#8B6914]">{{ $completedCount }}</p>
                    <p class="text-[9px] font-bold text-on-surface-variant uppercase tracking-wider mt-0.5">Selesai</p>
                </div>
                <div class="bg-surface-container rounded-xl p-3 text-center">
                    <p class="text-xl font-bold text-[#6B3A00]">{{ $totalCount - $completedCount }}</p>
                    <p class="text-[9px] font-bold text-on-surface-variant uppercase tracking-wider mt-0.5">Tersisa</p>
                </div>
                <div class="col-span-2 bg-[#6B3A00]/8 rounded-xl p-3 flex items-center justify-between">
                    <span class="text-[10px] font-bold text-on-surface-variant flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[#FFA726] text-sm" style="font-variation-settings:'FILL' 1;">stars</span>
                        XP Tersedia
                    </span>
                    <span class="text-sm font-bold text-[#6B3A00]">{{ $totalXpAvailable }} XP</span>
                </div>
            </div>
        </div>

        <!-- Legend -->
        <div class="bg-surface-container-low border-2 border-surface-variant rounded-2xl p-5 shadow-sm">
            <h4 class="text-xs font-bold text-on-surface uppercase tracking-wider mb-4">Keterangan</h4>
            <div class="flex flex-col gap-3.5">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center shrink-0 shadow-md" style="background:#6B3A00;">
                        <span class="material-symbols-outlined text-white text-base" style="font-variation-settings:'FILL' 1;">play_arrow</span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-on-surface">Aktif</p>
                        <p class="text-[10px] text-on-surface-variant leading-tight">Bisa dikerjakan sekarang</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center shrink-0 shadow-md" style="background:#8B6914;">
                        <span class="material-symbols-outlined text-white text-base" style="font-variation-settings:'FILL' 1;">check</span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-on-surface">Selesai</p>
                        <p class="text-[10px] text-on-surface-variant leading-tight">Sudah berhasil diselesaikan</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center shrink-0 border border-outline-variant" style="background:var(--md-sys-color-surface-container,#f0f0f0);">
                        <span class="material-symbols-outlined text-outline text-base" style="font-variation-settings:'FILL' 1;">lock</span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-on-surface-variant">Terkunci</p>
                        <p class="text-[10px] text-on-surface-variant leading-tight">Selesaikan level sebelumnya</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liga -->
        <div class="bg-secondary-container text-on-secondary-container rounded-2xl p-5 relative overflow-hidden shadow-sm">
            <div class="relative z-10">
                <h4 class="text-[10px] font-bold uppercase tracking-widest mb-1 opacity-80">Liga Mingguan</h4>
                <div class="flex items-center gap-2 mt-1">
                    <span class="material-symbols-outlined text-2xl" style="font-variation-settings:'FILL' 1;">workspace_premium</span>
                    <span class="font-headline text-lg font-bold">Liga Perak</span>
                </div>
                <p class="text-[10px] font-bold mt-1.5 opacity-70">15 teratas lanjut ke Liga Emas!</p>
            </div>
            <div class="absolute right-[-8px] bottom-[-8px] opacity-20 pointer-events-none">
                <span class="material-symbols-outlined text-[72px]" style="font-variation-settings:'FILL' 1;">trophy</span>
            </div>
        </div>
    </aside>
</div>

@push('scripts')
<script>
    // ── Floating ambient particles ──────────────────────────────
    (function() {
        const container = document.getElementById('particles');
        if (!container) return;
        const symbols = ['✦','✧','⋆','·','★','◆'];
        for (let i = 0; i < 18; i++) {
            const el = document.createElement('span');
            el.className = 'floaty';
            el.textContent = symbols[i % symbols.length];
            el.style.cssText = `
                left: ${Math.random() * 100}%;
                top: ${20 + Math.random() * 70}%;
                animation-duration: ${4 + Math.random() * 5}s;
                animation-delay: ${Math.random() * 6}s;
                font-size: ${7 + Math.random() * 8}px;
                opacity: 0;
            `;
            container.appendChild(el);
        }
    })();

    // ── Intersection observer for node entrance ─────────────────
    const nodes = document.querySelectorAll('.node-enter');
    if ('IntersectionObserver' in window) {
        const obs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.style.animationPlayState = 'running';
                }
            });
        }, { threshold: 0.2 });
        nodes.forEach(n => {
            n.style.animationPlayState = 'paused';
            obs.observe(n);
        });
    }
</script>
@endpush
@endsection
