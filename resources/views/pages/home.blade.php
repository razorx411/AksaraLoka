@extends('layouts.app')

@section('title', 'Beranda')
@section('subtitle', 'Selamat datang di Aksaraloka')

@section('content')
<div class="flex min-h-[calc(100vh-8rem)]">
    <!-- Main Content -->
    <section class="flex-grow flex flex-col py-10 px-6 max-w-4xl">

        <!-- Hero Greeting -->
        <div class="mb-10">
            <h2 id="greetingText" class="font-headline text-3xl font-bold text-on-surface">Selamat Datang Kembali!</h2>
            <p id="greetingTime" class="text-on-surface-variant font-medium mt-1">Memuat sapaan...</p>
        </div>

        <!-- Stats Row -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-10">
            <!-- Streak -->
            <div class="bg-surface-container-low border border-outline-variant rounded-2xl p-5 flex items-center gap-4 tactile-card shadow-sm">
                <div class="w-12 h-12 bg-error/10 rounded-xl flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-error text-2xl" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                </div>
                <div>
                    <p class="text-2xl font-headline font-bold text-on-surface">{{ $streak ?? 0 }}</p>
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Hari Beruntun</p>
                </div>
            </div>
            <!-- XP -->
            <div class="bg-surface-container-low border border-outline-variant rounded-2xl p-5 flex items-center gap-4 tactile-card shadow-sm">
                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings: 'FILL' 1;">stars</span>
                </div>
                <div>
                    <p class="text-2xl font-headline font-bold text-on-surface">{{ $totalXp ?? 0 }}</p>
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Total XP</p>
                </div>
            </div>
            <!-- Level -->
            <div class="bg-surface-container-low border border-outline-variant rounded-2xl p-5 flex items-center gap-4 tactile-card shadow-sm">
                <div class="w-12 h-12 bg-secondary/10 rounded-xl flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-secondary text-2xl" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                </div>
                <div>
                    <p class="text-2xl font-headline font-bold text-on-surface">{{ $userLevel ?? 1 }}</p>
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Level Saat Ini</p>
                </div>
            </div>
        </div>

        <!-- Section Title -->
        <div class="mb-6 flex items-center justify-between">
            <h3 class="font-headline text-xl font-bold text-on-surface">Bagian Pembelajaran</h3>
        </div>

        <!-- Chapter Cards -->
        <div class="flex flex-col gap-4">
            @forelse($chapters as $chapter)
                @php
                    $progress  = $chapterProgress[$chapter->id] ?? 0;
                    $targetUrl = route('chapter.show', $chapter->id);
                @endphp

                <div class="group relative bg-[#6B3A00] hover:bg-[#7a4200] text-white rounded-2xl overflow-hidden shadow-md tactile-button transition-all duration-200 cursor-pointer"
                     onclick="window.location='{{ $targetUrl }}'">

                    <!-- Background Watermark -->
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 opacity-10 pointer-events-none select-none">
                        <span class="material-symbols-outlined text-[90px]" style="font-variation-settings: 'FILL' 1;">history_edu</span>
                    </div>

                    <div class="relative z-10 flex items-center justify-between p-6">
                        <div class="flex-1 min-w-0">
                            <p class="text-[10px] font-bold uppercase tracking-widest opacity-70 mb-1">BAGIAN {{ $chapter->order_index }}</p>
                            <h4 class="font-headline text-xl font-bold truncate">{{ $chapter->title }}</h4>

                            <!-- Progress Bar -->
                            <div class="mt-3 h-1.5 w-full max-w-[12rem] bg-white/20 rounded-full overflow-hidden">
                                <div class="h-full bg-[#FFA726] rounded-full transition-all duration-700"
                                     style="width: {{ $progress }}%"></div>
                            </div>
                            <p class="text-[10px] font-bold mt-1 opacity-60">{{ round($progress) }}% selesai</p>
                        </div>

                        <a href="{{ $targetUrl }}"
                           class="ml-6 shrink-0 bg-white text-[#6B3A00] px-6 py-2 rounded-xl font-bold text-xs shadow hover:shadow-md active:scale-95 transition-all"
                           onclick="event.stopPropagation()">
                            MULAI
                        </a>
                    </div>
                </div>
            @empty
                <div class="bg-surface-container-low border border-dashed border-outline-variant rounded-2xl p-12 flex flex-col items-center gap-4 text-center">
                    <span class="material-symbols-outlined text-5xl text-outline" style="font-variation-settings: 'FILL' 1;">menu_book</span>
                    <p class="text-on-surface-variant font-medium text-sm">Belum ada materi tersedia.<br>Nantikan konten berikutnya!</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Right Side Panel -->
    <aside class="w-80 p-6 hidden xl:flex flex-col gap-6 sticky top-24 h-[calc(100vh-10rem)]">

        <!-- Weekly League -->
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



        <!-- Community Card -->
        <div class="rounded-2xl border-2 border-primary/20 p-6 flex flex-col gap-4 bg-white/50">
            <img alt="Komunitas Aksara Jawa"
                class="rounded-xl w-full h-24 object-cover shadow-sm"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAIyHhfuAsaSoerY2G7oFVBum8Y_zw0TJdzD8Z-wbon6lEhdCYY4npObPqL6MyN30ZICgUG04YP5O3jmQ4--TBtidRFL9pZmqWj7url-odS5xR3HLx-_vAYmjC6n-v0jhdPGSm7oifSSxvrKHL84TapXuUi0AEnGIpYfsfCdxTOk7VQA47-KoiRHDy_ymFHa8gMxip9HLw8Jw-3VgIrHJYu5i8_nMsdBYJ0bt9Prxk1DC04RKrpDcVaaP2Bs203-Oudl7xGOdu9Dqc"/>
            <div>
                <h5 class="text-sm font-bold text-on-surface">Pusat Komunitas</h5>
                <p class="text-[10px] font-medium text-on-surface-variant mt-1">Terhubung dengan 5.000+ orang lainnya yang mempelajari aksara kuno.</p>
            </div>
            <a href="https://youtube.com"
            class="block w-full py-2 bg-surface-container-high rounded-xl font-bold text-xs text-primary hover:bg-primary-container hover:text-on-primary-container transition-colors border border-surface-container-highest text-center">
            Gabung Grup
            </a>
        </div>

    </aside>
</div>

@push('scripts')
<script>
    // Dynamic greeting by time of day
    const greetingText = document.getElementById('greetingText');
    const greetingTime = document.getElementById('greetingTime');
    const hour = new Date().getHours();
    const greetings = {
        pagi:  { label: 'Selamat Pagi! 🌅',  sub: 'Mulai harimu dengan semangat belajar.' },
        siang: { label: 'Selamat Siang! ☀️', sub: 'Tetap semangat di tengah hari!' },
        sore:  { label: 'Selamat Sore! 🌤️', sub: 'Waktu yang tepat untuk review.' },
        malam: { label: 'Selamat Malam! 🌙', sub: 'Satu pelajaran sebelum istirahat?' },
    };
    const g = hour < 11 ? greetings.pagi : hour < 15 ? greetings.siang : hour < 18 ? greetings.sore : greetings.malam;
    if (greetingText) greetingText.textContent = g.label;
    if (greetingTime) greetingTime.textContent  = g.sub;


</script>
@endpush
@endsection