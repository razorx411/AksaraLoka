@extends('layouts.landing')

@section('title', 'Lestarikan Budaya, Kuasai Aksara Jawa')

@section('content')
<main class="pt-2">
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
                    <a href="{{ route('register') }}" class="px-10 py-4 bg-primary text-on-primary text-sm font-semibold rounded-xl tactile-button flex items-center justify-center gap-2 hover:bg-primary/90 hover:-translate-y-1 hover:scale-105 active:scale-95 transition-all duration-300 shadow-md hover:shadow-lg">Mulai Belajar Gratis<span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                <a href="https://www.youtube.com/watch?v=wIwWfmdIVUE&list=RDwIwWfmdIVUE&start_radio=1"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="px-10 py-4 bg-white border-2 border-primary/20 text-primary text-sm font-semibold rounded-xl hover:bg-primary/5 hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">play_circle</span>
                        <span>Lihat Demo</span>
                </a>
                </div>
            </div>
            <div class="">
                
                    <img alt="aksaraloka detail" class="" src="{{ asset('assets/background/bg_awal.png') }}"/>
                
            </div>
        </div>
    </section>

    <!-- Stats Section (Bento Style) -->
    <section class="py-10 bg-surface-container-low">
        <div class="max-w-[1140px] mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="p-6 bg-white rounded-2xl tactile-card text-center">
                    <h3 class="font-headline text-2xl text-primary mb-1">5+</h3>
                    <p class="text-xs font-medium text-on-surface-variant">Tingkatan Materi</p>
                </div>
                <div class="p-6 bg-white rounded-2xl tactile-card text-center">
                    <h3 class="font-headline text-2xl text-secondary mb-1">Puluhan</h3>
                    <p class="text-xs font-medium text-on-surface-variant">Modul Belajar</p>
                </div>
                <div class="p-6 bg-white rounded-2xl tactile-card text-center">
                    <h3 class="font-headline text-2xl text-tertiary mb-1">Ratusan</h3>
                    <p class="text-xs font-medium text-on-surface-variant">Kamus Kosakata</p>
                </div>
                <div class="p-6 bg-white rounded-2xl tactile-card text-center">
                    <h3 class="font-headline text-2xl text-primary-container mb-1">Kompetitif</h3>
                    <p class="text-xs font-medium text-on-surface-variant">Sistem Peringkat</p>
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
    <section class="py-16 bg-primary text-on-primary scroll-mt-20" id="fitur">
        <div class="max-w-[1140px] mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="font-headline text-4xl mb-3 font-bold">Belajar Menjadi Lebih Seru & Interaktif</h2>
                <p class="text-lg text-on-primary-container max-w-2xl mx-auto">
                    AksaraLoka menghadirkan fitur-fitur unggulan modern yang dirancang khusus untuk memudahkan proses belajar Aksara Jawa secara mandiri maupun kolaboratif.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Feature 1 -->
                <div class="bg-white/10 backdrop-blur p-8 rounded-[2rem] border border-white/20 hover:bg-white/15 transition-all group">
                    <div class="w-14 h-14 bg-secondary-container text-on-secondary-container rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[32px]">menu_book</span>
                    </div>
                    <h3 class="font-headline text-xl mb-4 font-semibold">Materi & Kuis</h3>
                    <p class="text-sm text-on-primary-container">
                        Belajar sistematis dari Aksara Nglegena hingga Pasangan dengan modul menarik dan kuis interaktif di setiap tingkat.
                    </p>
                </div>
                <!-- Feature 2 -->
                <div class="bg-white/10 backdrop-blur p-8 rounded-[2rem] border border-white/20 hover:bg-white/15 transition-all group">
                    <div class="w-14 h-14 bg-tertiary-fixed text-on-tertiary-fixed-variant rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[32px]">school</span>
                    </div>
                    <h3 class="font-headline text-xl mb-4 font-semibold">Platform Kelas</h3>
                    <p class="text-sm text-on-primary-container">
                        Guru dapat membuat ruang kelas digital untuk memberikan tugas, memantau perkembangan, dan membimbing siswa secara real-time.
                    </p>
                </div>
                <!-- Feature 3 -->
                <div class="bg-white/10 backdrop-blur p-8 rounded-[2rem] border border-white/20 hover:bg-white/15 transition-all group">
                    <div class="w-14 h-14 bg-on-secondary-container text-white rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[32px]">forum</span>
                    </div>
                    <h3 class="font-headline text-xl mb-4 font-semibold">Obrolan & Teman</h3>
                    <p class="text-sm text-on-primary-container">
                        Hubungkan jejaring sosial belajarmu dengan mencari teman baru, mengirim permintaan, dan berdiskusi lewat chat real-time.
                    </p>
                </div>
                <!-- Feature 4 -->
                <div class="bg-white/10 backdrop-blur p-8 rounded-[2rem] border border-white/20 hover:bg-white/15 transition-all group">
                    <div class="w-14 h-14 bg-white text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[32px]">workspace_premium</span>
                    </div>
                    <h3 class="font-headline text-xl mb-4 font-semibold">Gamifikasi Seru</h3>
                    <p class="text-sm text-on-primary-container">
                        Kumpulkan XP, pertahankan streak harian, bersaing di papan peringkat global, dan dapatkan lencana pencapaian menarik.
                    </p>
                </div>
            </div>
            
            <!-- Detail Link Button -->
            <div class="text-center mt-12">
                <a href="{{ route('fitur') }}" class="px-8 py-3.5 bg-white text-primary text-sm font-semibold rounded-xl tactile-button inline-flex items-center gap-2 hover:bg-white/90 hover:scale-105 active:scale-95 transition-all duration-300 shadow-md hover:shadow-lg">
                    <span>Jelajahi Semua Fitur Kami</span>
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
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
                            <p class="text-base">Materi komprehensif: Nglegena, Sandhangan, Pasangan, dll.</p>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container flex-shrink-0 mt-1">
                                <span class="material-symbols-outlined text-[20px]">check</span>
                            </div>
                            <p class="text-base">Kuis untuk mengukur pemahaman di setiap tahap.</p>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container flex-shrink-0 mt-1">
                                <span class="material-symbols-outlined text-[20px]">check</span>
                            </div>
                            <p class="text-base">Kamus kosakata bahasa Jawa lengkap dengan tingkatannya.</p>
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
                    <a href="{{ route('register') }}" class="px-10 py-4 bg-primary text-on-primary text-sm font-semibold rounded-xl tactile-button inline-flex items-center gap-2 hover:bg-primary/90 hover:-translate-y-1 hover:scale-105 active:scale-95 transition-all duration-300 shadow-md hover:shadow-lg">
                        Mulai Sekarang
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection