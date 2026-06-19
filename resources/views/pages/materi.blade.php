@extends('layouts.app')

@section('title', 'Perpustakaan Aksara')
@section('subtitle', 'Panduan Referensi Hanacaraka')

@section('content')
<section class="max-w-[1140px] mx-auto px-4 py-6">
    <!-- Search and Filter Bar -->
    <div class="bg-surface-container rounded-2xl p-4 mb-10 flex flex-col md:flex-row gap-4 items-center shadow-sm">
        <div class="relative w-full md:w-1/3">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
            <input id="cariMateri" class="w-full pl-12 pr-4 py-2 bg-surface rounded-xl border-none ring-2 ring-transparent focus:ring-primary focus:outline-none transition-all text-sm text-on-surface" placeholder="Cari materi..." type="text"/>
        </div>
        <div class="flex flex-wrap items-center gap-2" id="filterButtons">
            <button data-filter="semua" class="filter-btn px-6 py-2 rounded-full bg-secondary-container text-on-secondary-container font-bold border-b-2 border-secondary hover:translate-y-[-1px] transition-all text-xs">Semua</button>
            <button data-filter="dasar" class="filter-btn px-6 py-2 rounded-full bg-surface hover:bg-surface-container-high text-on-surface-variant font-medium transition-all text-xs border border-surface-container-highest">Dasar</button>
            <button data-filter="menengah" class="filter-btn px-6 py-2 rounded-full bg-surface hover:bg-surface-container-high text-on-surface-variant font-medium transition-all text-xs border border-surface-container-highest">Menengah</button>
            <button data-filter="lanjutan" class="filter-btn px-6 py-2 rounded-full bg-surface hover:bg-surface-container-high text-on-surface-variant font-medium transition-all text-xs border border-surface-container-highest">Lanjutan</button>
        </div>
    </div>

    <!-- Materials Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="materiGrid">
        @foreach($materiList as $materi)
        <a href="{{ $materi['href'] }}" 
           class="materi-card bg-surface-container-lowest border border-surface-container-high p-8 rounded-[2rem] flex flex-col gap-4 group hover:border-primary transition-all duration-300 ease-out tactile-card relative overflow-hidden shadow-sm"
           data-judul="{{ strtolower($materi['judul']) }}"
           data-desc="{{ strtolower($materi['desc']) }}"
           data-tag="{{ strtolower($materi['tag']) }}">
            <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:opacity-10 transition-opacity">
                <span class="material-symbols-outlined text-[80px]">
                    @if($materi['cat'] == 'aksara') history_edu
                    @elseif($materi['cat'] == 'bahasa') translate
                    @elseif($materi['cat'] == 'kosakata') chat
                    @else auto_stories
                    @endif
                </span>
            </div>
            <div class="flex items-center justify-between">
                @php
                    $tagColors = [
                        'dasar' => 'bg-primary/10 text-primary',
                        'menengah' => 'bg-secondary-container text-on-secondary-container border border-secondary/20',
                        'lanjutan' => 'bg-tertiary-container text-on-tertiary-container border border-tertiary/20'
                    ];
                    $tagClass = $tagColors[strtolower($materi['tag'])] ?? 'bg-primary/10 text-primary';
                @endphp
                <span class="px-3 py-1 text-[10px] font-bold rounded-full uppercase tracking-wider {{ $tagClass }}">{{ $materi['tag'] }}</span>
                <span class="material-symbols-outlined text-outline group-hover:text-primary transition-colors">arrow_forward</span>
            </div>
            <div>
                <h3 class="font-headline text-2xl text-on-surface font-bold mb-2">{{ $materi['judul'] }}</h3>
                <p class="text-sm text-on-surface-variant line-clamp-2">{{ $materi['desc'] }}</p>
            </div>
        </a>
        @endforeach
    </div>

    {{-- Empty State --}}
    <div id="emptyState" class="hidden flex-col items-center justify-center py-20 gap-4 text-center">
        <div class="w-16 h-16 bg-surface-container rounded-full flex items-center justify-center text-outline-variant">
            <span class="material-symbols-outlined text-3xl">menu_book</span>
        </div>
        <div>
            <h4 class="font-headline text-lg font-bold text-on-surface">Materi tidak ditemukan</h4>
            <p class="text-sm text-on-surface-variant mt-1">Coba gunakan kata kunci pencarian atau filter yang lain.</p>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cariInput     = document.getElementById('cariMateri');
    const filterBtns    = document.querySelectorAll('.filter-btn');
    const materiCards   = document.querySelectorAll('.materi-card');
    const emptyState    = document.getElementById('emptyState');
    
    let activeFilter = 'semua';
    let searchText = '';

    function applyFilters() {
        let visibleCount = 0;

        materiCards.forEach(card => {
            const judul = card.dataset.judul;
            const desc  = card.dataset.desc;
            const tag   = card.dataset.tag;

            const matchesSearch = judul.includes(searchText) || desc.includes(searchText);
            const matchesFilter = activeFilter === 'semua' || tag === activeFilter;

            if (matchesSearch && matchesFilter) {
                card.style.display = 'flex';
                visibleCount++;
                // Smooth fade-in
                requestAnimationFrame(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                });
            } else {
                card.style.opacity = '0';
                card.style.transform = 'scale(0.95)';
                // Wait for animation before display none
                setTimeout(() => {
                    if (card.style.opacity === '0') {
                        card.style.display = 'none';
                    }
                }, 150);
            }
        });

        // Toggle Empty State
        if (visibleCount === 0) {
            emptyState.classList.remove('hidden');
            emptyState.classList.add('flex');
        } else {
            emptyState.classList.add('hidden');
            emptyState.classList.remove('flex');
        }
    }

    cariInput.addEventListener('input', function() {
        searchText = cariInput.value.toLowerCase().trim();
        applyFilters();
    });

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Reset all buttons to inactive style
            filterBtns.forEach(b => {
                b.className = 'filter-btn px-6 py-2 rounded-full bg-surface hover:bg-surface-container-high text-on-surface-variant font-medium transition-all text-xs border border-surface-container-highest';
            });
            
            // Set clicked button to active style
            btn.className = 'filter-btn px-6 py-2 rounded-full bg-secondary-container text-on-secondary-container font-bold border-b-2 border-secondary hover:translate-y-[-1px] transition-all text-xs';
            
            activeFilter = btn.dataset.filter;
            applyFilters();
        });
    });
});
</script>
@endpush
@endsection

