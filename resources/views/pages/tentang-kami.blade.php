@extends('layouts.landing')

@section('title', 'Tentang Kami')

@section('content')
<main class="pt-2">

    {{-- Hero Section --}}
    <section class="relative overflow-hidden py-16 md:py-24">
        {{-- Decorative background elements --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-secondary/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>

        <div class="max-w-[1140px] mx-auto px-6 text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-secondary-container text-on-secondary-container rounded-full mb-6">
                <span class="material-symbols-outlined text-base">groups</span>
                <span class="text-xs font-semibold">Kelompok 11 · MPSI & PemWeb</span>
            </div>
            <h1 class="font-headline text-5xl md:text-6xl text-primary mb-6 leading-tight font-bold">
                Tentang Kami
            </h1>
            <p class="text-lg text-on-surface-variant max-w-2xl mx-auto leading-relaxed">
                Kami adalah tim mahasiswa yang berdedikasi melestarikan warisan budaya Nusantara melalui inovasi teknologi pendidikan yang modern dan menyenangkan.
            </p>
        </div>
    </section>

    {{-- Misi & Visi Section --}}
    <section class="py-16 bg-surface-container-low">
        <div class="max-w-[1140px] mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Visi --}}
                <div class="bg-white rounded-[2rem] p-10 tactile-card border border-surface-variant group hover:border-primary/30 transition-all duration-300">
                    <div class="w-16 h-16 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[32px]">visibility</span>
                    </div>
                    <h2 class="font-headline text-2xl text-primary mb-4 font-bold">Visi Kami</h2>
                    <p class="text-base text-on-surface-variant leading-relaxed">
                        Menjadi platform edukasi budaya terdepan di Indonesia yang mampu menghubungkan generasi muda dengan kekayaan bahasa dan aksara Nusantara melalui pengalaman belajar digital yang inovatif, inklusif, dan menyenangkan.
                    </p>
                </div>
                {{-- Misi --}}
                <div class="bg-white rounded-[2rem] p-10 tactile-card border border-surface-variant group hover:border-primary/30 transition-all duration-300">
                    <div class="w-16 h-16 bg-secondary-container text-on-secondary-container rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[32px]">rocket_launch</span>
                    </div>
                    <h2 class="font-headline text-2xl text-primary mb-4 font-bold">Misi Kami</h2>
                    <ul class="text-base text-on-surface-variant leading-relaxed space-y-3">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">check_circle</span>
                            Mendemokratisasi akses pembelajaran Aksara Jawa secara gratis.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">check_circle</span>
                            Menghadirkan metode gamifikasi yang memotivasi pelajar.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">check_circle</span>
                            Membangun komunitas pelestari bahasa daerah Indonesia.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Nilai-Nilai Section --}}
    <section class="py-16">
        <div class="max-w-[1140px] mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="font-headline text-3xl text-primary mb-4 font-bold">Nilai yang Kami Pegang</h2>
                <p class="text-base text-on-surface-variant max-w-xl mx-auto">Prinsip-prinsip yang menjadi fondasi setiap keputusan kami.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center p-8 bg-white rounded-[2rem] tactile-card border border-surface-variant group hover:border-primary/30 transition-all duration-300">
                    <div class="w-14 h-14 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mb-5 mx-auto group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[28px]">favorite</span>
                    </div>
                    <h3 class="font-headline text-lg text-on-surface font-bold mb-2">Kecintaan Budaya</h3>
                    <p class="text-sm text-on-surface-variant">Setiap fitur lahir dari rasa cinta terhadap warisan budaya Jawa.</p>
                </div>
                <div class="text-center p-8 bg-white rounded-[2rem] tactile-card border border-surface-variant group hover:border-primary/30 transition-all duration-300">
                    <div class="w-14 h-14 bg-secondary-container text-on-secondary-container rounded-2xl flex items-center justify-center mb-5 mx-auto group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[28px]">emoji_objects</span>
                    </div>
                    <h3 class="font-headline text-lg text-on-surface font-bold mb-2">Inovasi</h3>
                    <p class="text-sm text-on-surface-variant">Menggabungkan tradisi dengan teknologi modern secara kreatif.</p>
                </div>
                <div class="text-center p-8 bg-white rounded-[2rem] tactile-card border border-surface-variant group hover:border-primary/30 transition-all duration-300">
                    <div class="w-14 h-14 bg-tertiary-fixed text-on-tertiary-fixed-variant rounded-2xl flex items-center justify-center mb-5 mx-auto group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[28px]">diversity_3</span>
                    </div>
                    <h3 class="font-headline text-lg text-on-surface font-bold mb-2">Inklusivitas</h3>
                    <p class="text-sm text-on-surface-variant">Platform terbuka untuk semua kalangan tanpa batasan.</p>
                </div>
                <div class="text-center p-8 bg-white rounded-[2rem] tactile-card border border-surface-variant group hover:border-primary/30 transition-all duration-300">
                    <div class="w-14 h-14 bg-primary-container text-on-primary-container rounded-2xl flex items-center justify-center mb-5 mx-auto group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[28px]">school</span>
                    </div>
                    <h3 class="font-headline text-lg text-on-surface font-bold mb-2">Edukasi Berkualitas</h3>
                    <p class="text-sm text-on-surface-variant">Materi terstruktur dan tervalidasi untuk hasil belajar optimal.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Meet The Team Section --}}
    <section class="py-16 bg-primary text-on-primary">
        <div class="max-w-[1140px] mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="font-headline text-4xl mb-3 font-bold">Tim Kami</h2>
                <p class="text-lg text-on-primary-container max-w-2xl mx-auto">
                    Mahasiswa Sistem Informasi UPN "Veteran" Jawa Timur yang bersemangat melestarikan budaya lewat teknologi.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                {{-- Member 1: Hafid --}}
                <div class="bg-white/10 backdrop-blur rounded-[2rem] border border-white/20 overflow-hidden group hover:bg-white/15 transition-all duration-300">
                    <div class="aspect-square bg-white/5 flex items-center justify-center overflow-hidden">
                        {{-- Placeholder foto: ganti src dengan foto asli --}}
                        <img src="{{ asset('assets/images/img_hafid3.jpeg') }}" 
                             alt="Foto Hafid" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                             style="object-position: center 70%"
                             onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'w-full h-full flex flex-col items-center justify-center gap-3\'><span class=\'material-symbols-outlined text-[80px] text-white/30\'>person</span><span class=\'text-xs text-white/40 font-medium\'>Foto belum tersedia</span></div>';">
                    </div>
                    <div class="p-8 text-center">
                        <h3 class="font-headline text-xl font-bold mb-1">Hafid</h3>
                        <p class="text-sm text-on-primary-container font-medium mb-4">Full-Stack Developer</p>
                        <p class="text-sm text-white/70 leading-relaxed">
                            Bertanggung jawab atas arsitektur sistem, pengembangan backend Laravel, dan integrasi frontend.
                        </p>
                        <div class="flex justify-center gap-3 mt-5">
                            <a href="https://github.com/razorx411" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/25 transition-all">
                                <i class="fa-brands fa-github text-sm"></i>
                            </a>
                            <a href="https://www.instagram.com/oryvexia/" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/25 transition-all">
                                <i class="fa-brands fa-instagram text-sm"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/hafid-fathurrohman-99455b325/" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/25 transition-all">
                                <i class="fa-brands fa-linkedin-in text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Member 2: Zaki --}}
                <div class="bg-white/10 backdrop-blur rounded-[2rem] border border-white/20 overflow-hidden group hover:bg-white/15 transition-all duration-300">
                    <div class="aspect-square bg-white/5 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('assets/images/img_zaki.jpeg') }}" 
                             alt="Foto Zaki" 
                             class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500"
                             onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'w-full h-full flex flex-col items-center justify-center gap-3\'><span class=\'material-symbols-outlined text-[80px] text-white/30\'>person</span><span class=\'text-xs text-white/40 font-medium\'>Foto belum tersedia</span></div>';">
                    </div>
                    <div class="p-8 text-center">
                        <h3 class="font-headline text-xl font-bold mb-1">Zaki</h3>
                        <p class="text-sm text-on-primary-container font-medium mb-4">UI/UX Designer</p>
                        <p class="text-sm text-white/70 leading-relaxed">
                            Merancang antarmuka pengguna yang intuitif, estetis, dan menghadirkan pengalaman belajar terbaik.
                        </p>
                        <div class="flex justify-center gap-3 mt-5">
                            <a href="https://github.com/Revio225" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/25 transition-all">
                                <i class="fa-brands fa-github text-sm"></i>
                            </a>
                            <a href="https://www.instagram.com/wiraksa_aa/" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/25 transition-all">
                                <i class="fa-brands fa-instagram text-sm"></i>
                            </a>
                            <a href="#" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/25 transition-all">
                                <i class="fa-brands fa-linkedin-in text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Member 3: Dwiki --}}
                <div class="bg-white/10 backdrop-blur rounded-[2rem] border border-white/20 overflow-hidden group hover:bg-white/15 transition-all duration-300">
                    <div class="aspect-square bg-white/5 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('assets/images/img_dwiki.jpeg') }}" 
                             alt="Foto Dwiki" 
                             class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500"
                             onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'w-full h-full flex flex-col items-center justify-center gap-3\'><span class=\'material-symbols-outlined text-[80px] text-white/30\'>person</span><span class=\'text-xs text-white/40 font-medium\'>Foto belum tersedia</span></div>';">
                    </div>
                    <div class="p-8 text-center">
                        <h3 class="font-headline text-xl font-bold mb-1">Dwiki</h3>
                        <p class="text-sm text-on-primary-container font-medium mb-4">Content & QA</p>
                        <p class="text-sm text-white/70 leading-relaxed">
                            Menyusun materi pembelajaran aksara dan memastikan kualitas konten serta fungsionalitas platform.
                        </p>
                        <div class="flex justify-center gap-3 mt-5">
                            <a href="https://github.com/auliadwiki54" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/25 transition-all">
                                <i class="fa-brands fa-github text-sm"></i>
                            </a>
                            <a href="https://www.instagram.com/kkkiii_aar_/" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/25 transition-all">
                                <i class="fa-brands fa-instagram text-sm"></i>
                            </a>
                            <a href="#" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/25 transition-all">
                                <i class="fa-brands fa-linkedin-in text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pembimbing --}}
            <div class="bg-white/10 backdrop-blur rounded-[2rem] border border-white/20 p-8 md:p-10">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="w-28 h-28 rounded-full bg-white/10 flex items-center justify-center overflow-hidden shrink-0 border-2 border-white/20">
                        <img src="{{ asset('assets/images/team/pembimbing.jpg') }}" 
                             alt="Foto Dosen Pembimbing" 
                             class="w-full h-full object-cover"
                             onerror="this.style.display='none'; this.parentElement.innerHTML='<span class=\'material-symbols-outlined text-[48px] text-white/30\'>school</span>';">
                    </div>
                    <div class="text-center md:text-left">
                        <p class="text-xs font-bold uppercase tracking-widest text-on-primary-container mb-2">Dosen Pembimbing</p>
                        <h3 class="font-headline text-2xl font-bold mb-2">Bu Reisa Permatasari, ST, M.Kom.</h3>
                        <p class="text-base text-white/70 leading-relaxed max-w-xl">
                            Dosen Sistem Informasi UPN "Veteran" Jawa Timur yang membimbing pengembangan platform AksaraLoka dari konsep hingga implementasi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Latar Belakang Section --}}
    <section class="py-16">
        <div class="max-w-[1140px] mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="flex-1">
                    <h2 class="font-headline text-3xl text-primary mb-6 font-bold">Mengapa AksaraLoka?</h2>
                    <div class="space-y-5">
                        <p class="text-base text-on-surface-variant leading-relaxed">
                            AksaraLoka lahir dari kegelisahan akan mulai memudarnya kemampuan generasi muda dalam membaca dan menulis Aksara Jawa. Di era digital, semakin sedikit yang mengenal keindahan Hanacaraka.
                        </p>
                        <p class="text-base text-on-surface-variant leading-relaxed">
                            Kami percaya bahwa teknologi bisa menjadi jembatan antara tradisi dan modernitas. Dengan pendekatan gamifikasi — XP, streak, leaderboard, dan kuis interaktif — kami menghadirkan cara baru yang menyenangkan untuk mempelajari aksara daerah.
                        </p>
                        <div class="flex items-center gap-4 p-5 bg-primary/5 rounded-xl border-l-4 border-primary">
                            <span class="material-symbols-outlined text-primary text-[32px]">volunteer_activism</span>
                            <div>
                                <p class="text-sm font-bold text-primary">Proyek Mata Kuliah</p>
                                <p class="text-on-surface-variant text-xs font-medium">Dikembangkan sebagai tugas akhir mata kuliah MPSI & Pemrograman Web.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-6 bg-white rounded-2xl tactile-card text-center border border-surface-variant">
                            <span class="material-symbols-outlined text-primary text-[40px] mb-3">history_edu</span>
                            <h3 class="font-headline text-2xl text-primary mb-1 font-bold">20+</h3>
                            <p class="text-xs font-medium text-on-surface-variant">Aksara Dasar</p>
                        </div>
                        <div class="p-6 bg-white rounded-2xl tactile-card text-center border border-surface-variant">
                            <span class="material-symbols-outlined text-secondary text-[40px] mb-3">quiz</span>
                            <h3 class="font-headline text-2xl text-secondary mb-1 font-bold">50+</h3>
                            <p class="text-xs font-medium text-on-surface-variant">Soal Kuis</p>
                        </div>
                        <div class="p-6 bg-white rounded-2xl tactile-card text-center border border-surface-variant">
                            <span class="material-symbols-outlined text-tertiary text-[40px] mb-3">menu_book</span>
                            <h3 class="font-headline text-2xl text-tertiary mb-1 font-bold">5+</h3>
                            <p class="text-xs font-medium text-on-surface-variant">Modul Materi</p>
                        </div>
                        <div class="p-6 bg-white rounded-2xl tactile-card text-center border border-surface-variant">
                            <span class="material-symbols-outlined text-primary text-[40px] mb-3">code</span>
                            <h3 class="font-headline text-2xl text-primary mb-1 font-bold">Laravel</h3>
                            <p class="text-xs font-medium text-on-surface-variant">Tech Stack</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 mb-10">
        <div class="max-w-[1140px] mx-auto px-6">
            <div class="relative bg-secondary-container rounded-[3rem] p-12 overflow-hidden text-center tactile-card">
                <div class="absolute top-0 right-0 p-6 opacity-10">
                    <span class="material-symbols-outlined text-[200px]" style="font-variation-settings: 'FILL' 1;">groups</span>
                </div>
                <div class="relative z-10">
                    <h2 class="font-headline text-4xl text-on-secondary-container mb-4 font-bold">Bergabunglah Bersama Kami</h2>
                    <p class="text-lg text-on-secondary-fixed-variant mb-10 max-w-xl mx-auto">
                        Mulailah perjalanan melestarikan Aksara Jawa hari ini. Gratis, seru, dan penuh tantangan!
                    </p>
                    <a href="{{ route('register') }}" class="px-10 py-4 bg-primary text-on-primary text-sm font-semibold rounded-xl tactile-button inline-flex items-center gap-2 hover:bg-primary/90 hover:-translate-y-1 hover:scale-105 active:scale-95 transition-all duration-300 shadow-md hover:shadow-lg">
                        Mulai Belajar Sekarang
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection

