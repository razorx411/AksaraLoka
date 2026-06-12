@extends('layouts.app')

@section('title', 'Papan Peringkat')
@section('subtitle', 'Liga AksaraLoka — Bersaing untuk menjadi yang terbaik')

@section('content')
<main class="max-w-3xl mx-auto py-6 px-4 md:px-0">
    <div class="bg-surface-container-lowest p-6 md:p-8 rounded-[2rem] tactile-card border border-outline-variant shadow-sm">
        
        {{-- Leaderboard Header --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h3 class="font-headline text-2xl text-primary font-bold">Liga AksaraLoka</h3>
                <p class="text-sm text-on-surface-variant">Peringkat global seluruh pembelajar se-Indonesia</p>
            </div>
            <div class="bg-tertiary/10 text-tertiary border border-tertiary/20 px-4 py-1.5 rounded-full flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">emoji_events</span>
                <span class="text-xs font-bold">{{ count($leaderboard) }} Pengguna</span>
            </div>
        </div>
        
        {{-- Leaderboard Table --}}
        <div class="flex flex-col gap-2">
            @foreach($leaderboard as $player)
            @php
                $isMe = (Auth::user()->nama == $player['nama']);
            @endphp
            <div class="flex items-center gap-4 p-4 rounded-2xl hover:bg-surface-container-low transition-colors group {{ $isMe ? 'bg-primary/5 border border-primary-container/30' : '' }}">
                
                {{-- Ranking Number --}}
                <span class="w-8 font-headline text-xl font-bold {{ $player['rank'] == 1 ? 'text-secondary' : ($player['rank'] == 2 ? 'text-outline' : 'text-on-surface-variant/50') }}">
                    {{ $player['rank'] }}
                </span>
                
                {{-- Avatar --}}
                <div class="w-12 h-12 rounded-full overflow-hidden border-2 shrink-0 {{ $player['rank'] == 1 ? 'border-secondary' : ($isMe ? 'border-primary' : 'border-outline-variant') }}">
                    <div class="w-full h-full bg-primary flex items-center justify-center text-on-primary font-bold">
                        {{ strtoupper(substr($player['nama'], 0, 1)) }}
                    </div>
                </div>
                
                {{-- Name & Level --}}
                <div class="flex-grow min-w-0">
                    <div class="flex items-center gap-2">
                        <p class="text-sm font-bold text-on-surface truncate">{{ $isMe ? 'Anda' : $player['nama'] }}</p>
                        @if($player['badge'])
                            <span class="text-lg shrink-0">{{ $player['badge'] }}</span>
                        @endif
                        @if($isMe)
                            <span class="bg-primary text-on-primary text-[8px] font-bold px-1.5 py-0.5 rounded uppercase tracking-wider shrink-0">Anda</span>
                        @endif
                    </div>
                    <p class="text-[10px] font-semibold text-on-surface-variant">Level {{ $player['level'] }}</p>
                </div>
                
                {{-- Points/XP --}}
                <div class="text-right shrink-0">
                    <p class="text-sm font-extrabold text-[#6b3f00]">{{ number_format($player['xp']) }} XP</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
