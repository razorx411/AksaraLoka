@extends('layouts.landing')

@section('title', 'Lestarikan Budaya, Kuasai Aksara Jawa')

@section('content')
<main class="pt-16">

    {{-- ═══════════════════════════════════════
         HERO SECTION
    ═══════════════════════════════════════ --}}
    <section class="relative overflow-hidden py-14 md:py-24">
        {{-- Decorative bg blobs --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-primary/5 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-10 -left-10 w-60 h-60 bg-secondary/5 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-[1140px] mx-auto px-5 grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-center">
            {{-- Text --}}
            <div class="z-10 text-center md:text-left">
                <h1 class="font-headline text-[2.4rem] sm:text-5xl md:text-[3.5rem] text-primary mb-4 leading-[1.1] font-bold">
                    Lestarikan Budaya,<br>Kuasai Aksara Jawa
                </h1>
                <p class="text-base sm:text-lg text-on-surface-variant mb-8 max-w-lg mx-auto md:mx-0">
                    Platform belajar interaktif yang menggabungkan warisan leluhur dengan teknologi gamifikasi modern. Mulailah perjalananmu menguasai Hanacaraka hari ini.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center md:justify-start">
                    <a href="{{ route('register') }}"
                       class="px-8 py-3.5 bg-primary text-on-primary text-sm font-bold rounded-2xl tactile-button flex items-center justify-center gap-2 hover:bg-primary/90 hover:-translate-y-0.5 active:scale-95 transition-all duration-200 shadow-md">
                        Mulai Belajar Gratis
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                    <a href="https://www.youtube.com/watch?v=wIwWfmdIVUE&list=RDwIwWfmdIVUE&start_radio=1"
                       target="_blank" rel="noopener noreferrer"
                       class="px-8 py-3.5 bg-surface border-2 border-outline-variant text-on-surface text-sm font-bold rounded-2xl hover:bg-surface-container-high active:scale-95 transition-all duration-200 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-primary">play_circle</span>
                        Lihat Demo
                    </a>
                </div>
            </div>

            {{-- Hero Image --}}
            <div class="z-10 flex justify-center">
                <img alt="AksaraLoka Illustration"
                     class="w-full max-w-[320px] sm:max-w-[420px] md:max-w-full drop-shadow-xl"
                     src="{{ asset('assets/background/bg_awal.png') }}"/>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
         STATS SECTION
    ═══════════════════════════════════════ --}}
    <section class="py-8 md:py-12 bg-surface-container-low">
        <div class="max-w-[1140px] mx-auto px-5">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
                <div class="p-5 bg-white rounded-2xl tactile-card text-center border border-outline-variant/20 shadow-sm">
                    <h3 class="font-headline text-2xl text-primary mb-1">5+</h3>
                    <p class="text-xs font-semibold text-on-surface-variant">Tingkatan Materi</p>
                </div>
                <div class="p-5 bg-white rounded-2xl tactile-card text-center border border-outline-variant/20 shadow-sm">
                    <h3 class="font-headline text-2xl text-secondary mb-1">Puluhan</h3>
                    <p class="text-xs font-semibold text-on-surface-variant">Modul Belajar</p>
                </div>
                <div class="p-5 bg-white rounded-2xl tactile-card text-center border border-outline-variant/20 shadow-sm">
                    <h3 class="font-headline text-2xl text-tertiary mb-1">Ratusan</h3>
                    <p class="text-xs font-semibold text-on-surface-variant">Kamus Kosakata</p>
                </div>
                <div class="p-5 bg-white rounded-2xl tactile-card text-center border border-outline-variant/20 shadow-sm">
                    <h3 class="font-headline text-2xl text-primary mb-1">Top</h3>
                    <p class="text-xs font-semibold text-on-surface-variant">Sistem Peringkat</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
         ABOUT SECTION
    ═══════════════════════════════════════ --}}
    <section class="py-12 md:py-20 overflow-hidden scroll-mt-20" id="tentang">
        <div class="max-w-[1140px] mx-auto px-5">
            <div class="flex flex-col md:flex-row items-center gap-10">
                {{-- Images --}}
                <div class="flex-1 w-full order-2 md:order-1">
                    <div class="grid grid-cols-2 gap-3 md:gap-4">
                        <img class="rounded-2xl h-44 md:h-64 w-full object-cover shadow-lg transform -rotate-2"
                             src="https://lh3.googleusercontent.com/aida-public/AB6AXuCfjJ1ss2boNbNlAzi2MXzKQQ-Zi3b5zsqjdD9juwnTpW7CwYJGCC9zO-1PMplgD5U_aAH2OziPCFI_wbRzgsFrUG1GbAadeemRphbJHKMPLjvpu8sLe2wAeJALoa1JthBG0J0ECsr2cNntfbjUcOoq-8H5H5uILSeNY3aH2tcMGhWD3rlA6KG2Kf4SLFba8lkO18nQcnXzwBiidwsURCKY07gqAeuuyPJAWaHxmYVCgpUoJKrkAiAT_-svtAgxvvYnU6dV7IP9YAA"/>
                        <img class="rounded-2xl h-44 md:h-64 w-full object-cover shadow-lg transform translate-y-4 rotate-2"
                             src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_Ig2BxAQm9lpOE6GGHW02mreb0elST-SYfBstIZNBrHlg3Jh91eWLRUJdeqloWUg7VRJ6BrvVhhwRHge355q32rUoij4N3v3a6DPwymLdqGwyrdV0ul5fZZ4XAXPgazc1sS5El8Sikob9ctr0HVK7SKPoBGY26sKkS6VSGb_esi6RaOHl9GsCPBSW0nji8CuUJdrnPkH1xKzgogmI89bXzpvNIFwVPo2zmpFHdTxMpmRi0k90GrfHAtafLUVoCeWJRrTVZPQF7EM"/>
                    </div>
                </div>
                {{-- Text --}}
                <div class="flex-1 order-1 md:order-2 text-center md:text-left">
                    <h2 class="font-headline text-3xl md:text-4xl text-primary mb-4 font-bold">Menghubungkan Tradisi<br class="hidden md:block"> dengan Masa Depan</h2>
                    <p class="text-base text-on-surface-variant mb-4">
                        Aksaraloka lahir dari kegelisahan akan mulai memudarnya kemampuan generasi muda dalam membaca dan menulis Aksara Jawa. Kami percaya bahwa bahasa bukan sekadar alat komunikasi, melainkan wadah nilai-nilai luhur bangsa.
                    </p>
                    <p class="text-base text-on-surface-variant mb-6 hidden sm:block">
                        Misi kami adalah mendemokratisasi akses pembelajaran Aksara Jawa melalui platform yang menyenangkan, mudah diakses, dan relevan dengan gaya hidup modern.
                    </p>
                    <div class="flex items-center gap-4 p-4 bg-primary/5 rounded-2xl border-l-4 border-primary text-left">
                        <span class="material-symbols-outlined text-primary text-3xl shrink-0">volunteer_activism</span>
                        <div>
                            <p class="text-sm font-bold text-primary">Misi Pelestarian</p>
                            <p class="text-on-surface-variant text-xs font-medium mt-0.5">Setiap kuis yang kamu kerjakan membantu melestarikan identitas bangsa.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
         FEATURES SECTION
    ═══════════════════════════════════════ --}}
    <section class="py-12 md:py-20 bg-primary text-on-primary scroll-mt-20" id="fitur">
        <div class="max-w-[1140px] mx-auto px-5">
            <div class="text-center mb-10 md:mb-14">
                <h2 class="font-headline text-3xl md:text-4xl mb-3 font-bold">Belajar Lebih Seru & Interaktif</h2>
                <p class="text-sm md:text-base text-on-primary/80 max-w-xl mx-auto">
                    Fitur-fitur unggulan yang dirancang khusus untuk memudahkan proses belajar Aksara Jawa.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <div class="bg-white/10 backdrop-blur p-6 md:p-8 rounded-3xl border border-white/20 hover:bg-white/15 transition-all group">
                    <div class="w-12 h-12 bg-secondary-container text-on-secondary-container rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[28px]">menu_book</span>
                    </div>
                    <h3 class="font-headline text-lg mb-2 font-bold">Materi & Kuis</h3>
                    <p class="text-sm text-on-primary/70 leading-relaxed">Belajar sistematis dari Aksara Nglegena hingga Pasangan dengan kuis interaktif di setiap tingkat.</p>
                </div>
                <div class="bg-white/10 backdrop-blur p-6 md:p-8 rounded-3xl border border-white/20 hover:bg-white/15 transition-all group">
                    <div class="w-12 h-12 bg-tertiary-fixed text-on-tertiary-fixed-variant rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[28px]">school</span>
                    </div>
                    <h3 class="font-headline text-lg mb-2 font-bold">Platform Kelas</h3>
                    <p class="text-sm text-on-primary/70 leading-relaxed">Guru dapat membuat kelas digital, memberikan tugas, dan memantau perkembangan siswa.</p>
                </div>
                <div class="bg-white/10 backdrop-blur p-6 md:p-8 rounded-3xl border border-white/20 hover:bg-white/15 transition-all group">
                    <div class="w-12 h-12 bg-on-secondary-container text-white rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[28px]">forum</span>
                    </div>
                    <h3 class="font-headline text-lg mb-2 font-bold">Obrolan & Teman</h3>
                    <p class="text-sm text-on-primary/70 leading-relaxed">Cari teman baru, kirim permintaan, dan berdiskusi lewat chat real-time.</p>
                </div>
                <div class="bg-white/10 backdrop-blur p-6 md:p-8 rounded-3xl border border-white/20 hover:bg-white/15 transition-all group">
                    <div class="w-12 h-12 bg-white text-primary rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[28px]">workspace_premium</span>
                    </div>
                    <h3 class="font-headline text-lg mb-2 font-bold">Gamifikasi Seru</h3>
                    <p class="text-sm text-on-primary/70 leading-relaxed">Kumpulkan XP, pertahankan streak harian, dan bersaing di papan peringkat global.</p>
                </div>
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('fitur') }}"
                   class="px-8 py-3.5 bg-white text-primary text-sm font-bold rounded-2xl inline-flex items-center gap-2 hover:bg-white/90 hover:scale-105 active:scale-95 transition-all duration-200 shadow-md">
                    Jelajahi Semua Fitur
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
         AKSARA SHOWCASE
    ═══════════════════════════════════════ --}}
    <section class="py-12 md:py-20">
        <div class="max-w-[1140px] mx-auto px-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <div class="text-center md:text-left">
                    <h2 class="font-headline text-3xl md:text-4xl text-primary mb-4 font-bold">Mengenal Indahnya Hanacaraka</h2>
                    <p class="text-base text-on-surface-variant mb-8">
                        Setiap aksara memiliki cerita dan makna filosofis yang mendalam. Aksaraloka membantu Anda membedah setiap detailnya.
                    </p>
                    <div class="space-y-3 text-left">
                        @foreach(['Materi komprehensif: Nglegena, Sandhangan, Pasangan, dll.', 'Kuis untuk mengukur pemahaman di setiap tahap.', 'Kamus kosakata bahasa Jawa lengkap dengan tingkatannya.'] as $item)
                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container shrink-0 mt-0.5">
                                <span class="material-symbols-outlined text-[16px]">check</span>
                            </div>
                            <p class="text-sm md:text-base text-on-surface">{{ $item }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 md:gap-4">
                    @foreach([['ꦲ','Ha (Hana)','border-outline-variant/30'],['ꦤ','Na (Nata)','border-secondary border-2'],['ꦕ','Ca (Caraka)','border-outline-variant/30'],['ꦫ','Ra (Rasa)','border-outline-variant/30']] as [$char,$label,$border])
                    <div class="bg-white p-6 md:p-10 rounded-3xl tactile-card flex flex-col items-center justify-center border {{ $border }} text-center shadow-sm">
                        <span class="text-5xl md:text-[64px] font-bold text-primary mb-2 leading-none aksara-font">{{ $char }}</span>
                        <p class="text-xs md:text-sm font-semibold text-on-surface-variant">{{ $label }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
         CTA SECTION
    ═══════════════════════════════════════ --}}
    <section class="py-10 md:py-16 mb-10 px-5">
        <div class="max-w-[1140px] mx-auto">
            <div class="relative bg-secondary-container rounded-[2rem] md:rounded-[3rem] p-8 md:p-14 overflow-hidden text-center">
                <div class="absolute top-0 right-0 p-4 opacity-10 pointer-events-none">
                    <span class="material-symbols-outlined text-[160px] md:text-[200px]" style="font-variation-settings: 'FILL' 1;">history_edu</span>
                </div>
                <div class="relative z-10">
                    <h2 class="font-headline text-3xl md:text-4xl text-on-secondary-container mb-3 font-bold">Siap Menjadi Ahli Aksara?</h2>
                    <p class="text-sm md:text-base text-on-secondary-fixed-variant mb-8 max-w-md mx-auto">
                        Gabung dengan ribuan pelajar dan buktikan cintamu pada budaya dengan menguasai Aksara Jawa.
                    </p>
                    <a href="{{ route('register') }}"
                       class="px-8 py-3.5 bg-primary text-on-primary text-sm font-bold rounded-2xl inline-flex items-center gap-2 hover:bg-primary/90 hover:-translate-y-0.5 active:scale-95 transition-all duration-200 shadow-md w-full sm:w-auto justify-center">
                        Mulai Sekarang
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection

