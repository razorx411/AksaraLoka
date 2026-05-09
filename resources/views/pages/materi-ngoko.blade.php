@extends('layouts.app')

@section('title', 'Bahasa Ngoko')
@section('subtitle', 'Bahasa sehari-hari untuk teman sebaya')

@section('content')
<div class="max-w-5xl mx-auto py-8 space-y-8">
    <!-- Kosakata Section -->
    <div class="bg-white p-8 rounded-[2rem] tactile-card border border-surface-container-high shadow-sm">
        <h3 class="font-headline text-2xl font-bold text-primary mb-8">Kosakata Dasar</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($kosakata as $k)
            <div class="p-4 bg-surface-container-low rounded-2xl flex flex-col items-center gap-1 border border-surface-container-highest">
                <span class="text-lg font-bold text-primary">{{ $k['ngoko'] }}</span>
                <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">{{ $k['indonesia'] }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Kalimat Section -->
        <div class="bg-tertiary-container text-on-tertiary-container p-8 rounded-[2rem] tactile-card shadow-sm">
            <h3 class="font-headline text-2xl font-bold mb-6">Contoh Kalimat</h3>
            <div class="space-y-3">
                @foreach($kalimat as $kal)
                <div class="p-4 bg-white/10 backdrop-blur rounded-xl border border-white/20">
                    <p class="text-sm font-bold">{{ $kal }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Percakapan Section -->
        <div class="bg-surface-container-lowest p-8 rounded-[2rem] tactile-card border border-surface-container-high shadow-sm">
            <h3 class="font-headline text-2xl font-bold text-primary mb-6">Percakapan Singkat</h3>
            <div class="space-y-4">
                @foreach($percakapan as $p)
                <div class="flex gap-4 {{ $p['nama'] == 'A' ? '' : 'flex-row-reverse' }}">
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-on-primary text-[10px] font-bold flex-shrink-0">
                        {{ $p['nama'] }}
                    </div>
                    <div class="p-3 {{ $p['nama'] == 'A' ? 'bg-surface-container-low rounded-tr-xl rounded-br-xl rounded-bl-xl' : 'bg-primary/5 rounded-tl-xl rounded-bl-xl rounded-br-xl' }} max-w-[80%]">
                        <p class="text-xs font-medium">{{ $p['ucap'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
