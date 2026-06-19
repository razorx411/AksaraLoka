@extends('layouts.app')

@section('title', 'Detail Kelas')
@section('subtitle', 'Pantau perkembangan belajar siswa di kelas Anda')

@section('content')
<div class="flex flex-col py-6 max-w-5xl mx-auto px-4 md:px-0">

    {{-- Breadcrumb / Back Navigation --}}
    <div class="mb-6">
        <a href="{{ route('guru.dashboard') }}" class="inline-flex items-center gap-2 text-primary hover:text-primary-container font-bold text-sm">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Kembali ke Dashboard
        </a>
    </div>

    {{-- Class Header Card --}}
    <div class="bg-surface-container-low border border-outline-variant rounded-[2rem] p-6 md:p-8 tactile-card shadow-sm mb-10 relative overflow-hidden">
        {{-- Background watermark --}}
        <div class="absolute right-6 top-1/2 -translate-y-1/2 opacity-5 pointer-events-none select-none">
            <span class="material-symbols-outlined text-[150px]">groups</span>
        </div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
            <div class="flex-1 min-w-0">
                <span class="bg-primary-container/15 text-primary border border-primary/25 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-2 inline-block">
                    Informasi Kelas
                </span>
                <h2 class="font-headline text-3xl font-bold text-on-surface mb-2 truncate">{{ $classroom->name }}</h2>
                <p class="text-sm text-on-surface-variant max-w-xl">
                    {{ $classroom->description ?: 'Tidak ada deskripsi kelas.' }}
                </p>
            </div>
            
            {{-- Class Code Widget --}}
            <div class="bg-surface-container-high border border-outline-variant rounded-2xl p-5 flex items-center justify-between gap-8 shrink-0">
                <div>
                    <span class="text-[9px] font-bold text-on-surface-variant uppercase tracking-wider block">KODE JOIN SISWA</span>
                    <span class="text-2xl font-mono font-black text-[#6b3f00] tracking-widest">{{ $classroom->code }}</span>
                </div>
                <button onclick="copyToClipboard('{{ $classroom->code }}', this)" class="bg-primary text-on-primary font-bold px-4 py-2.5 rounded-xl hover:bg-primary-container text-xs transition-all flex items-center gap-1.5 shadow active:scale-95 cursor-pointer">
                    <span class="material-symbols-outlined text-base">content_copy</span>
                    Salin Kode
                </button>
            </div>
        </div>
    </div>

    {{-- Students Section --}}
    <div class="mb-6 flex items-center justify-between">
        <h3 class="font-headline text-xl font-bold text-on-surface">Daftar Mahasiswa ({{ count($students) }})</h3>
    </div>

    {{-- Students Table/List --}}
    @if(count($students) > 0)
        <div class="bg-surface-container-low border border-outline-variant rounded-2xl overflow-hidden shadow-sm tactile-card">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-high/60 border-b border-outline-variant text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">
                            <th class="py-4 px-6">Mahasiswa</th>
                            <th class="py-4 px-6 text-center">Level Saat Ini</th>
                            <th class="py-4 px-6 text-center">Total XP (Poin)</th>
                            <th class="py-4 px-6">Progres Belajar</th>
                            <th class="py-4 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/30 text-sm">
                        @foreach($students as $student)
                            @php
                                $pct = $totalLevels > 0 ? ($student->completed_levels_count / $totalLevels) * 100 : 0;
                            @endphp
                            <tr class="hover:bg-surface-container-high/20 transition-colors">
                                {{-- Name & Avatar --}}
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        @if($student->avatar_url)
                                            <img src="{{ $student->avatar_url }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover border border-outline-variant" />
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-sm">
                                                {{ strtoupper(substr($student->username, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-bold text-on-surface leading-tight">{{ $student->username }}</p>
                                            <p class="text-xs text-on-surface-variant font-medium">{{ $student->email }}</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- User Level --}}
                                <td class="py-4 px-6 text-center font-bold">
                                    <span class="bg-secondary-container/30 text-secondary border border-secondary/15 px-3 py-1 rounded-full text-xs">
                                        Level {{ $student->getUserLevel() }}
                                    </span>
                                </td>

                                {{-- Total Points / XP --}}
                                <td class="py-4 px-6 text-center font-extrabold text-[#6b3f00]">
                                    {{ number_format($student->total_points) }} XP
                                </td>

                                {{-- Completed Levels Progress Bar --}}
                                <td class="py-4 px-6 min-w-[12rem]">
                                    <div class="flex flex-col gap-1.5 max-w-[15rem]">
                                        <div class="flex justify-between items-center text-[10px] font-bold text-on-surface-variant">
                                            <span>Level Selesai</span>
                                            <span>{{ $student->completed_levels_count }} / {{ $totalLevels }}</span>
                                        </div>
                                        <div class="h-2 w-full bg-surface-container-highest rounded-full overflow-hidden">
                                            <div class="h-full bg-tertiary rounded-full transition-all duration-500" style="width: {{ $pct }}%"></div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Action Button --}}
                                <td class="py-4 px-6 text-right">
                                    <a href="{{ route('guru.classrooms.student-progress', [$classroom->id, $student->id]) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-surface-container-high hover:bg-primary hover:text-on-primary border border-outline-variant/60 hover:border-transparent rounded-xl text-xs font-bold text-primary transition-all active:scale-95">
                                        <span class="material-symbols-outlined text-sm">monitoring</span>
                                        Monitor Progres
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="bg-surface-container-low border border-dashed border-outline-variant rounded-2xl p-16 flex flex-col items-center gap-4 text-center">
            <span class="material-symbols-outlined text-5xl text-outline" style="font-variation-settings: 'FILL' 1;">person_search</span>
            <p class="text-on-surface-variant font-medium text-sm">
                Belum ada mahasiswa yang terdaftar di kelas ini.<br>
                Bagikan kode kelas <strong class="text-[#6b3f00] font-mono select-all">{{ $classroom->code }}</strong> ke mahasiswa Anda untuk bergabung!
            </p>
        </div>
    @endif
</div>

@push('scripts')
<script>
    function copyToClipboard(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            const originalHTML = btn.innerHTML;
            btn.innerHTML = `
                <span class="material-symbols-outlined text-base">done</span>
                Tersalin!
            `;
            setTimeout(() => {
                btn.innerHTML = originalHTML;
            }, 2000);
        }).catch(err => {
            console.error('Gagal menyalin text: ', err);
        });
    }
</script>
@endpush
@endsection

