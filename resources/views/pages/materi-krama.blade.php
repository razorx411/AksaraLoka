@extends('layouts.app')

@section('title', 'Krama Alus')
@section('subtitle', 'Bahasa penghormatan untuk orang tua dan tokoh dihormati')

@section('content')
<div class="max-w-5xl mx-auto py-8 space-y-8">
    <div class="bg-primary-container text-on-primary-container p-10 rounded-[3rem] tactile-card shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <h3 class="font-headline text-3xl font-bold mb-4">Filosofi Krama Alus</h3>
            <p class="text-base opacity-90 max-w-2xl">
                Krama Alus bukan sekadar tingkatan bahasa, melainkan bentuk penghormatan dan kerendahan hati. Digunakan saat berbicara dengan orang yang lebih tua atau dalam situasi formal.
            </p>
        </div>
        <div class="absolute right-[-20px] bottom-[-20px] opacity-10">
            <span class="material-symbols-outlined text-[180px]">diversity_3</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Vocabulary Table -->
        <div class="bg-white p-8 rounded-[2rem] tactile-card border border-surface-container-high shadow-sm">
            <h3 class="font-headline text-2xl font-bold text-primary mb-6">Perbandingan Ngoko & Krama</h3>
            <div class="overflow-hidden rounded-2xl border border-surface-container-high">
                <table class="w-full text-left">
                    <thead class="bg-surface-container-low">
                        <tr>
                            <th class="p-4 text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">Ngoko</th>
                            <th class="p-4 text-[10px] font-bold text-primary uppercase tracking-widest">Krama Alus</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container-high">
                        @foreach($kosakata as $k)
                        <tr class="hover:bg-surface-container-lowest transition-colors">
                            <td class="p-4 text-sm font-medium text-on-surface-variant">{{ $k['ngoko'] }}</td>
                            <td class="p-4 text-sm font-bold text-primary">{{ $k['krama'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Conversation Section -->
        <div class="bg-surface-container-lowest p-8 rounded-[2rem] tactile-card border border-surface-container-high shadow-sm">
            <h3 class="font-headline text-2xl font-bold text-primary mb-6">Dialog Formal</h3>
            <div class="space-y-6">
                @foreach($percakapan as $p)
                <div class="flex gap-4 {{ $p['nama'] == 'A' ? '' : 'flex-row-reverse' }}">
                    <div class="w-10 h-10 rounded-full bg-secondary flex items-center justify-center text-on-secondary text-xs font-bold flex-shrink-0 shadow-sm">
                        {{ $p['nama'] }}
                    </div>
                    <div class="p-4 {{ $p['nama'] == 'A' ? 'bg-surface-container-low rounded-tr-2xl rounded-br-2xl rounded-bl-2xl' : 'bg-primary/5 rounded-tl-2xl rounded-bl-2xl rounded-br-2xl' }} max-w-[85%] border border-surface-container-highest">
                        <p class="text-sm font-medium italic">"{{ $p['ucap'] }}"</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-8 p-4 bg-secondary-container/30 rounded-xl border border-secondary-container">
                <p class="text-[10px] font-bold text-secondary uppercase tracking-widest mb-1">Tips Tata Krama</p>
                <p class="text-xs text-on-secondary-fixed-variant">Gunakan nada bicara yang lembut dan perlahan saat menggunakan Krama Alus.</p>
            </div>
        </div>
    </div>
</div>
@endsection
