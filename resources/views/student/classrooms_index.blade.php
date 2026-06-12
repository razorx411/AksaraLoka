@extends('layouts.app')

@section('title', 'Kelas Saya')
@section('subtitle', 'Belajar bersama guru dan pantau peringkat kelasmu')

@section('content')
<div class="flex flex-col py-6 max-w-5xl mx-auto px-4 md:px-0">

    {{-- Notification Messages --}}
    @if(session('success'))
    <div class="mb-6 p-4 rounded-xl text-sm font-bold bg-green-50 text-green-700 border border-green-200 flex items-center gap-2 animate-float-up">
        <span class="material-symbols-outlined">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 p-4 rounded-xl text-sm font-bold bg-red-50 text-red-700 border border-red-200 flex items-center gap-2 animate-float-up">
        <span class="material-symbols-outlined">error</span>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    {{-- Main Layout: Grid on Desktop (Left: Join Class Module, Right: List of Classes) --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Join Class Module --}}
        <div class="lg:col-span-1">
            <div class="bg-surface-container-low border border-outline-variant rounded-[2rem] p-6 tactile-card shadow-sm sticky top-24">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary text-xl" style="font-variation-settings: 'FILL' 1;">add_home_work</span>
                    </div>
                    <h4 class="font-headline text-lg font-bold text-on-surface">Gabung Kelas Baru</h4>
                </div>
                <p class="text-xs text-on-surface-variant mb-6 leading-relaxed">
                    Masukkan kode unik kelas 6-karakter yang dibagikan oleh guru Anda untuk bergabung ke kelas dan membagikan progres belajar Anda.
                </p>

                <form action="{{ route('student.classrooms.join') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1" for="code">Kode Kelas</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-[20px]">vpn_key</span>
                            <input class="w-full pl-12 pr-4 py-3.5 bg-surface-container-low border-2 border-transparent focus:border-primary rounded-xl transition-all outline-none text-sm font-mono font-bold uppercase tracking-widest placeholder:font-sans placeholder:tracking-normal" id="code" name="code" placeholder="Contoh: AK93B1" maxlength="10" required />
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full py-3.5 bg-primary text-on-primary font-bold rounded-xl tactile-button flex items-center justify-center gap-2 text-xs shadow-md cursor-pointer">
                        Gabung Kelas
                        <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </button>
                </form>
            </div>
        </div>

        {{-- Classroom Grid --}}
        <div class="lg:col-span-2 space-y-6">
            <h3 class="font-headline text-lg font-bold text-on-surface flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">school</span>
                Kelas Yang Diikuti
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($classrooms as $classroom)
                    <div class="bg-surface-container-low border border-outline-variant rounded-2xl p-6 flex flex-col justify-between tactile-card shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                        
                        {{-- Watermark --}}
                        <div class="absolute right-4 top-4 opacity-5 pointer-events-none select-none group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-[90px]">school</span>
                        </div>

                        <div>
                            <div class="flex items-start justify-between mb-2">
                                <h4 class="font-headline text-base font-bold text-[#6b3f00] truncate max-w-[75%]">{{ $classroom->name }}</h4>
                                <span class="bg-[#a4f792]/20 text-[#005503] border border-[#a4f792]/30 text-[9px] font-bold px-2 py-0.5 rounded-full uppercase">
                                    {{ $classroom->students_count }} Siswa
                                </span>
                            </div>
                            
                            {{-- Teacher Info --}}
                            <div class="flex items-center gap-2 mb-4">
                                <span class="material-symbols-outlined text-on-surface-variant text-base">person</span>
                                <span class="text-xs text-on-surface-variant font-semibold">Guru: {{ $classroom->teacher->username }}</span>
                            </div>

                            <p class="text-xs text-on-surface-variant line-clamp-2 min-h-[2.5rem] mb-6">
                                {{ $classroom->description ?: 'Tidak ada deskripsi kelas.' }}
                            </p>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('student.classrooms.show', $classroom->id) }}" class="flex-1 bg-primary text-on-primary hover:bg-primary-container text-center py-2.5 rounded-xl font-bold text-xs shadow transition-all">
                                BUKA KELAS
                            </a>

                            {{-- Leave Form --}}
                            <form action="{{ route('student.classrooms.leave', $classroom->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari kelas ini? Progres Anda tidak akan terlihat lagi oleh guru.')">
                                @csrf
                                <button type="submit" class="p-2.5 text-error border border-error/20 hover:bg-error/5 rounded-xl transition-all flex items-center justify-center" title="Keluar Kelas">
                                    <span class="material-symbols-outlined text-lg">logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 bg-surface-container-low border border-dashed border-outline-variant rounded-2xl p-16 flex flex-col items-center gap-4 text-center">
                        <span class="material-symbols-outlined text-5xl text-outline" style="font-variation-settings: 'FILL' 1;">domain_disabled</span>
                        <p class="text-on-surface-variant font-medium text-xs">
                            Anda belum tergabung di kelas mana pun.<br>
                            Silakan masukkan kode kelas yang diberikan guru Anda di menu sebelah kiri.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
