@extends('layouts.landing')

@section('title', 'Fitur Unggulan')

@section('content')
<main class="pt-2">

    {{-- Hero Section --}}
    <section class="relative overflow-hidden py-16 md:py-24">
        {{-- Decorative background elements --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-secondary/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>

        <div class="max-w-[1140px] mx-auto px-6 text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-secondary-container text-on-secondary-container rounded-full mb-6">
                <span class="material-symbols-outlined text-base">explore</span>
                <span class="text-xs font-semibold">Fitur AksaraLoka</span>
            </div>
            <h1 class="font-headline text-5xl md:text-6xl text-primary mb-6 leading-tight font-bold">
                Fitur Unggulan Kami
            </h1>
            <p class="text-lg text-on-surface-variant max-w-3xl mx-auto leading-relaxed">
                AksaraLoka menggabungkan pelestarian budaya tradisional dengan teknologi gamifikasi modern dan fitur kolaborasi sosial. Temukan berbagai fitur yang membuat belajar Aksara Jawa menjadi lebih mudah, menyenangkan, dan terstruktur.
            </p>
        </div>
    </section>

    {{-- Feature Details Section --}}
    <section class="py-10 bg-surface-container-low">
        <div class="max-w-[1140px] mx-auto px-6 space-y-24">

            {{-- Fitur 1: Materi & Kuis --}}
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="flex-1 order-2 lg:order-1">
                    <div class="bg-white rounded-[2rem] p-8 md:p-10 border border-surface-variant shadow-sm tactile-card">
                        <div class="flex items-center justify-between border-b border-surface-variant/30 pb-4 mb-6">
                            <span class="text-xs font-bold text-primary-container bg-primary-fixed text-on-primary-fixed px-3 py-1 rounded-full">Kuis Interaktif</span>
                            <span class="text-xs text-on-surface-variant font-medium">Level 1: Nglegena</span>
                        </div>
                        <div class="text-center py-4">
                            <p class="text-sm text-on-surface-variant mb-4">Pilihlah pelafalan yang tepat dari aksara di bawah ini:</p>
                            <span class="text-[72px] font-bold text-primary font-headline leading-none mb-6 block aksara-font">ꦏ</span>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 border-2 border-surface-variant rounded-xl text-center text-sm font-semibold text-on-surface-variant hover:bg-surface-container transition-all cursor-pointer">A. Ha</div>
                            <div class="p-4 border-2 border-surface-variant rounded-xl text-center text-sm font-semibold text-on-surface-variant hover:bg-surface-container transition-all cursor-pointer">B. Na</div>
                            <div class="p-4 border-2 border-surface-variant rounded-xl text-center text-sm font-semibold text-on-surface-variant hover:bg-surface-container transition-all cursor-pointer">C. Ca</div>
                            <div class="p-4 border-2 border-primary bg-primary-fixed text-on-primary-fixed rounded-xl text-center text-sm font-bold shadow-sm cursor-default">D. Ka (Benar!)</div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 order-1 lg:order-2 space-y-6">
                    <div class="w-16 h-16 bg-primary/10 text-primary rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-[32px]">menu_book</span>
                    </div>
                    <h2 class="font-headline text-3xl text-primary font-bold">Materi Berjenjang & Kuis Interaktif</h2>
                    <p class="text-base text-on-surface-variant leading-relaxed">
                        Perjalanan belajar Anda disusun secara metodis dan terstruktur. Anda akan mulai dari mempelajari dasar **Aksara Nglegena**, disusul **Sandhangan** untuk vokal dan konsonan mati, hingga menguasai **Pasangan** untuk merangkai kata yang kompleks.
                    </p>
                    <ul class="text-base text-on-surface-variant leading-relaxed space-y-3">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">check_circle</span>
                            Modul materi yang mudah dipahami disertai visualisasi aksara yang jelas.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">check_circle</span>
                            Kuis di akhir materi untuk memantapkan pemahaman dan mengevaluasi ingatan Anda.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">check_circle</span>
                            Sistem anti-cheat cerdas yang mencegah manipulasi perolehan XP kuis.
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Fitur 2: Platform Kelas --}}
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="flex-1 space-y-6">
                    <div class="w-16 h-16 bg-secondary-container text-on-secondary-container rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-[32px]">school</span>
                    </div>
                    <h2 class="font-headline text-3xl text-primary font-bold">Ruang Kelas Digital (Guru & Siswa)</h2>
                    <p class="text-base text-on-surface-variant leading-relaxed">
                        AksaraLoka memfasilitasi kebutuhan kegiatan belajar-mengajar di sekolah maupun komunitas. Kami menyediakan sistem kelas khusus yang mengintegrasikan pengajar (Guru) dengan pelajar (Siswa).
                    </p>
                    <ul class="text-base text-on-surface-variant leading-relaxed space-y-3">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">check_circle</span>
                            **Dashboard Guru**: Guru dapat membuat kelas baru, mendapatkan kode kelas unik, dan memantau progress belajar siswa secara real-time.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">check_circle</span>
                            **Akses Siswa**: Siswa cukup memasukkan kode kelas dari guru untuk bergabung dan melihat daftar teman sekelas.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">check_circle</span>
                            Laporan analisis grafis bagi guru untuk melihat siswa yang butuh bantuan ekstra.
                        </li>
                    </ul>
                </div>
                <div class="flex-1">
                    <div class="bg-white rounded-[2rem] p-8 border border-surface-variant shadow-sm tactile-card">
                        <div class="flex items-center justify-between border-b border-surface-variant/30 pb-4 mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold text-sm">X</div>
                                <div>
                                    <h4 class="text-sm font-bold text-on-surface">Kelas X-A (Aksara)</h4>
                                    <p class="text-xs text-on-surface-variant">Kode: <span class="font-mono font-bold text-primary">AKSL-J93P</span></p>
                                </div>
                            </div>
                            <span class="text-[10px] uppercase font-bold text-primary bg-primary/10 px-2 py-0.5 rounded">Aktif</span>
                        </div>
                        <p class="text-xs font-bold text-on-surface-variant mb-3 uppercase tracking-wider">Perkembangan Siswa (3 Teratas)</p>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-3 bg-surface-container-low rounded-xl">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-primary">#1</span>
                                    <span class="text-sm font-semibold text-on-surface">Hafid</span>
                                </div>
                                <span class="text-xs font-bold text-primary">1,250 XP</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-surface-container-low rounded-xl">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-on-surface-variant">#2</span>
                                    <span class="text-sm font-semibold text-on-surface">Zaki</span>
                                </div>
                                <span class="text-xs font-bold text-on-surface-variant">1,120 XP</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-surface-container-low rounded-xl">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-on-surface-variant">#3</span>
                                    <span class="text-sm font-semibold text-on-surface">Dwiki</span>
                                </div>
                                <span class="text-xs font-bold text-on-surface-variant">950 XP</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Fitur 3: Obrolan & Pertemanan --}}
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="flex-1 order-2 lg:order-1">
                    <div class="bg-white rounded-[2rem] p-6 border border-surface-variant shadow-sm tactile-card max-w-sm mx-auto">
                        <div class="flex items-center gap-3 border-b border-surface-variant/30 pb-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold">Z</div>
                            <div>
                                <h4 class="text-sm font-bold text-on-surface">Zaki Laksamana</h4>
                                <p class="text-[10px] text-green-600 font-bold flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-600 inline-block"></span> Online
                                </p>
                            </div>
                        </div>
                        <div class="space-y-3 mb-4 h-48 overflow-y-auto pr-1">
                            <div class="bg-surface-container-low p-3 rounded-2xl rounded-tl-none max-w-[85%] text-xs text-on-surface-variant">
                                Bro, level Pasangan di chapter 3 lumayan seru ya!
                            </div>
                            <div class="bg-primary-fixed text-on-primary-fixed p-3 rounded-2xl rounded-tr-none max-w-[85%] ml-auto text-xs font-medium">
                                Betul! Kuncinya harus hafal sandhangan panyigegnya juga.
                            </div>
                            <div class="bg-surface-container-low p-3 rounded-2xl rounded-tl-none max-w-[85%] text-xs text-on-surface-variant">
                                Ah iya, pantesan punyaku salah terus di bagian itu. Makasih infonya!
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <input type="text" placeholder="Tulis pesan..." class="flex-1 bg-surface-container-low border border-surface-variant/40 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-primary">
                            <button class="w-9 h-9 bg-primary text-on-primary rounded-xl flex items-center justify-center hover:bg-primary/95 transition-all">
                                <span class="material-symbols-outlined text-sm">send</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex-1 order-1 lg:order-2 space-y-6">
                    <div class="w-16 h-16 bg-on-secondary-container text-white rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-[32px]">forum</span>
                    </div>
                    <h2 class="font-headline text-3xl text-primary font-bold">Jejaring Sosial & Obrolan Real-Time</h2>
                    <p class="text-base text-on-surface-variant leading-relaxed">
                        Belajar tidak harus sendirian. Dengan fitur sosial AksaraLoka, Anda dapat saling terhubung dengan teman-teman Anda, bersaing secara sehat, dan bertukar informasi secara langsung di dalam aplikasi.
                    </p>
                    <ul class="text-base text-on-surface-variant leading-relaxed space-y-3">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">check_circle</span>
                            **Cari Pengguna**: Cari akun teman belajar Anda menggunakan nama pengguna (username) mereka.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">check_circle</span>
                            **Manajemen Pertemanan**: Kirim permintaan pertemanan, terima permintaan yang masuk, atau tolak dengan aman.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">check_circle</span>
                            **Obrolan Instan**: Lakukan percakapan pribadi secara langsung untuk membahas materi pelajaran.
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Fitur 4: Gamifikasi --}}
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="flex-1 space-y-6">
                    <div class="w-16 h-16 bg-primary-container text-on-primary-container rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-[32px]">workspace_premium</span>
                    </div>
                    <h2 class="font-headline text-3xl text-primary font-bold">Gamifikasi Seru (Streak, XP, & Papan Peringkat)</h2>
                    <p class="text-base text-on-surface-variant leading-relaxed">
                        Kami menerapkan mekanisme gamifikasi untuk mempertahankan motivasi belajar Anda setiap harinya. Belajar terasa seperti bermain game petualangan yang seru.
                    </p>
                    <ul class="text-base text-on-surface-variant leading-relaxed space-y-3">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">check_circle</span>
                            **Streak Harian**: Belajar setiap hari berturut-turut untuk meningkatkan multiplier XP. Jika libur belajar, streak Anda akan tereset.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">check_circle</span>
                            **Papan Peringkat (Leaderboard)**: Kumpulkan XP sebanyak mungkin dan berkompetisi secara sehat untuk menjadi juara 3 teratas global.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">check_circle</span>
                            **Lencana Pencapaian (Achievements)**: Dapatkan medali pencapaian seperti *Kolektor XP*, *Konsistensi Kilat*, dan lainnya seiring kemajuan Anda.
                        </li>
                    </ul>
                </div>
                <div class="flex-1">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-6 bg-white rounded-3xl border border-surface-variant shadow-sm tactile-card text-center flex flex-col items-center">
                            <span class="material-symbols-outlined text-[48px] text-orange-500 mb-2 fill-1" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                            <h4 class="text-xl font-bold text-on-surface">12 Hari</h4>
                            <p class="text-xs text-on-surface-variant font-medium">Streak Belajar</p>
                        </div>
                        <div class="p-6 bg-white rounded-3xl border border-surface-variant shadow-sm tactile-card text-center flex flex-col items-center">
                            <span class="material-symbols-outlined text-[48px] text-yellow-500 mb-2 fill-1" style="font-variation-settings: 'FILL' 1;">military_tech</span>
                            <h4 class="text-xl font-bold text-on-surface">Medali Emas</h4>
                            <p class="text-xs text-on-surface-variant font-medium">Lencana Ahli Aksara</p>
                        </div>
                        <div class="col-span-2 p-5 bg-primary/5 rounded-3xl border-l-4 border-primary flex items-center gap-4">
                            <span class="material-symbols-outlined text-primary text-[32px]">trending_up</span>
                            <div>
                                <h4 class="text-sm font-bold text-primary">XP Multiplier: 1.5x Aktif</h4>
                                <p class="text-xs text-on-surface-variant font-medium">Bonus XP aktif karena Anda belajar konsisten setiap hari!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Fitur 5: Kamus & Perpustakaan --}}
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="flex-1 order-2 lg:order-1">
                    <div class="bg-white rounded-[2rem] p-6 border border-surface-variant shadow-sm tactile-card w-full max-w-md mx-auto">
                        <div class="flex gap-2 mb-4">
                            <input type="text" value="Makan" class="flex-1 bg-surface-container-low border border-surface-variant/40 rounded-xl px-4 py-2.5 text-xs focus:outline-none focus:border-primary font-medium" readonly>
                            <button class="px-4 bg-primary text-on-primary rounded-xl flex items-center justify-center hover:bg-primary/95 transition-all text-xs font-bold gap-1">
                                <span class="material-symbols-outlined text-sm">search</span> Cari
                            </button>
                        </div>
                        <div class="space-y-3">
                            <div class="p-3 bg-surface-container-low rounded-xl border border-surface-variant/20 flex justify-between items-center">
                                <div>
                                    <span class="text-[10px] font-bold text-primary bg-primary-fixed px-2 py-0.5 rounded">Ngoko</span>
                                    <h4 class="text-sm font-bold text-on-surface mt-1">Mangan</h4>
                                </div>
                                <span class="text-xl font-bold text-primary aksara-font">ꦩꦔꦤ꧀</span>
                            </div>
                            <div class="p-3 bg-surface-container-low rounded-xl border border-surface-variant/20 flex justify-between items-center">
                                <div>
                                    <span class="text-[10px] font-bold text-secondary bg-secondary-fixed px-2 py-0.5 rounded">Krama Madya</span>
                                    <h4 class="text-sm font-bold text-on-surface mt-1">Nedha</h4>
                                </div>
                                <span class="text-xl font-bold text-primary aksara-font">ꦤꦼꦝ</span>
                            </div>
                            <div class="p-3 bg-surface-container-low rounded-xl border border-surface-variant/20 flex justify-between items-center">
                                <div>
                                    <span class="text-[10px] font-bold text-tertiary bg-tertiary-fixed text-on-tertiary-fixed-variant px-2 py-0.5 rounded">Krama Alus</span>
                                    <h4 class="text-sm font-bold text-on-surface mt-1">Dhahar</h4>
                                </div>
                                <span class="text-xl font-bold text-primary aksara-font">ꦝꦲꦂ</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 order-1 lg:order-2 space-y-6">
                    <div class="w-16 h-16 bg-white text-primary rounded-2xl border border-surface-variant flex items-center justify-center">
                        <span class="material-symbols-outlined text-[32px]">library_books</span>
                    </div>
                    <h2 class="font-headline text-3xl text-primary font-bold">Kamus & Perpustakaan Jawa</h2>
                    <p class="text-base text-on-surface-variant leading-relaxed">
                        Kami menyediakan database kamus kosakata bahasa Jawa yang komprehensif. Anda dapat mengeksplorasi kata dari ragam tingkat kebahasaan Jawa untuk memperluas perbendaharaan kalimat Anda.
                    </p>
                    <ul class="text-base text-on-surface-variant leading-relaxed space-y-3">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">check_circle</span>
                            **Ragam Bahasa Lengkap**: Kosa kata dikelompokkan dengan jelas berdasarkan tingkat kesopanan: Ngoko, Krama Madya, dan Krama Inggil (Alus).
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">check_circle</span>
                            **Transliterasi Aksara**: Setiap kata dilengkapi penulisan aksara Jawa aslinya untuk dipelajari cara membacanya.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">check_circle</span>
                            Perpustakaan digital yang mencakup cerita rakyat dan materi sastra Jawa lainnya.
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 mb-10">
        <div class="max-w-[1140px] mx-auto px-6">
            <div class="relative bg-secondary-container rounded-[3rem] p-12 overflow-hidden text-center tactile-card">
                <div class="absolute top-0 right-0 p-6 opacity-10">
                    <span class="material-symbols-outlined text-[200px]" style="font-variation-settings: 'FILL' 1;">explore</span>
                </div>
                <div class="relative z-10">
                    <h2 class="font-headline text-4xl text-on-secondary-container mb-4 font-bold">Siap Mencoba Semua Fitur Ini?</h2>
                    <p class="text-lg text-on-secondary-fixed-variant mb-10 max-w-xl mx-auto">
                        Mulai petualangan belajarmu sekarang juga. Gratis, tanpa biaya tersembunyi, dan penuh dengan keseruan budaya!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('register') }}" class="px-10 py-4 bg-primary text-on-primary text-sm font-semibold rounded-xl tactile-button inline-flex items-center justify-center gap-2 hover:bg-primary/90 hover:-translate-y-1 hover:scale-105 active:scale-95 transition-all duration-300 shadow-md hover:shadow-lg">
                            Daftar Sekarang
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </a>
                        <a href="{{ route('login') }}" class="px-10 py-4 bg-white border-2 border-primary/20 text-primary text-sm font-semibold rounded-xl hover:bg-primary/5 hover:scale-105 transition-all duration-300 inline-flex items-center justify-center gap-2">
                            Sudah Punya Akun? Masuk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection

