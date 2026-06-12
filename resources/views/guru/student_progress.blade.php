@extends('layouts.app')

@section('title', 'Progres Belajar')
@section('subtitle', 'Laporan alur belajar detail siswa')

@section('content')
<div class="flex flex-col py-6 max-w-5xl mx-auto px-4 md:px-0">

    {{-- Back Link --}}
    <div class="mb-6">
        <a href="{{ route('guru.classrooms.show', $classroom->id) }}" class="inline-flex items-center gap-2 text-primary hover:text-primary-container font-bold text-sm">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Kembali ke Detail Kelas
        </a>
    </div>

    {{-- Student Info Header Card --}}
    <div class="bg-surface-container-low border border-outline-variant rounded-[2rem] p-6 flex flex-col md:flex-row md:items-center justify-between gap-6 shadow-sm tactile-card mb-10">
        <div class="flex items-center gap-4">
            @if($student->avatar_url)
                <img src="{{ $student->avatar_url }}" alt="Avatar" class="w-16 h-16 rounded-2xl object-cover border-2 border-primary-container shadow-sm" />
            @else
                <div class="w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center text-primary font-headline font-bold text-3xl shadow-sm">
                    {{ strtoupper(substr($student->username, 0, 1)) }}
                </div>
            @endif
            <div>
                <h2 class="font-headline text-2xl font-bold text-on-surface leading-tight">{{ $student->username }}</h2>
                <p class="text-xs text-on-surface-variant font-medium">{{ $student->email }}</p>
                <div class="flex items-center gap-2 mt-1.5">
                    <span class="bg-secondary-container/40 text-secondary border border-secondary/20 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">
                        Level {{ $student->getUserLevel() }}
                    </span>
                    <span class="bg-tertiary-container/30 text-tertiary border border-tertiary/20 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">
                        {{ number_format($student->total_points) }} XP
                    </span>
                </div>
            </div>
        </div>

        <div class="text-left md:text-right">
            <span class="text-[9px] font-bold text-on-surface-variant uppercase tracking-wider block">Kategori Kelas</span>
            <span class="text-lg font-headline font-bold text-primary block">{{ $classroom->name }}</span>
            <span class="text-[10px] text-on-surface-variant font-medium">Joined: {{ $student->pivot->joined_at ? date('d M Y', strtotime($student->pivot->joined_at)) : 'N/A' }}</span>
        </div>
    </div>

    {{-- Chapters Loop --}}
    <h3 class="font-headline text-xl font-bold text-on-surface mb-6">Detail Progress Alur Belajar</h3>

    <div class="space-y-8">
        @forelse($chapters as $chapter)
            <div class="bg-surface-container-low border border-outline-variant rounded-[2rem] overflow-hidden shadow-sm tactile-card">
                
                {{-- Chapter Title Bar --}}
                <div class="bg-surface-container-high/60 border-b border-outline-variant px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div>
                        <span class="text-[9px] font-bold text-primary uppercase tracking-wider">BAGIAN {{ $chapter->order_index }}</span>
                        <h4 class="font-headline text-lg font-bold text-on-surface leading-tight">{{ $chapter->title }}</h4>
                    </div>
                    @php
                        // Hitung progress chapter untuk siswa ini
                        $totalLvl = 0;
                        $compLvl = 0;
                        foreach($chapter->subChapters as $sub) {
                            foreach($sub->levels as $lvl) {
                                $totalLvl++;
                                if (isset($progress[$lvl->id])) $compLvl++;
                            }
                        }
                        $pct = $totalLvl > 0 ? round(($compLvl / $totalLvl) * 100) : 0;
                    @endphp
                    <div class="flex items-center gap-3 shrink-0">
                        <span class="text-xs font-bold text-on-surface-variant">{{ $compLvl }} / {{ $totalLvl }} Level Selesai</span>
                        <span class="text-xs font-bold bg-primary-container/20 text-primary border border-primary/20 px-2.5 py-0.5 rounded-full">{{ $pct }}%</span>
                    </div>
                </div>

                {{-- Subchapters and Levels --}}
                <div class="p-6 space-y-6">
                    @forelse($chapter->subChapters as $subChapter)
                        <div class="space-y-3">
                            <h5 class="text-xs font-bold text-on-surface-variant uppercase tracking-wider flex items-center gap-2">
                                <span class="material-symbols-outlined text-base">subdirectory_arrow_right</span>
                                {{ $subChapter->title }}
                            </h5>
                            
                            {{-- Levels Grid --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 pl-6">
                                @forelse($subChapter->levels as $level)
                                    @php
                                        $isCompleted = isset($progress[$level->id]);
                                    @endphp
                                    <div class="flex items-center justify-between p-4 rounded-2xl border transition-all {{ $isCompleted ? 'bg-green-50/30 border-green-500/20' : 'bg-surface-container-low border-outline-variant/50' }}">
                                        <div class="flex items-center gap-3 min-w-0">
                                            @if($isCompleted)
                                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center shrink-0">
                                                    <span class="material-symbols-outlined text-green-700 text-lg font-extrabold">check</span>
                                                </div>
                                            @else
                                                <div class="w-8 h-8 rounded-full bg-surface-container-highest flex items-center justify-center shrink-0">
                                                    <span class="material-symbols-outlined text-on-surface-variant/40 text-lg">lock</span>
                                                </div>
                                            @endif
                                            <div class="min-w-0">
                                                <p class="font-bold text-sm text-on-surface truncate leading-tight">{{ $level->title }}</p>
                                                <span class="text-[9px] font-bold text-on-surface-variant/75 uppercase tracking-wider">{{ $level->xp_reward ?? 50 }} XP</span>
                                            </div>
                                        </div>

                                        <div class="text-right shrink-0">
                                            @if($isCompleted)
                                                <span class="text-[10px] font-bold text-green-700 block">SELESAI</span>
                                                <span class="text-[9px] text-on-surface-variant/60 font-medium">
                                                    {{ date('d/m/Y H:i', strtotime($progress[$level->id])) }}
                                                </span>
                                            @else
                                                <span class="text-[10px] font-bold text-on-surface-variant/40 block">BELUM SELESAI</span>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-xs text-on-surface-variant/60 italic pl-2">Tidak ada level di sub-bab ini.</p>
                                @endforelse
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-on-surface-variant/60 italic">Tidak ada sub-bab di bab ini.</p>
                    @endforelse
                </div>
            </div>
        @empty
            <div class="bg-surface-container-low border border-dashed border-outline-variant rounded-2xl p-12 text-center text-on-surface-variant text-sm font-medium">
                Belum ada bab alur belajar yang didefinisikan.
            </div>
        @endforelse
    </div>
</div>
@endsection
