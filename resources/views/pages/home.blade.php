@extends('layouts.app')

@section('title', 'Alur Belajar')
@section('subtitle', 'Lanjutkan perjalananmu menguasai Aksara Jawa')

@section('content')
<div class="flex min-h-[calc(100vh-8rem)]">
    <!-- The Path (Central Column) -->
    <section class="flex-grow flex flex-col items-center py-10 relative">
        <!-- Greeting and Stats Header -->
        <div class="w-full max-w-2xl px-6 mb-12 flex flex-col gap-6">
            <div class="flex justify-between items-end">
                <div>
                    <h2 id="greetingText" class="font-headline text-3xl font-bold text-on-surface">Selamat Datang Kembali!</h2>
                    <p id="greetingTime" class="text-on-surface-variant font-medium">Memuat sapaan...</p>
                </div>
                <div class="bg-secondary-fixed text-on-secondary-fixed-variant px-4 py-1.5 rounded-full text-xs font-bold shadow-sm border border-secondary" id="level-badge">
                    Level 1
                </div>
            </div>

            <!-- XP Progress Bar -->
            <div class="bg-surface-container-lowest p-6 rounded-2xl tactile-card border border-outline-variant shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">stars</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest" id="xp-title">XP menuju Level Berikutnya</p>
                            <p class="text-xl font-headline font-bold text-on-surface" id="xp-text">0 XP</p>
                        </div>
                    </div>
                    <p class="text-xs font-bold text-primary" id="xp-label">0 / 1,200</p>
                </div>
                <div class="h-3 w-full bg-surface-container-highest rounded-full overflow-hidden">
                    <div id="xp-bar" class="h-full bg-primary rounded-full transition-all duration-1000 ease-out" style="width: 0%"></div>
                </div>
            </div>
        </div>

        @php
            $globalLevelIndex = 0;
        @endphp

        @foreach($chapters as $chapter)
            <!-- Unit Header -->
            <div class="w-full max-w-2xl px-6 mb-12 {{ !$loop->first ? 'mt-12' : '' }}">
                <div class="bg-primary text-on-primary p-8 rounded-2xl tactile-button flex justify-between items-center relative overflow-hidden shadow-lg">
                    <div class="relative z-10">
                        <p class="text-[10px] font-bold uppercase tracking-wider opacity-80 mb-1">UNIT {{ $chapter->order_index }}</p>
                        <h3 class="font-headline text-2xl font-bold">{{ $chapter->title }}</h3>
                        <p class="text-sm opacity-90">{{ $chapter->description }}</p>
                    </div>
                    <button class="bg-surface-container-lowest text-primary px-6 py-2 rounded-xl font-bold text-xs relative z-10">PANDUAN</button>
                    <div class="absolute right-[-20px] top-[-20px] opacity-10">
                        <span class="material-symbols-outlined text-[120px]" style="font-variation-settings: 'FILL' 1;">history_edu</span>
                    </div>
                </div>
            </div>

            <!-- Path Visualization -->
            <div class="flex flex-col items-center gap-12 pb-12 w-full max-w-2xl">
                @foreach($chapter->subChapters as $subChapter)
                    @foreach($subChapter->levels as $level)
                        @php
                            $status = $levelStatuses[$level->id] ?? 'locked';
                            
                            // Alternate shifts to make Duolingo-style zigzag
                            // 0 -> center, 1 -> right (translate-x-12), 2 -> center, 3 -> left (-translate-x-16)
                            $shiftClass = '';
                            if ($globalLevelIndex % 4 == 1) {
                                $shiftClass = 'translate-x-12';
                            } elseif ($globalLevelIndex % 4 == 3) {
                                $shiftClass = '-translate-x-16';
                            }
                            
                            $globalLevelIndex++;
                        @endphp

                        <!-- Node -->
                        <div class="relative group {{ $shiftClass }} flex flex-col items-center">
                            @if($status === 'completed')
                                <!-- Tooltip -->
                                <div class="absolute -top-12 left-1/2 -translate-x-1/2 bg-surface shadow-xl px-4 py-1.5 rounded-lg border-2 border-secondary whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity z-20">
                                    <span class="text-xs font-bold text-secondary">{{ $level->title }} (Selesai)</span>
                                </div>
                                <a href="{{ route('level.show', $level->id) }}" class="w-16 h-16 rounded-full bg-secondary text-on-secondary flex items-center justify-center border-b-[6px] border-[#5a4200] active:translate-y-[2px] active:border-b-[4px] transition-all shadow-md">
                                    <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">check</span>
                                </a>
                            @elseif($status === 'active')
                                <!-- Pulse effect for active level -->
                                <div class="absolute inset-[-8px] rounded-full bg-primary/20 animate-ping z-0 scale-105 pointer-events-none"></div>
                                <!-- Tooltip -->
                                <div class="absolute -top-12 left-1/2 -translate-x-1/2 bg-surface shadow-xl px-4 py-1.5 rounded-lg border-2 border-primary whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity z-20">
                                    <span class="text-xs font-bold text-primary">{{ $level->title }} (Lanjutkan)</span>
                                </div>
                                <a href="{{ route('level.show', $level->id) }}" class="relative z-10 w-20 h-20 rounded-full bg-primary text-on-primary flex items-center justify-center border-b-[6px] border-[#0a3a28] active:translate-y-[2px] active:border-b-[4px] transition-all shadow-lg hover:scale-105">
                                    <span class="material-symbols-outlined text-4xl animate-pulse" style="font-variation-settings: 'FILL' 1;">pause</span>
                                </a>
                            @else
                                <!-- Tooltip -->
                                <div class="absolute -top-12 left-1/2 -translate-x-1/2 bg-surface shadow-xl px-4 py-1.5 rounded-lg border-2 border-outline-variant whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity z-20">
                                    <span class="text-xs font-bold text-outline">Terkunci</span>
                                </div>
                                <button class="w-16 h-16 rounded-full bg-surface-variant text-outline flex items-center justify-center border-b-[6px] border-[#bfc9c1] cursor-not-allowed shadow-inner" disabled>
                                    <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">lock</span>
                                </button>
                            @endif
                        </div>

                        <!-- Vertical Line (between levels) -->
                        @if(!$loop->last || !$loop->parent->last)
                            <div class="w-4 h-12 bg-surface-container-highest rounded-full -my-4"></div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        @endforeach
    </section>

    <!-- Right Side Panel (Quests & Stats) -->
    <aside class="w-80 p-6 hidden xl:flex flex-col gap-8 sticky top-24 h-[calc(100vh-10rem)]">
        <!-- Daily Quests Widget -->
        <div class="bg-surface-container-low border-2 border-surface-variant rounded-2xl p-6 tactile-card shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h4 class="text-xs font-bold text-on-surface uppercase tracking-wider">Misi Harian</h4>
                <span class="material-symbols-outlined text-primary text-xl">event_note</span>
            </div>
            <div class="flex flex-col gap-6">
                <!-- Quest 1 -->
                <div>
                    <div class="flex justify-between text-[10px] font-bold mb-2">
                        <span class="text-on-surface-variant uppercase">XP Hari Ini</span>
                        <span class="text-primary">35/50 XP</span>
                    </div>
                    <div class="h-2.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full bg-primary rounded-full w-[70%]"></div>
                    </div>
                </div>
                <!-- Quest 2 -->
                <div>
                    <div class="flex justify-between text-[10px] font-bold mb-2">
                        <span class="text-on-surface-variant uppercase">Pelajaran</span>
                        <span class="text-primary">1/2</span>
                    </div>
                    <div class="h-2.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full bg-primary rounded-full w-1/2"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Achievement/Hero Card -->
        <div class="bg-secondary-container text-on-secondary-container rounded-2xl p-6 tactile-card relative overflow-hidden shadow-sm">
            <div class="relative z-10">
                <h4 class="text-[10px] font-bold uppercase tracking-widest mb-1 opacity-80">Liga Mingguan</h4>
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                    <span class="font-headline text-xl font-bold">Liga Perak</span>
                </div>
                <p class="text-[10px] font-bold mt-2 opacity-80">15 teratas lanjut ke Liga Emas!</p>
            </div>
            <div class="absolute right-[-10px] bottom-[-10px] opacity-20">
                <span class="material-symbols-outlined text-[80px]" style="font-variation-settings: 'FILL' 1;">trophy</span>
            </div>
        </div>

        <!-- Promotion Section -->
        <div class="rounded-2xl border-2 border-primary/20 p-6 flex flex-col gap-4 bg-white/50">
            <img alt="Community" class="rounded-xl w-full h-24 object-cover shadow-sm" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAIyHhfuAsaSoerY2G7oFVBum8Y_zw0TJdzD8Z-wbon6lEhdCYY4npObPqL6MyN30ZICgUG04YP5O3jmQ4--TBtidRFL9pZmqWj7url-odS5xR3HLx-_vAYmjC6n-v0jhdPGSm7oifSSxvrKHL84TapXuUi0AEnGIpYfsfCdxTOk7VQA47-KoiRHDy_ymFHa8gMxip9HLw8Jw-3VgIrHJYu5i8_nMsdBYJ0bt9Prxk1DC04RKrpDcVaaP2Bs203-Oudl7xGOdu9Dqc"/>
            <div>
                <h5 class="text-sm font-bold text-on-surface">Pusat Komunitas</h5>
                <p class="text-[10px] font-medium text-on-surface-variant mt-1">Terhubung dengan 5.000+ orang lainnya yang mempelajari aksara kuno.</p>
            </div>
            <button class="w-full py-2 bg-surface-container-high rounded-xl font-bold text-xs text-primary hover:bg-primary-container hover:text-on-primary-container transition-colors border border-surface-container-highest">Gabung Grup</button>
        </div>
    </aside>
</div>
@endsection
