@extends('layouts.app')

@section('title', 'Dashboard Guru')
@section('subtitle', 'Kelola kelas dan pantau progress belajar mahasiswa')

@section('content')
<div class="flex flex-col py-6 max-w-5xl mx-auto px-4 md:px-0">

    {{-- Alert Notification --}}
    @if(session('success'))
    <div class="mb-6 p-4 rounded-xl text-sm font-bold bg-green-50 text-green-700 border border-green-200 flex items-center gap-2 animate-float-up">
        <span class="material-symbols-outlined">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    {{-- Stats Row --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
        <!-- Total Kelas -->
        <div class="bg-surface-container-low border border-outline-variant rounded-2xl p-6 flex items-center gap-4 tactile-card shadow-sm">
            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings: 'FILL' 1;">groups</span>
            </div>
            <div>
                <p class="text-3xl font-headline font-bold text-on-surface">{{ $totalClasses }}</p>
                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Total Kelas Anda</p>
            </div>
        </div>
        <!-- Total Mahasiswa -->
        <div class="bg-surface-container-low border border-outline-variant rounded-2xl p-6 flex items-center gap-4 tactile-card shadow-sm">
            <div class="w-12 h-12 bg-secondary/10 rounded-xl flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-secondary text-2xl" style="font-variation-settings: 'FILL' 1;">school</span>
            </div>
            <div>
                <p class="text-3xl font-headline font-bold text-on-surface">{{ $totalStudents }}</p>
                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Mahasiswa Terdaftar</p>
            </div>
        </div>
        <!-- Rata-rata XP -->
        <div class="bg-surface-container-low border border-outline-variant rounded-2xl p-6 flex items-center gap-4 tactile-card shadow-sm">
            <div class="w-12 h-12 bg-tertiary/10 rounded-xl flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-tertiary text-2xl" style="font-variation-settings: 'FILL' 1;">monitoring</span>
            </div>
            <div>
                <p class="text-3xl font-headline font-bold text-on-surface">{{ number_format($averageXp) }}</p>
                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Rata-rata XP</p>
            </div>
        </div>
    </div>

    {{-- Section Header --}}
    <div class="mb-6 flex items-center justify-between">
        <h3 class="font-headline text-xl font-bold text-on-surface">Daftar Kelas Anda</h3>
        <button onclick="toggleModal(true)" class="bg-primary text-on-primary font-bold px-5 py-3 rounded-xl hover:bg-primary-container text-xs transition-all flex items-center gap-2 shadow-md hover:shadow-lg active:scale-95 cursor-pointer">
            <span class="material-symbols-outlined text-base">add_circle</span>
            Buat Kelas Baru
        </button>
    </div>

    {{-- Classroom Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($classrooms as $classroom)
            <div class="bg-surface-container-low border border-outline-variant rounded-2xl p-6 flex flex-col justify-between tactile-card shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                
                {{-- Decorative Watermark --}}
                <div class="absolute right-4 top-4 opacity-5 pointer-events-none select-none group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-[100px]">auto_stories</span>
                </div>

                <div class="relative z-10">
                    <div class="flex items-start justify-between mb-2">
                        <h4 class="font-headline text-lg font-bold text-primary truncate max-w-[70%]">{{ $classroom->name }}</h4>
                        <span class="bg-secondary-container/50 text-secondary border border-secondary/20 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">
                            {{ $classroom->students_count }} Mahasiswa
                        </span>
                    </div>
                    <p class="text-xs text-on-surface-variant line-clamp-2 mb-4 pr-10 min-h-[2rem]">
                        {{ $classroom->description ?: 'Tidak ada deskripsi kelas.' }}
                    </p>

                    {{-- Join Code Container --}}
                    <div class="bg-surface-container-high rounded-xl p-3 flex items-center justify-between border border-outline-variant/30 mb-6">
                        <div class="flex flex-col">
                            <span class="text-[9px] font-bold text-on-surface-variant uppercase tracking-wider">Kode Join Kelas</span>
                            <span class="text-lg font-mono font-extrabold text-[#6b3f00] tracking-widest">{{ $classroom->code }}</span>
                        </div>
                        <button onclick="copyToClipboard('{{ $classroom->code }}', this)" class="text-primary hover:bg-primary/10 p-2 rounded-lg transition-colors flex items-center gap-1 text-xs font-bold cursor-pointer">
                            <span class="material-symbols-outlined text-lg">content_copy</span>
                            Salin
                        </button>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-2 relative z-10">
                    <a href="{{ route('guru.classrooms.show', $classroom->id) }}" class="flex-1 bg-[#6B3A00] hover:bg-[#7a4200] text-white text-center py-2.5 rounded-xl font-bold text-xs shadow hover:shadow-md transition-all">
                        LIHAT DETAIL & MONITORING
                    </a>
                    
                    {{-- Delete Form --}}
                    <form action="{{ route('guru.classrooms.destroy', $classroom->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas ini? Semua data pendaftaran siswa di kelas ini akan dihapus permanen.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2.5 text-error border border-error/20 hover:bg-error/5 rounded-xl transition-all flex items-center justify-center" title="Hapus Kelas">
                            <span class="material-symbols-outlined text-lg">delete</span>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="md:col-span-2 bg-surface-container-low border border-dashed border-outline-variant rounded-2xl p-16 flex flex-col items-center gap-4 text-center">
                <span class="material-symbols-outlined text-6xl text-outline" style="font-variation-settings: 'FILL' 1;">groups_3</span>
                <p class="text-on-surface-variant font-medium text-sm">
                    Anda belum memiliki kelas.<br>
                    Mulai dengan membuat kelas pertama Anda sekarang!
                </p>
                <button onclick="toggleModal(true)" class="bg-primary text-on-primary font-bold px-6 py-3 rounded-xl hover:bg-primary-container text-xs transition-all flex items-center gap-2 shadow-md active:scale-95 cursor-pointer mt-2">
                    <span class="material-symbols-outlined text-base">add_circle</span>
                    Buat Kelas Baru
                </button>
            </div>
        @endforelse
    </div>
</div>

{{-- Create Class Modal --}}
<div id="createClassModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-[2rem] border border-surface-variant max-w-md w-full overflow-hidden shadow-2xl animate-float-up">
        
        {{-- Header --}}
        <div class="bg-primary text-on-primary p-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined">add_box</span>
                <h4 class="font-headline text-lg font-bold">Buat Kelas Baru</h4>
            </div>
            <button onclick="toggleModal(false)" class="text-white/80 hover:text-white cursor-pointer">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        {{-- Form --}}
        <form action="{{ route('guru.classrooms.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            
            <div class="space-y-2">
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1" for="name">Nama Kelas</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-[20px]">class</span>
                    <input class="w-full pl-12 pr-4 py-3 bg-surface-container-low border-2 border-transparent focus:border-primary rounded-xl transition-all outline-none text-sm font-medium" id="name" name="name" placeholder="Contoh: Kelas Bahasa Jawa XI-A" type="text" required/>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1" for="description">Deskripsi (Opsional)</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-4 text-outline text-[20px]">description</span>
                    <textarea class="w-full pl-12 pr-4 py-3 bg-surface-container-low border-2 border-transparent focus:border-primary rounded-xl transition-all outline-none text-sm font-medium h-24 resize-none" id="description" name="description" placeholder="Berikan deskripsi singkat kelas Anda..." maxlength="255"></textarea>
                </div>
            </div>

            <div class="pt-4 flex gap-3">
                <button type="button" onclick="toggleModal(false)" class="flex-1 py-3 text-sm font-bold text-on-surface-variant bg-surface-container-high rounded-xl hover:bg-surface-container-highest transition-all text-center cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="flex-1 py-3 text-sm font-bold text-on-primary bg-primary rounded-xl hover:bg-primary-container transition-all flex items-center justify-center gap-2 shadow-md cursor-pointer">
                    Simpan Kelas
                    <span class="material-symbols-outlined text-base">save</span>
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Toggle Modal visibility
    function toggleModal(show) {
        const modal = document.getElementById('createClassModal');
        if (show) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // prevent background scrolling
        } else {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }
    }

    // Copy Class Code helper
    function copyToClipboard(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            const originalHTML = btn.innerHTML;
            btn.innerHTML = `
                <span class="material-symbols-outlined text-lg text-green-600">done</span>
                <span class="text-green-600 font-bold">Tersalin!</span>
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
