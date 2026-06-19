@extends('layouts.app')

@section('title', 'Kelas')
@section('subtitle', 'Papan peringkat kelas dan daftar anggota')

@section('content')
<div class="flex flex-col py-6 max-w-5xl mx-auto px-4 md:px-0">

    {{-- Breadcrumbs / Header Action --}}
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('student.classrooms.index') }}" class="inline-flex items-center gap-2 text-primary hover:text-primary-container font-bold text-sm">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Kembali ke Daftar Kelas
        </a>

        <form action="{{ route('student.classrooms.leave', $classroom->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari kelas ini?')">
            @csrf
            <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 border border-error/20 hover:bg-error/5 text-error rounded-xl text-xs font-bold transition-all active:scale-95 cursor-pointer">
                <span class="material-symbols-outlined text-sm">logout</span>
                Keluar Kelas
            </button>
        </form>
    </div>

    {{-- Class Banner Card --}}
    <div class="bg-surface-container-low border border-outline-variant rounded-[2rem] p-6 md:p-8 tactile-card shadow-sm mb-10 relative overflow-hidden">
        {{-- Watermark --}}
        <div class="absolute right-6 top-1/2 -translate-y-1/2 opacity-5 pointer-events-none select-none">
            <span class="material-symbols-outlined text-[130px]">workspace_premium</span>
        </div>

        <div class="relative z-10">
            <span class="bg-[#ffc641]/15 text-[#795900] border border-[#ffc641]/25 text-[9px] font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-2 inline-block">
                Kelas Terdaftar
            </span>
            <h2 class="font-headline text-3xl font-bold text-on-surface mb-2 truncate max-w-[80%]">{{ $classroom->name }}</h2>
            <div class="flex flex-col sm:flex-row sm:items-center gap-4 text-xs text-on-surface-variant font-medium mt-3">
                <div class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-base">person</span>
                    <span>Guru: <strong>{{ $classroom->teacher->username }}</strong></span>
                </div>
                <div class="hidden sm:block text-outline">•</div>
                <div class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-base">groups</span>
                    <span>Total: {{ count($classmates) }} Teman Sejawat</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Leaderboard Section --}}
    <div class="mb-6">
        <h3 class="font-headline text-xl font-bold text-on-surface flex items-center gap-2">
            <span class="material-symbols-outlined text-amber-500 text-2xl" style="font-variation-settings: 'FILL' 1;">emoji_events</span>
            Papan Peringkat Kelas
        </h3>
    </div>

    {{-- Leaderboard list --}}
    <div class="bg-surface-container-low border border-outline-variant rounded-2xl overflow-hidden shadow-sm tactile-card">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-high/60 border-b border-outline-variant text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">
                        <th class="py-4 px-6 text-center w-20">Peringkat</th>
                        <th class="py-4 px-6">Siswa</th>
                        <th class="py-4 px-6 text-center">Level</th>
                        <th class="py-4 px-6 text-right">Skor (Total XP)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/30 text-sm">
                    @foreach($classmates as $index => $classmate)
                        @php
                            $isCurrentUser = $classmate->id === auth()->id();
                            $rank = $index + 1;
                        @endphp
                        <tr class="transition-colors {{ $isCurrentUser ? 'bg-primary/5 hover:bg-primary/10 border-l-4 border-l-primary' : 'hover:bg-surface-container-high/20' }}">
                            
                            {{-- Rank --}}
                            <td class="py-4 px-6 text-center font-bold">
                                @if($rank === 1)
                                    <span class="text-2xl" title="Peringkat 1">🥇</span>
                                @elseif($rank === 2)
                                    <span class="text-2xl" title="Peringkat 2">🥈</span>
                                @elseif($rank === 3)
                                    <span class="text-2xl" title="Peringkat 3">🥉</span>
                                @else
                                    <span class="text-on-surface-variant font-mono font-bold">{{ $rank }}</span>
                                @endif
                            </td>

                            {{-- Student Name & Avatar --}}
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    @if($classmate->avatar_url)
                                        <img src="{{ $classmate->avatar_url }}" alt="Avatar" class="w-9 h-9 rounded-full object-cover {{ $isCurrentUser ? 'border-2 border-primary' : 'border border-outline-variant' }}" />
                                    @else
                                        <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-xs {{ $isCurrentUser ? 'bg-primary text-on-primary' : 'bg-primary/10 text-primary' }}">
                                            {{ strtoupper(substr($classmate->username, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold {{ $isCurrentUser ? 'text-primary' : 'text-on-surface' }}">{{ $classmate->username }}</span>
                                        @if($isCurrentUser)
                                            <span class="bg-primary text-on-primary text-[8px] font-bold px-1.5 py-0.5 rounded uppercase tracking-wider">Anda</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Level --}}
                            <td class="py-4 px-6 text-center font-semibold">
                                <span class="bg-secondary-container/20 text-secondary px-2.5 py-0.5 rounded-full text-xs font-bold border border-secondary/10">
                                    Level {{ $classmate->getUserLevel() }}
                                </span>
                            </td>

                            {{-- XP --}}
                            <td class="py-4 px-6 text-right font-extrabold text-primary text-base">
                                {{ number_format($classmate->total_points) }} <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">XP</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

