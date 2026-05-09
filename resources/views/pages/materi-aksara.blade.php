@extends('layouts.app')

@section('title', 'Aksara Nglegena')
@section('subtitle', 'Huruf dasar Hanacaraka')

@section('content')
<div class="max-w-5xl mx-auto py-8">
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-12">
        @foreach($hanacaraka as $item)
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
                @foreach($sandhangan as $s)
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
                @foreach($contohKata as $c)
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
</div>
@endsection
