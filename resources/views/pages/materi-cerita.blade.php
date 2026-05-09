@extends('layouts.app')

@section('title', 'Cerita Jawa')
@section('subtitle', 'Eksplorasi literasi dan nilai luhur melalui cerita rakyat')

@section('content')
<div class="max-w-6xl mx-auto py-8 space-y-10">
    <!-- Featured Story Header -->
    <div class="relative h-80 rounded-[3rem] overflow-hidden tactile-card shadow-2xl group">
        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD5NGlLpekvislF1yCic2JH4qPiRdaBLR4uj7YEltUTlYKU15BiHvV8RSDxfWLF7wuy8Aj50Lo2awzv9I1V4_0_cdCp3v3i1o2duNYYZv6phebAYq-On2rtHsjYz4r-SOYpsnjkLZwXKWd5_zLp7tCTk0YWDO6YAyUgyd2Azatvx2WF8kSpMqq3DlsTb4pg5bA7onMj6YkOIkm1CiM9iizFtPWqHoWMg1Qv_mGXgqXrb3olZ0WLLsxLS1i4BcvurpFu9tCUctiKiUw" alt="Cerita Jawa"/>
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
        <div class="absolute bottom-10 left-10 right-10">
            <span class="px-4 py-1 bg-secondary text-on-secondary rounded-full text-[10px] font-bold uppercase tracking-widest mb-4 inline-block">Literasi Utama</span>
            <h2 class="font-headline text-4xl text-white font-bold mb-2">Asal-usul Hanacaraka</h2>
            <p class="text-white/80 text-base max-w-2xl line-clamp-2 italic">"Kisah tentang kesetiaan Dora dan Sembada dalam menjaga amanat Aji Saka yang menjadi cikal bakal urutan aksara Jawa."</p>
            <button class="mt-6 px-8 py-3 bg-white text-primary font-bold rounded-xl tactile-button flex items-center gap-2 text-sm">
                Baca Selengkapnya
                <span class="material-symbols-outlined">auto_stories</span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
        <!-- Jenis Teks Section -->
        <div class="md:col-span-4 space-y-6">
            <h3 class="font-headline text-2xl text-primary font-bold px-2">Jenis Teks Jawa</h3>
            @foreach($jenisTeks as $t)
            <div class="p-6 bg-white rounded-[2rem] tactile-card border border-surface-container-high shadow-sm hover:border-primary transition-all group">
                <div class="flex items-center gap-4 mb-2">
                    <div class="w-10 h-10 bg-primary/10 text-primary rounded-xl flex items-center justify-center group-hover:bg-primary group-hover:text-on-primary transition-all">
                        <span class="material-symbols-outlined text-[20px]">
                            @if($t['nama'] == 'Narasi') history
                            @elseif($t['nama'] == 'Deskripsi') image
                            @elseif($t['nama'] == 'Eksposisi') info
                            @elseif($t['nama'] == 'Argumentasi') psychology
                            @else ads_click
                            @endif
                        </span>
                    </div>
                    <h4 class="font-headline text-lg font-bold">{{ $t['nama'] }}</h4>
                </div>
                <p class="text-xs text-on-surface-variant font-medium">{{ $t['desc'] }}</p>
            </div>
            @endforeach
        </div>

        <!-- Unsur Cerita & Paragraf -->
        <div class="md:col-span-8 space-y-8">
            <div class="bg-surface-container-lowest p-8 rounded-[2.5rem] tactile-card border border-surface-container-high shadow-sm">
                <h3 class="font-headline text-2xl text-primary font-bold mb-8">Unsur-unsur Cerita (Struktur)</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach($unsurCerita as $u)
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-secondary/10 text-secondary rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-xs font-bold">{{ substr($u['nama'], 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold mb-1">{{ $u['nama'] }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $u['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-primary text-on-primary p-8 rounded-[2.5rem] tactile-card shadow-sm relative overflow-hidden">
                <h3 class="font-headline text-2xl font-bold mb-8">Struktur Paragraf</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 relative z-10">
                    @foreach($unsurParagraf as $up)
                    <div class="p-4 bg-white/10 backdrop-blur rounded-2xl border border-white/20">
                        <p class="text-sm font-bold mb-1 text-secondary-container">{{ $up['nama'] }}</p>
                        <p class="text-xs opacity-90">{{ $up['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
                <div class="absolute right-[-30px] bottom-[-30px] opacity-10">
                    <span class="material-symbols-outlined text-[180px]">format_align_left</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
