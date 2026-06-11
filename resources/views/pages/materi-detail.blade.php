@extends('layouts.app')

@section('title', $library->title)
@section('subtitle', $library->subtitle)

@section('content')
<div class="max-w-6xl mx-auto py-6 space-y-8">
    {{-- Breadcrumb & Back navigation --}}
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2 text-xs font-bold text-on-surface-variant uppercase tracking-wider">
            <a href="{{ route('materi') }}" class="hover:text-primary transition-colors">Perpustakaan</a>
            <span class="material-symbols-outlined text-[12px]">chevron_right</span>
            <span class="text-primary">{{ $library->title }}</span>
        </div>
        <a href="{{ route('materi') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-surface-container hover:bg-surface-container-high rounded-full text-xs font-bold text-on-surface transition-all">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Kembali ke Perpustakaan
        </a>
    </div>

    {{-- Layout renderer by Category --}}
    @if($library->category === 'aksara')
        {{-- ── 1. AKSARA JAWA LAYOUT ── --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 gap-4 mb-12">
            @foreach($library->content['hanacaraka'] as $item)
            <div class="bg-white p-8 rounded-3xl tactile-card border border-surface-container-high flex flex-col items-center justify-center gap-2 group hover:border-primary transition-all">
                <span class="text-[64px] font-bold text-primary mb-2 leading-none aksara-font">{{ $item['aksara'] }}</span>
                <p class="text-sm font-bold text-on-surface-variant">{{ $item['latin'] }}</p>
            </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-surface-container-lowest p-8 rounded-[2rem] tactile-card border border-surface-container-high shadow-sm">
                <h3 class="font-headline text-2xl font-bold text-primary mb-6">Sandhangan</h3>
                <div class="space-y-4">
                    @foreach($library->content['sandhangan'] as $s)
                    <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-xl">
                        <span class="text-sm font-bold">{{ $s['nama'] }}</span>
                        <span class="text-xl font-bold aksara-font">{{ $s['contoh'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-secondary-container text-on-secondary-container p-8 rounded-[2rem] tactile-card shadow-sm relative overflow-hidden">
                <h3 class="font-headline text-2xl font-bold mb-6">Contoh Kata</h3>
                <div class="space-y-4 relative z-10">
                    @foreach($library->content['contohKata'] as $c)
                    <div class="flex items-center justify-between p-4 bg-white/20 backdrop-blur rounded-xl">
                        <span class="text-sm font-bold">{{ $c['latin'] }}</span>
                        <span class="text-xl font-bold aksara-font">{{ $c['aksara'] }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="absolute right-[-20px] bottom-[-20px] opacity-10">
                    <span class="material-symbols-outlined text-[150px]">auto_stories</span>
                </div>
            </div>
        </div>

    @elseif($library->category === 'bahasa')
        {{-- ── 2. BAHASA (NGOKO / KRAMA) LAYOUT ── --}}
        <div class="bg-primary-container text-on-primary-container p-10 rounded-[3rem] tactile-card shadow-lg relative overflow-hidden mb-8">
            <div class="relative z-10">
                <h3 class="font-headline text-3xl font-bold mb-4">Filosofi Penggunaan</h3>
                <p class="text-base opacity-90 max-w-2xl">
                    {{ $library->description ?? 'Mempelajari bahasa Jawa membantu kita menghargai tata krama, kesantunan, dan cara berkomunikasi yang disesuaikan dengan lawan bicara.' }}
                </p>
            </div>
            <div class="absolute right-[-20px] bottom-[-20px] opacity-10">
                <span class="material-symbols-outlined text-[180px]">diversity_3</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Vocabulary Comparison --}}
            <div class="bg-white p-8 rounded-[2rem] tactile-card border border-surface-container-high shadow-sm">
                <h3 class="font-headline text-2xl font-bold text-primary mb-6">Daftar Kosakata</h3>
                <div class="overflow-hidden rounded-2xl border border-surface-container-high">
                    <table class="w-full text-left">
                        <thead class="bg-surface-container-low">
                            <tr>
                                @if(isset($library->content['kosakata'][0]['krama']))
                                    <th class="p-4 text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">Ngoko</th>
                                    <th class="p-4 text-[10px] font-bold text-primary uppercase tracking-widest">Krama Alus</th>
                                @else
                                    <th class="p-4 text-[10px] font-bold text-primary uppercase tracking-widest">Ngoko</th>
                                    <th class="p-4 text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">Indonesia</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-container-high">
                            @foreach($library->content['kosakata'] as $k)
                            <tr class="hover:bg-surface-container-lowest transition-colors">
                                @if(isset($k['krama']))
                                    <td class="p-4 text-sm font-medium text-on-surface-variant">{{ $k['ngoko'] }}</td>
                                    <td class="p-4 text-sm font-bold text-primary">{{ $k['krama'] }}</td>
                                @else
                                    <td class="p-4 text-sm font-bold text-primary">{{ $k['ngoko'] }}</td>
                                    <td class="p-4 text-sm font-medium text-on-surface-variant">{{ $k['indonesia'] }}</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Sentence examples or Dialog --}}
            <div class="flex flex-col gap-8">
                @if(isset($library->content['kalimat']) && count($library->content['kalimat']) > 0)
                <div class="bg-tertiary-container text-on-tertiary-container p-8 rounded-[2rem] tactile-card shadow-sm">
                    <h3 class="font-headline text-2xl font-bold mb-6">Contoh Kalimat</h3>
                    <div class="space-y-3">
                        @foreach($library->content['kalimat'] as $kal)
                        <div class="p-4 bg-white/10 backdrop-blur rounded-xl border border-white/20">
                            <p class="text-sm font-bold">{{ $kal }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if(isset($library->content['percakapan']) && count($library->content['percakapan']) > 0)
                <div class="bg-surface-container-lowest p-8 rounded-[2rem] tactile-card border border-surface-container-high shadow-sm flex-1">
                    <h3 class="font-headline text-2xl font-bold text-primary mb-6">Contoh Percakapan</h3>
                    <div class="space-y-4">
                        @foreach($library->content['percakapan'] as $p)
                        <div class="flex gap-4 {{ $p['nama'] === 'A' || $loop->odd ? '' : 'flex-row-reverse' }}">
                            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-on-primary text-[10px] font-bold flex-shrink-0">
                                {{ strtoupper(substr($p['nama'], 0, 1)) }}
                            </div>
                            <div class="p-3 {{ $p['nama'] === 'A' || $loop->odd ? 'bg-surface-container-low rounded-tr-xl rounded-br-xl rounded-bl-xl' : 'bg-primary/5 rounded-tl-xl rounded-bl-xl rounded-br-xl' }} max-w-[80%]">
                                <p class="text-[9px] font-bold text-primary uppercase mb-0.5">{{ $p['nama'] }}</p>
                                <p class="text-xs font-medium italic">"{{ $p['ucap'] }}"</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

    @elseif($library->category === 'kosakata')
        {{-- ── 3. KOSAKATA & DIALOG LAYOUT ── --}}
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
            <!-- Salam Section -->
            <div class="md:col-span-7 bg-white p-8 rounded-[2rem] tactile-card border border-surface-container-high shadow-sm">
                <h3 class="font-headline text-2xl text-primary font-bold mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined">waving_hand</span>
                    Salam & Sapaan
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($library->content['salam'] as $s)
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
                    @foreach($library->content['keluarga'] as $f)
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
                    @foreach($library->content['aktivitas'] as $a)
                    <div class="flex flex-col items-center text-center gap-2 p-4 rounded-2xl hover:bg-primary/5 transition-all group">
                        <div class="w-12 h-12 bg-primary/10 text-primary rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined">
                                @if($a['jawa'] === 'Mangan') restaurant
                                @elseif($a['jawa'] === 'Ngombe') local_drink
                                @elseif($a['jawa'] === 'Turu') bed
                                @elseif($a['jawa'] === 'Lunga') directions_run
                                @elseif($a['jawa'] === 'Mulih') home
                                @elseif($a['jawa'] === 'Sinau') school
                                @elseif($a['jawa'] === 'Dolanan') sports_esports
                                @elseif($a['jawa'] === 'Makarya') work
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
                    @foreach($library->content['dialog'] as $d)
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
                    @foreach($library->content['pola'] as $p)
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

    @elseif($library->category === 'cerita')
        {{-- ── 4. CERITA & LITERASI LAYOUT ── --}}
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
            <!-- Jenis Teks Section -->
            <div class="md:col-span-4 space-y-6">
                <h3 class="font-headline text-2xl text-primary font-bold px-2">Jenis Teks Jawa</h3>
                @foreach($library->content['jenisTeks'] as $t)
                <div class="p-6 bg-white rounded-[2rem] tactile-card border border-surface-container-high shadow-sm hover:border-primary transition-all group">
                    <div class="flex items-center gap-4 mb-2">
                        <div class="w-10 h-10 bg-primary/10 text-primary rounded-xl flex items-center justify-center group-hover:bg-primary group-hover:text-on-primary transition-all">
                            <span class="material-symbols-outlined text-[20px]">
                                @if($t['nama'] === 'Narasi') history
                                @elseif($t['nama'] === 'Deskripsi') image
                                @elseif($t['nama'] === 'Eksposisi') info
                                @elseif($t['nama'] === 'Argumentasi') psychology
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
                        @foreach($library->content['unsurCerita'] as $u)
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
                        @foreach($library->content['unsurParagraf'] as $up)
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
    @endif
</div>
@endsection
