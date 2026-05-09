@extends('layouts.landing')

@section('title', 'Lestarikan Budaya, Kuasai Aksara Jawa')

@section('content')
<main class="pt-20">
    <!-- Hero Section -->
    <section class="relative overflow-hidden py-10 md:py-[100px]">
        <div class="max-w-[1140px] mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div class="z-10">
                <div class="inline-flex items-center gap-1 px-2 py-1 bg-secondary-container text-on-secondary-container rounded-full mb-4">
                    {{-- icon dihapus karena kosong --}}
                    <span class="text-xs font-medium">Edukasi Budaya #1 di Indonesia</span>
                </div>
                <h1 class="font-headline text-5xl text-primary mb-4 leading-tight font-bold">Lestarikan Budaya, Kuasai Aksara Jawa</h1>
                <p class="text-lg text-on-surface-variant mb-10 max-w-lg">
                    Platform belajar interaktif yang menggabungkan warisan leluhur dengan teknologi gamifikasi modern. Mulailah perjalananmu menguasai Hanacaraka hari ini.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" class="px-10 py-4 bg-primary text-on-primary text-sm font-semibold rounded-xl tactile-button flex items-center justify-center gap-2">Mulai Belajar Gratis<span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                    <button class="px-10 py-4 bg-white border-2 border-primary/20 text-primary text-sm font-semibold rounded-xl hover:bg-primary/5 transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">play_circle</span>
                        Lihat Demo
                    </button>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -top-10 -right-10 w-64 h-64 bg-secondary-fixed/30 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-primary-fixed/30 rounded-full blur-3xl"></div>
                <div class="relative rounded-[2rem] overflow-hidden tactile-card shadow-xl border border-surface-variant transform rotate-2">
                    <img alt="Candi Borobudur detail" class="w-full aspect-square object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCNimxSaIPY4z_VMQ-_MauW1w8ehqBCQHqGhyo6ZPEZzNOKORW9UMx4iEYxFtKbP17hqW_qjjqoIkpappfdlouA7uEZ1r7lEUv2m9wEHflth-D3lT1dun7Spipl3DIc7DS2NIUoF0Hb05LbynL0KAv1cWwiCHu6bZpTQ2QM6mde20dhm2H5wsnBF0fGlwEG2Zl-c4D9FCCUaHUNMKxs2DgqNzwlD-KlhIF5UzJLE9TQogdPkF1bW3ohR75yNemz6OmHP531hB7IxuM"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 p-4 bg-white/90 backdrop-blur rounded-xl">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-secondary rounded-full flex items-center justify-center text-on-secondary">
                                <span class="material-symbols-outlined">school</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-primary">Kuis Harian: Hanacaraka</p>
                                <p class="text-[12px] text-on-surface-variant">+50 Poin XP Tersedia</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section (Bento Style) -->
    <section class="py-10 bg-surface-container-low">
        <div class="max-w-[1140px] mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="p-6 bg-white rounded-2xl tactile-card text-center">
                    <h3 class="font-headline text-2xl text-primary mb-1">50K+</h3>
                    <p class="text-xs font-medium text-on-surface-variant">Pelajar Aktif</p>
                </div>
                <div class="p-6 bg-white rounded-2xl tactile-card text-center">
                    <h3 class="font-headline text-2xl text-secondary mb-1">100+</h3>
                    <p class="text-xs font-medium text-on-surface-variant">Modul Aksara</p>
                </div>
                <div class="p-6 bg-white rounded-2xl tactile-card text-center">
                    <h3 class="font-headline text-2xl text-tertiary mb-1">4.9</h3>
                    <p class="text-xs font-medium text-on-surface-variant">Rating Pengguna</p>
                </div>
                <div class="p-6 bg-white rounded-2xl tactile-card text-center">
                    <h3 class="font-headline text-2xl text-primary-container mb-1">12M+</h3>
                    <p class="text-xs font-medium text-on-surface-variant">Latihan Selesai</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="py-10 overflow-hidden scroll-mt-20" id="tentang">
        <div class="max-w-[1140px] mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-10">
                <div class="flex-1 order-2 md:order-1">
                    <div class="grid grid-cols-2 gap-4">
                        <img class="rounded-3xl h-64 w-full object-cover shadow-lg transform -rotate-3" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCfjJ1ss2boNbNlAzi2MXzKQQ-Zi3b5zsqjdD9juwnTpW7CwYJGCC9zO-1PMplgD5U_aAH2OziPCFI_wbRzgsFrUG1GbAadeemRphbJHKMPLjvpu8sLe2wAeJALoa1JthBG0J0ECsr2cNntfbjUcOoq-8H5H5uILSeNY3aH2tcMGhWD3rlA6KG2Kf4SLFba8lkO18nQcnXzwBiidwsURCKY07gqAeuuyPJAWaHxmYVCgpUoJKrkAiAT_-svtAgxvvYnU6dV7IP9YAA"/>
                        <img class="rounded-3xl h-64 w-full object-cover shadow-lg transform translate-y-6 rotate-3" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_Ig2BxAQm9lpOE6GGHW02mreb0elST-SYfBstIZNBrHlg3Jh91eWLRUJdeqloWUg7VRJ6BrvVhhwRHge355q32rUoij4N3v3a6DPwymLdqGwyrdV0ul5fZZ4XAXPgazc1sS5El8Sikob9ctr0HVK7SKPoBGY26sKkS6VSGb_esi6RaOHl9GsCPBSW0nji8CuUJdrnPkH1xKzgogmI89bXzpvNIFwVPo2zmpFHdTxMpmRi0k90GrfHAtafLUVoCeWJRrTVZPQF7EM"/>
                    </div>
                </div>
                <div class="flex-1 order-1 md:order-2">
                    <h2 class="font-headline text-3xl text-primary mb-4 font-semibold">Menghubungkan Tradisi dengan Masa Depan</h2>
                    <p class="text-base text-on-surface-variant mb-4">
                        Aksaraloka lahir dari kegelisahan akan mulai memudarnya kemampuan generasi muda dalam membaca dan menulis Aksara Jawa. Kami percaya bahwa bahasa bukan sekadar alat komunikasi, melainkan wadah nilai-nilai luhur bangsa.
                    </p>
                    <p class="text-base text-on-surface-variant mb-6">
                        Misi kami adalah mendemokratisasi akses pembelajaran Aksara Jawa melalui platform yang menyenangkan, mudah diakses, dan relevan dengan gaya hidup modern. Kami adalah "Wise Companion" yang akan menuntun setiap langkah belajarmu.
                    </p>
                    <div class="flex items-center gap-4 p-4 bg-primary/5 rounded-xl border-l-4 border-primary">
                        <span class="material-symbols-outlined text-primary text-[32px]">volunteer_activism</span>
                        <div>
                            <p class="text-sm font-semibold text-primary">Misi Pelestarian</p>
                            <p class="text-on-surface-variant text-xs font-medium">Setiap kuis yang kamu kerjakan membantu melestarikan identitas bangsa.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-10 bg-primary text-on-primary scroll-mt-20" id="fitur">
        <div class="max-w-[1140px] mx-auto px-6">
            <div class="text-center mb-10">
                <h2 class="font-headline text-4xl mb-2 font-bold">Belajar Menjadi Petualangan</h2>
                <p class="text-lg text-on-primary-container max-w-2xl mx-auto">
                    Fitur-fitur unggulan yang dirancang khusus untuk membuat proses belajar Aksara Jawa semudah bermain game favoritmu.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="bg-white/10 backdrop-blur p-10 rounded-[2rem] border border-white/20 hover:bg-white/15 transition-all group">
                    <div class="w-14 h-14 bg-secondary-container text-on-secondary-container rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[32px]">map</span>
                    </div>
                    <h3 class="font-headline text-2xl mb-4 font-semibold">Gamified Path</h3>
                    <p class="text-base text-on-primary-container">
                        Ikuti peta perjalanan "The Path" yang membawamu dari tingkat pemula hingga mahir dengan tantangan yang seru di setiap posnya.
                    </p>
                </div>
                <!-- Feature 2 -->
                <div class="bg-white/10 backdrop-blur p-10 rounded-[2rem] border border-white/20 hover:bg-white/15 transition-all group">
                    <div class="w-14 h-14 bg-tertiary-fixed text-on-tertiary-fixed-variant rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[32px]">draw</span>
                    </div>
                    <h3 class="font-headline text-2xl mb-4 font-semibold">Interactive Lessons</h3>
                    <p class="text-base text-on-primary-container">
                        Latihan menulis langsung di layar dengan feedback instan menggunakan teknologi pendeteksi guratan aksara yang akurat.
                    </p>
                </div>
                <!-- Feature 3 -->
                <div class="bg-white/10 backdrop-blur p-10 rounded-[2rem] border border-white/20 hover:bg-white/15 transition-all group">
                    <div class="w-14 h-14 bg-on-secondary-container text-white rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[32px]">leaderboard</span>
                    </div>
                    <h3 class="font-headline text-2xl mb-4 font-semibold">Social Leaderboard</h3>
                    <p class="text-base text-on-primary-container">
                        Bersaing secara sehat dengan teman atau sesama pelajar di seluruh Indonesia. Raih peringkat teratas dan kumpulkan badge eksklusif.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Aksara Showcase -->
    <section class="py-10">
        <div class="max-w-[1140px] mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <div>
                    <h2 class="font-headline text-3xl text-primary mb-4 font-semibold">Mengenal Indahnya Hanacaraka</h2>
                    <p class="text-lg text-on-surface-variant mb-10">
                        Setiap aksara memiliki cerita dan makna filosofis yang mendalam. Aksaraloka membantu Anda membedah setiap detailnya.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container flex-shrink-0 mt-1">
                                <span class="material-symbols-outlined text-[20px]">check</span>
                            </div>
                            <p class="text-base">Sistem pengulangan cerdas (Spaced Repetition)</p>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container flex-shrink-0 mt-1">
                                <span class="material-symbols-outlined text-[20px]">check</span>
                            </div>
                            <p class="text-base">Panduan fonetik asli untuk pelafalan yang tepat</p>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container flex-shrink-0 mt-1">
                                <span class="material-symbols-outlined text-[20px]">check</span>
                            </div>
                            <p class="text-base">Kamus digital Aksara Jawa lengkap</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white p-10 rounded-3xl tactile-card flex flex-col items-center justify-center border border-surface-variant text-center">
                        <span class="text-[64px] font-bold text-primary mb-2 leading-none aksara-font">ꦲ</span>
                        <p class="text-sm font-semibold text-on-surface-variant">Ha (Hana)</p>
                    </div>
                    <div class="bg-white p-10 rounded-3xl tactile-card flex flex-col items-center justify-center border-2 border-secondary text-center">
                        <span class="text-[64px] font-bold text-primary mb-2 leading-none aksara-font">ꦤ</span>
                        <p class="text-sm font-semibold text-on-surface-variant">Na (Nata)</p>
                    </div>
                    <div class="bg-white p-10 rounded-3xl tactile-card flex flex-col items-center justify-center border border-surface-variant text-center">
                        <span class="text-[64px] font-bold text-primary mb-2 leading-none aksara-font">ꦕ</span>
                        <p class="text-sm font-semibold text-on-surface-variant">Ca (Caraka)</p>
                    </div>
                    <div class="bg-white p-10 rounded-3xl tactile-card flex flex-col items-center justify-center border border-surface-variant text-center">
                        <span class="text-[64px] font-bold text-primary mb-2 leading-none aksara-font">ꦫ</span>
                        <p class="text-sm font-semibold text-on-surface-variant">Ra (Rasa)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-10 mb-10">
        <div class="max-w-[1140px] mx-auto px-6">
            <div class="relative bg-secondary-container rounded-[3rem] p-10 overflow-hidden text-center tactile-card">
                <div class="absolute top-0 right-0 p-6 opacity-10">
                    <span class="material-symbols-outlined text-[200px]" style="font-variation-settings: 'FILL' 1;">history_edu</span>
                </div>
                <div class="relative z-10">
                    <h2 class="font-headline text-4xl text-on-secondary-container mb-4 font-bold">Siap Menjadi Ahli Aksara?</h2>
                    <p class="text-lg text-on-secondary-fixed-variant mb-10 max-w-xl mx-auto">
                        Gabung dengan ribuan pelajar lainnya dan buktikan cintamu pada budaya dengan menguasai Aksara Jawa.
                    </p>
                    <a href="{{ route('register') }}" class="px-10 py-4 bg-primary text-on-primary text-sm font-semibold rounded-xl tactile-button inline-flex items-center gap-2">
                        Mulai Sekarang
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection