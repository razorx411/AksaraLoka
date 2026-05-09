@extends('layouts.app')

@section('title', 'Kosakata & Percakapan')
@section('subtitle', 'Fondasi komunikasi dalam bahasa Jawa')

@section('content')
<div class="max-w-6xl mx-auto py-8 space-y-10">
    <!-- Quick Search / Filter -->
    <div class="flex flex-wrap gap-2 mb-8">
        <button class="px-6 py-2 bg-primary text-on-primary rounded-full text-xs font-bold shadow-md">Semua</button>
        <button class="px-6 py-2 bg-white text-on-surface-variant rounded-full text-xs font-bold border border-surface-container-high hover:bg-surface-container-low transition-all">Salam</button>
        <button class="px-6 py-2 bg-white text-on-surface-variant rounded-full text-xs font-bold border border-surface-container-high hover:bg-surface-container-low transition-all">Keluarga</button>
        <button class="px-6 py-2 bg-white text-on-surface-variant rounded-full text-xs font-bold border border-surface-container-high hover:bg-surface-container-low transition-all">Aktivitas</button>
    </div>

    <!-- Bento Grid Sections -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
        <!-- Salam Section -->
        <div class="md:col-span-7 bg-white p-8 rounded-[2rem] tactile-card border border-surface-container-high shadow-sm">
            <h3 class="font-headline text-2xl text-primary font-bold mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined">waving_hand</span>
                Salam & Sapaan
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($salam as $s)
                <div class="p-4 bg-surface-container-low rounded-2xl border border-surface-container-highest group hover:border-primary transition-all">
                    <p class="text-sm font-bold text-primary mb-1">{{ $s['jawa'] }}</p>
                    <p class="text-xs text-on-surface-variant mb-2">{{ $s['indonesia'] }}</p>
                    <span class="text-[9px] font-bold text-outline-variant uppercase tracking-widest">{{ $s['konteks'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Keluarga Section -->
        <div class="md:col-span-5 bg-secondary-container text-on-secondary-container p-8 rounded-[2rem] tactile-card shadow-sm">
            <h3 class="font-headline text-2xl font-bold mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined">family_history</span>
                Sebutan Keluarga
            </h3>
            <div class="space-y-3">
                @foreach($keluarga as $f)
                <div class="flex items-center justify-between p-3 bg-white/20 backdrop-blur rounded-xl border border-white/20">
                    <span class="text-sm font-bold">{{ $f['jawa'] }}</span>
                    <span class="text-xs font-medium opacity-80">{{ $f['indonesia'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Aktivitas Section -->
        <div class="md:col-span-12 bg-surface-container-lowest p-8 rounded-[2.5rem] tactile-card border border-surface-container-high shadow-sm">
            <h3 class="font-headline text-2xl text-primary font-bold mb-8">Aktivitas Umum</h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-6">
                @foreach($aktivitas as $a)
                <div class="flex flex-col items-center text-center gap-2 p-4 rounded-2xl hover:bg-primary/5 transition-all group">
                    <div class="w-12 h-12 bg-primary/10 text-primary rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">
                            @if($a['jawa'] == 'Mangan') restaurant
                            @elseif($a['jawa'] == 'Ngombe') local_drink
                            @elseif($a['jawa'] == 'Turu') bed
                            @elseif($a['jawa'] == 'Lunga') directions_run
                            @elseif($a['jawa'] == 'Mulih') home
                            @elseif($a['jawa'] == 'Sinau') school
                            @elseif($a['jawa'] == 'Dolanan') sports_esports
                            @elseif($a['jawa'] == 'Makarya') work
                            @else ads_click
                            @endif
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-bold">{{ $a['jawa'] }}</p>
                        <p class="text-[10px] font-medium text-on-surface-variant">{{ $a['indonesia'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Dialog Section -->
        <div class="md:col-span-8 bg-white p-8 rounded-[2rem] tactile-card border border-surface-container-high shadow-sm">
            <h3 class="font-headline text-2xl text-primary font-bold mb-8">Latihan Dialog</h3>
            <div class="space-y-6">
                @foreach($dialog as $d)
                <div class="flex gap-4 {{ $loop->odd ? '' : 'flex-row-reverse' }}">
                    <div class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-primary font-bold flex-shrink-0 shadow-sm">
                        {{ strtoupper(substr($d['nama'], 0, 1)) }}
                    </div>
                    <div class="p-4 {{ $loop->odd ? 'bg-surface-container-low rounded-tr-2xl rounded-br-2xl rounded-bl-2xl' : 'bg-primary/5 rounded-tl-2xl rounded-bl-2xl rounded-br-2xl' }} max-w-[80%] border border-surface-container-highest">
                        <p class="text-[10px] font-bold text-primary uppercase tracking-widest mb-1">{{ $d['nama'] }}</p>
                        <p class="text-sm font-medium italic">"{{ $d['ucap'] }}"</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Pola Kalimat Section -->
        <div class="md:col-span-4 bg-primary text-on-primary p-8 rounded-[2rem] tactile-card shadow-sm relative overflow-hidden">
            <h3 class="font-headline text-2xl font-bold mb-6">Pola Kalimat</h3>
            <div class="space-y-6 relative z-10">
                @foreach($pola as $p)
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest mb-1 opacity-70">{{ $p['pola'] }}</p>
                    <div class="p-3 bg-white/10 backdrop-blur rounded-xl border border-white/20">
                        <p class="text-sm font-bold">{{ $p['contoh'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="absolute right-[-20px] bottom-[-20px] opacity-10">
                <span class="material-symbols-outlined text-[150px]">data_object</span>
            </div>
        </div>
    </div>
</div>
@endsection
