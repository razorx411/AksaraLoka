@extends('layouts.app')

@section('title', 'Perpustakaan Aksara')
@section('subtitle', 'Panduan Referensi Hanacaraka')

@section('content')
<section class="max-w-[1140px] mx-auto px-4 py-6">
    <!-- Search and Filter Bar -->
    <div class="bg-surface-container rounded-2xl p-4 mb-10 flex flex-col md:flex-row gap-4 items-center shadow-sm">
        <div class="relative w-full md:w-1/3">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
            <input class="w-full pl-12 pr-4 py-2 bg-surface rounded-xl border-none ring-2 ring-transparent focus:ring-primary focus:outline-none transition-all text-sm text-on-surface" placeholder="Cari karakter atau suara..." type="text"/>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <button class="px-6 py-2 rounded-full bg-secondary-container text-on-secondary-container font-bold border-b-2 border-secondary hover:translate-y-[-1px] transition-all text-xs">Semua</button>
            <button class="px-6 py-2 rounded-full bg-surface hover:bg-surface-container-high text-on-surface-variant font-medium transition-all text-xs border border-surface-container-highest">Konsonan</button>
            <button class="px-6 py-2 rounded-full bg-surface hover:bg-surface-container-high text-on-surface-variant font-medium transition-all text-xs border border-surface-container-highest">Vokal</button>
            <button class="px-6 py-2 rounded-full bg-surface hover:bg-surface-container-high text-on-surface-variant font-medium transition-all text-xs border border-surface-container-highest">Tanda Baca</button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($materiList as $materi)
        <a href="{{ $materi['href'] }}" class="bg-surface-container-lowest border border-surface-container-high p-8 rounded-[2rem] flex flex-col gap-4 group hover:border-primary transition-all tactile-card relative overflow-hidden shadow-sm">
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
                <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold rounded-full uppercase tracking-wider">{{ $materi['tag'] }}</span>
                <span class="material-symbols-outlined text-outline group-hover:text-primary transition-colors">arrow_forward</span>
            </div>
            <div>
                <h3 class="font-headline text-2xl text-on-surface font-bold mb-2">{{ $materi['judul'] }}</h3>
                <p class="text-sm text-on-surface-variant line-clamp-2">{{ $materi['desc'] }}</p>
            </div>
        </a>
        @endforeach
    </div>
    <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2 bg-gradient-to-br from-primary to-primary-container rounded-3xl p-8 flex flex-col justify-between relative overflow-hidden shadow-xl">
            <div class="relative z-10">
                <span class="bg-secondary-container text-on-secondary-container px-4 py-1 rounded-full text-xs font-bold mb-4 inline-block">Tips Pro</span>
                <h2 class="font-headline text-3xl text-white mb-4 font-bold">Menguasai 'Pasangan'</h2>
                <p class="text-on-primary-container max-w-md text-base opacity-90">Pasangan digunakan untuk 'mematikan' vokal dari karakter sebelumnya. Klik karakter mana saja di atas untuk melihat bentuk pasangan dan urutan goresannya.</p>
            </div>
            <div class="mt-10 z-10">
                <button class="bg-white text-primary px-8 py-3 rounded-xl font-bold border-b-4 border-surface-dim hover:translate-y-[-2px] transition-all text-sm">Coba Mode Latihan</button>
            </div>
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
        </div>
        <div class="bg-surface-container-high rounded-3xl p-8 flex flex-col items-center text-center gap-4">
            <div class="w-16 h-16 bg-secondary-fixed rounded-full flex items-center justify-center mb-2">
                <span class="material-symbols-outlined text-secondary text-[32px]" style="font-variation-settings: 'FILL' 1;">military_tech</span>
            </div>
            <h3 class="font-headline text-xl text-on-surface font-bold">Pelajar Mingguan</h3>
            <p class="text-on-surface-variant text-sm mb-4">Kamu telah menguasai 12 karakter baru minggu ini. Jaga terus semangatmu!</p>
            <div class="w-full bg-surface-container-highest rounded-full h-2">
                <div class="bg-primary h-full rounded-full w-[65%]"></div>
            </div>
            <span class="text-[10px] font-bold text-on-surface-variant">65% menuju level berikutnya</span>
        </div>
    </div>

    <!-- Asymmetric Grid Section for Cultural Context -->
    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-3xl overflow-hidden shadow-md border border-surface-container-high flex flex-col">
            <div class="h-48 w-full overflow-hidden">
                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDV5I1na-ZS3z_fuFPAqDuB1Uz1VSVOzFFaeYTWTyXbL3UvfanUcZRTAXRoGhEiRVxNhDitznsVEwmWucvqI0KvgF6GpyiZJDjPiBAk5sQaWsdhnrGkAK3nclrU-pB7wZ4X1qlOm0SyJQdri2wtN05tg2HQXjfUIqsHsX2pjV2nZZGQIPMSJugcW8fmYGUsLaHdWwcAvDxg_a1itriTE1LUBBjTGcgfMeqbeNXkxqzHqA_WVEPDktOuGy7n7CqLw3ns2dsGoBP8oA4"/>
            </div>
            <div class="p-6">
                <h3 class="font-headline text-xl text-on-surface mb-2 font-bold">Kisah Aji Saka</h3>
                <p class="text-on-surface-variant text-sm">Temukan asal-usul legendaris Hanacaraka, di mana setiap huruf menghormati kesetiaan dan pengorbanan terakhir dari dua utusan yang berbakti.</p>
                <a class="mt-4 inline-flex items-center text-sm font-bold text-primary hover:underline" href="#">
                    Baca Legendanya
                    <span class="material-symbols-outlined ml-1 text-sm">arrow_forward</span>
                </a>
            </div>
        </div>
        <div class="bg-white rounded-3xl overflow-hidden shadow-md border border-surface-container-high flex flex-col">
            <div class="h-48 w-full overflow-hidden">
                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB-tTvXdIowCezh1jH3fg0I7Y7bG6mCe5991i4Z2IedInV8KvY-dP1RoZ73Vk4kkGJIX4E3WprjmGpsxaCoNV1SOIiGJ67pOR7Or8genLwaJvL9nLLYY7WL0SNRvT7Kxyt1TCdD5tRcIJ5tMIRbzDkOk_TjppVxXLZGKwu5rlosNsCH6FgZWYUDjTOQlbXkUPt80NTmNcFbKvtEJRW85Cj5o_DsZc-sOQL6Zg_tGNwH12Y__LAemWlbGKSgcfJaQKvZETd4f_WFh_E"/>
            </div>
            <div class="p-6">
                <h3 class="font-headline text-xl text-on-surface mb-2 font-bold">Arketipe Manuskrip</h3>
                <p class="text-on-surface-variant text-sm">Pelajari perbedaan antara akar 'Kawi' dan bentuk 'Nglegena' modern yang digunakan di Jawa Tengah dan Jawa Timur saat ini.</p>
                <a class="mt-4 inline-flex items-center text-sm font-bold text-primary hover:underline" href="#">
                    Jelajahi Arketipe
                    <span class="material-symbols-outlined ml-1 text-sm">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
