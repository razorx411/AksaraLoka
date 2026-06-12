<!DOCTYPE html>
<html class="light scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dokumentasi Developer AksaraLoka</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Sans+Javanese:wght@400;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .active-sidebar-link {
            color: #6b3f00 !important;
            font-weight: 700;
            border-left-color: #6b3f00 !important;
            background-color: rgba(107, 63, 0, 0.05);
        }
    </style>
</head>
<body class="bg-background text-on-background font-sans selection:bg-primary-fixed antialiased">

    {{-- Header --}}
    <header class="sticky top-0 z-50 w-full bg-white/80 backdrop-blur-md border-b border-surface-container-high px-4 md:px-8 py-3 flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-primary text-3xl">menu_book</span>
            <div>
                <h1 class="font-headline text-xl font-bold text-primary leading-none">AksaraLoka</h1>
                <span class="text-[9px] font-bold text-on-surface-variant tracking-widest uppercase">CoderDocs</span>
            </div>
        </div>

        {{-- Search Docs --}}
        <div class="relative w-full max-w-sm order-3 sm:order-none shrink-0 sm:flex-1">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-[20px] pointer-events-none">search</span>
            <input type="text" id="docsSearchInput" placeholder="Cari dokumentasi..." class="w-full pl-12 pr-4 py-2 bg-surface-container-low border border-outline-variant/60 focus:border-primary focus:outline-none rounded-full transition-all text-sm font-medium" />
        </div>

        {{-- Right Actions --}}
        <div class="flex items-center gap-4">
            <div class="hidden md:flex items-center gap-3">
                <a href="#" class="text-on-surface-variant hover:text-primary transition-colors text-lg" title="GitHub Repository"><i class="fa-brands fa-github"></i></a>
                <a href="#" class="text-on-surface-variant hover:text-primary transition-colors text-lg" title="Twitter"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" class="text-on-surface-variant hover:text-primary transition-colors text-lg" title="Slack"><i class="fa-brands fa-slack"></i></a>
            </div>
            <a href="/" class="bg-primary text-on-primary font-bold px-5 py-2 rounded-xl text-xs hover:bg-primary-container transition-all active:scale-95 shadow">
                Ke Landing Page
            </a>
        </div>
    </header>

    {{-- Main Container --}}
    <div class="max-w-[1400px] mx-auto flex">
        
        {{-- Sticky Left Sidebar --}}
        <aside class="w-72 hidden lg:block border-r border-surface-container-high h-[calc(100vh-4rem)] sticky top-16 overflow-y-auto px-6 py-8 shrink-0 select-none">
            <nav id="docsSidebar" class="space-y-6">
                
                {{-- Category 1 --}}
                <div class="space-y-2 docs-sidebar-cat">
                    <h4 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">info</span>
                        Pendahuluan
                    </h4>
                    <ul class="space-y-1 border-l-2 border-surface-container-highest">
                        <li>
                            <a href="#sec-1-1" class="docs-sidebar-link block pl-4 py-1.5 text-sm text-on-surface-variant hover:text-primary transition-all border-l-2 border-transparent -ml-[2px]">
                                1.1 Tentang AksaraLoka
                            </a>
                        </li>
                        <li>
                            <a href="#sec-1-2" class="docs-sidebar-link block pl-4 py-1.5 text-sm text-on-surface-variant hover:text-primary transition-all border-l-2 border-transparent -ml-[2px]">
                                1.2 Fitur Utama
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Category 2 --}}
                <div class="space-y-2 docs-sidebar-cat">
                    <h4 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">dns</span>
                        Arsitektur & DB
                    </h4>
                    <ul class="space-y-1 border-l-2 border-surface-container-highest">
                        <li>
                            <a href="#sec-2-1" class="docs-sidebar-link block pl-4 py-1.5 text-sm text-on-surface-variant hover:text-primary transition-all border-l-2 border-transparent -ml-[2px]">
                                2.1 Struktur Proyek
                            </a>
                        </li>
                        <li>
                            <a href="#sec-2-2" class="docs-sidebar-link block pl-4 py-1.5 text-sm text-on-surface-variant hover:text-primary transition-all border-l-2 border-transparent -ml-[2px]">
                                2.2 Schema & Migrasi DB
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Category 3 --}}
                <div class="space-y-2 docs-sidebar-cat">
                    <h4 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">terminal</span>
                        Controller & Logic
                    </h4>
                    <ul class="space-y-1 border-l-2 border-surface-container-highest">
                        <li>
                            <a href="#sec-3-1" class="docs-sidebar-link block pl-4 py-1.5 text-sm text-on-surface-variant hover:text-primary transition-all border-l-2 border-transparent -ml-[2px]">
                                3.1 AuthController
                            </a>
                        </li>
                        <li>
                            <a href="#sec-3-2" class="docs-sidebar-link block pl-4 py-1.5 text-sm text-on-surface-variant hover:text-primary transition-all border-l-2 border-transparent -ml-[2px]">
                                3.2 PageController
                            </a>
                        </li>
                        <li>
                            <a href="#sec-3-3" class="docs-sidebar-link block pl-4 py-1.5 text-sm text-on-surface-variant hover:text-primary transition-all border-l-2 border-transparent -ml-[2px]">
                                3.3 GuruDashboardController
                            </a>
                        </li>
                        <li>
                            <a href="#sec-3-4" class="docs-sidebar-link block pl-4 py-1.5 text-sm text-on-surface-variant hover:text-primary transition-all border-l-2 border-transparent -ml-[2px]">
                                3.4 StudentClassroomController
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Category 4 --}}
                <div class="space-y-2 docs-sidebar-cat">
                    <h4 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">schema</span>
                        Model & Relasi
                    </h4>
                    <ul class="space-y-1 border-l-2 border-surface-container-highest">
                        <li>
                            <a href="#sec-4-1" class="docs-sidebar-link block pl-4 py-1.5 text-sm text-on-surface-variant hover:text-primary transition-all border-l-2 border-transparent -ml-[2px]">
                                4.1 Model User & Kelas
                            </a>
                        </li>
                        <li>
                            <a href="#sec-4-2" class="docs-sidebar-link block pl-4 py-1.5 text-sm text-on-surface-variant hover:text-primary transition-all border-l-2 border-transparent -ml-[2px]">
                                4.2 Model Alur Belajar
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Category 5 --}}
                <div class="space-y-2 docs-sidebar-cat">
                    <h4 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">security</span>
                        Keamanan & Peran
                    </h4>
                    <ul class="space-y-1 border-l-2 border-surface-container-highest">
                        <li>
                            <a href="#sec-5-1" class="docs-sidebar-link block pl-4 py-1.5 text-sm text-on-surface-variant hover:text-primary transition-all border-l-2 border-transparent -ml-[2px]">
                                5.1 Middleware Peran
                            </a>
                        </li>
                        <li>
                            <a href="#sec-5-2" class="docs-sidebar-link block pl-4 py-1.5 text-sm text-on-surface-variant hover:text-primary transition-all border-l-2 border-transparent -ml-[2px]">
                                5.2 Alur Pemantauan Progress
                            </a>
                        </li>
                    </ul>
                </div>

            </nav>
        </aside>

        {{-- Scrollable Right Content --}}
        <main class="flex-1 px-6 md:px-12 py-10 max-w-4xl h-[calc(100vh-4rem)] overflow-y-auto" id="docsContent">
            
            {{-- Empty Search State --}}
            <div id="docsEmptyState" class="hidden py-16 flex flex-col items-center justify-center text-center gap-4">
                <span class="material-symbols-outlined text-5xl text-outline-variant">search_off</span>
                <p class="text-on-surface-variant font-medium">Dokumentasi yang Anda cari tidak ditemukan.</p>
            </div>

            <div class="space-y-16">
                
                {{-- Section 1.1 --}}
                <section id="sec-1-1" class="docs-section scroll-mt-20">
                    <h2 class="font-headline text-3xl font-bold text-on-surface mb-4">1.1 Tentang AksaraLoka</h2>
                    <p class="text-sm text-on-surface-variant leading-relaxed mb-6">
                        AksaraLoka adalah sebuah platform web inovatif yang dirancang khusus untuk pembelajaran aksara nusantara secara digital dengan mengedepankan pengalaman belajar yang menyenangkan. Platform ini menggunakan elemen gamifikasi seperti **streak, XP (poin), level, dan papan peringkat global** agar menumbuhkan antusiasme pengguna saat mempelajari aksara daerah Indonesia (seperti Aksara Jawa).
                    </p>

                    <div class="mb-6 bg-surface-container-low border-l-4 border-primary p-5 rounded-r-2xl">
                        <p class="text-xs font-bold text-primary uppercase tracking-wider flex items-center gap-1.5 mb-1.5">
                            <span class="material-symbols-outlined text-base">info</span> Info Teknologi Utama
                        </p>
                        <ul class="text-xs text-on-surface-variant space-y-1 list-disc pl-4">
                            <li><strong>Framework Utama:</strong> Laravel 11.x</li>
                            <li><strong>Styling Engine:</strong> Tailwind CSS v4.0 (tanpa utility ad-hoc luar)</li>
                            <li><strong>Kompilasi Aset:</strong> Vite JS bundler</li>
                            <li><strong>Basis Data:</strong> MySQL Database</li>
                        </ul>
                    </div>
                </section>

                {{-- Section 1.2 --}}
                <section id="sec-1-2" class="docs-section scroll-mt-20">
                    <h2 class="font-headline text-3xl font-bold text-on-surface mb-4">1.2 Fitur Utama</h2>
                    <p class="text-sm text-on-surface-variant leading-relaxed mb-6">
                        Platform AksaraLoka menyajikan beberapa pilar fitur utama untuk melayani berbagai segmentasi pengguna (pelajar mandiri, pelajar terdaftar, dan guru/pengajar):
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="border border-outline-variant/60 rounded-2xl p-5 bg-surface-container-low">
                            <h5 class="font-bold text-sm text-primary flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-lg">map</span> Alur Belajar &amp; Kuis
                            </h5>
                            <p class="text-xs text-on-surface-variant leading-relaxed">
                                Siswa belajar lewat alur bertingkat dari bab ke bab. Level kuis terkunci secara progresif dan akan terbuka otomatis ketika siswa menyelesaikan level kuis sebelumnya.
                            </p>
                        </div>
                        <div class="border border-outline-variant/60 rounded-2xl p-5 bg-surface-container-low">
                            <h5 class="font-bold text-sm text-primary flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-lg">school</span> Manajemen Kelas (Guru-Siswa)
                            </h5>
                            <p class="text-xs text-on-surface-variant leading-relaxed">
                                Peran Guru yang memungkinkan pembuatan kelas belajar dengan kode join unik (6 karakter). Siswa dapat mendaftar masuk kelas menggunakan kode tersebut.
                            </p>
                        </div>
                        <div class="border border-outline-variant/60 rounded-2xl p-5 bg-surface-container-low">
                            <h5 class="font-bold text-sm text-primary flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-lg">monitoring</span> Monitoring Progres
                            </h5>
                            <p class="text-xs text-on-surface-variant leading-relaxed">
                                Guru dapat melacak secara langsung total XP, level, jumlah level yang selesai, serta rincian waktu penyelesaian level setiap mahasiswa terdaftar.
                            </p>
                        </div>
                        <div class="border border-outline-variant/60 rounded-2xl p-5 bg-surface-container-low">
                            <h5 class="font-bold text-sm text-primary flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-lg">leaderboard</span> Leaderboard Dinamis
                            </h5>
                            <p class="text-xs text-on-surface-variant leading-relaxed">
                                Papan peringkat global (Liga AksaraLoka) dan papan peringkat internal kelas (Leaderboard Kelas) menyaring data secara dinamis dari database terpusat.
                            </p>
                        </div>
                    </div>
                </section>

                {{-- Section 2.1 --}}
                <section id="sec-2-1" class="docs-section scroll-mt-20">
                    <h2 class="font-headline text-3xl font-bold text-on-surface mb-4">2.1 Struktur Proyek</h2>
                    <p class="text-sm text-on-surface-variant leading-relaxed mb-6">
                        AksaraLoka mengikuti arsitektur standar MVC (Model-View-Controller) milik Laravel. Berikut adalah representasi struktur direktori penting proyek ini:
                    </p>

                    <div class="bg-surface-container-low border border-outline-variant rounded-2xl p-5 font-mono text-xs text-on-surface overflow-x-auto space-y-1 leading-relaxed">
                        <div>📂 AksaraLoka</div>
                        <div class="pl-4">📂 app</div>
                        <div class="pl-8">📂 Http</div>
                        <div class="pl-12">📂 Controllers <span class="text-gray-400">// Pengendali Logika Aksi</span></div>
                        <div class="pl-16">📄 AuthController.php</div>
                        <div class="pl-16">📄 PageController.php</div>
                        <div class="pl-16">📂 Guru / 📄 GuruDashboardController.php</div>
                        <div class="pl-16">📂 Student / 📄 StudentClassroomController.php</div>
                        <div class="pl-16">📂 Admin / <span>... controllers CRUD</span></div>
                        <div class="pl-12">📂 Middleware</div>
                        <div class="pl-16">📄 IsAdmin.php &amp; IsGuru.php</div>
                        <div class="pl-8">📂 Models <span class="text-gray-400">// Eloquent Entity Relasional</span></div>
                        <div class="pl-12">📄 User.php, Classroom.php, Level.php, dsb.</div>
                        <div class="pl-4">📂 database</div>
                        <div class="pl-8">📂 migrations <span class="text-gray-400">// Schema pembentuk tabel database</span></div>
                        <div class="pl-8">📂 seeders <span class="text-gray-400">// Data inisialisasi awal</span></div>
                        <div class="pl-4">📂 resources</div>
                        <div class="pl-8">📂 views <span class="text-gray-400">// Template tampilan Blade</span></div>
                        <div class="pl-12">📂 guru &amp; 📂 student</div>
                        <div class="pl-12">📂 pages &amp; 📂 partials</div>
                        <div class="pl-8">📂 css &amp; 📂 js <span class="text-gray-400">// Frontend assets kompilasi Vite</span></div>
                        <div class="pl-4">📂 routes / 📄 web.php <span class="text-gray-400">// Pemetaan url path &amp; middleware</span></div>
                    </div>
                </section>

                {{-- Section 2.2 --}}
                <section id="sec-2-2" class="docs-section scroll-mt-20">
                    <h2 class="font-headline text-3xl font-bold text-on-surface mb-4">2.2 Schema &amp; Migrasi DB</h2>
                    <p class="text-sm text-on-surface-variant leading-relaxed mb-6">
                        Skema basis data dikelola lewat migrasi Laravel secara transaksional. Relasi antar entitas dipetakan menggunakan foreign key relasional. Berikut adalah struktur tabel database utama:
                    </p>

                    <div class="bg-surface-container-low border border-outline-variant rounded-2xl overflow-hidden mb-6">
                        <table class="w-full text-left border-collapse text-xs">
                            <thead>
                                <tr class="bg-surface-container-high border-b border-outline-variant font-bold">
                                    <th class="p-3">Nama Tabel</th>
                                    <th class="p-3">Kolom Penting</th>
                                    <th class="p-3">Keterangan / Relasi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/30 text-on-surface-variant leading-relaxed">
                                <tr>
                                    <td class="p-3 font-bold text-on-surface">users</td>
                                    <td class="p-3 font-mono">id, username, email, password, role ('user','admin','guru'), total_points, streak_count</td>
                                    <td class="p-3">Data akun pengguna. Default role: 'user' (siswa).</td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-bold text-on-surface">classrooms</td>
                                    <td class="p-3 font-mono">id, name, code (unique), description, teacher_id</td>
                                    <td class="p-3">Relasi: <code class="bg-surface-container-high px-1 py-0.5 rounded">teacher_id</code> FK ke <code class="bg-surface-container-high px-1 py-0.5 rounded">users.id</code> (Cascade).</td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-bold text-on-surface">classroom_student</td>
                                    <td class="p-3 font-mono">id, classroom_id, student_id, joined_at</td>
                                    <td class="p-3">Pivot table pendaftaran kelas. Relasi: FK ke <code class="bg-surface-container-high px-1 py-0.5 rounded">classrooms</code> &amp; <code class="bg-surface-container-high px-1 py-0.5 rounded">users</code>.</td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-bold text-on-surface">chapters</td>
                                    <td class="p-3 font-mono">id, title, order_index</td>
                                    <td class="p-3">Bab alur belajar utama.</td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-bold text-on-surface">sub_chapters</td>
                                    <td class="p-3 font-mono">id, chapter_id, title, order_index</td>
                                    <td class="p-3">Sub-bab alur belajar. Relasi: FK ke <code class="bg-surface-container-high px-1 py-0.5 rounded">chapters</code>.</td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-bold text-on-surface">levels</td>
                                    <td class="p-3 font-mono">id, sub_chapter_id, title, order_index, xp_reward</td>
                                    <td class="p-3">Tingkatan kuis kuis. Relasi: FK ke <code class="bg-surface-container-high px-1 py-0.5 rounded">sub_chapters</code>.</td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-bold text-on-surface">user_level_progress</td>
                                    <td class="p-3 font-mono">id, user_id, level_id, is_completed, completed_at</td>
                                    <td class="p-3">Histori penyelesaian level. Relasi: FK ke <code class="bg-surface-container-high px-1 py-0.5 rounded">users</code> &amp; <code class="bg-surface-container-high px-1 py-0.5 rounded">levels</code>.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                {{-- Section 3.1 --}}
                <section id="sec-3-1" class="docs-section scroll-mt-20">
                    <h2 class="font-headline text-3xl font-bold text-on-surface mb-4">3.1 AuthController</h2>
                    <p class="text-sm text-on-surface-variant leading-relaxed mb-6">
                        Pengendali autentikasi bertugas melayani registrasi, login, dan reset password. Ketika user berhasil login, `AuthController` akan secara dinamis mengalihkan tujuan halaman berdasarkan role user:
                    </p>

                    <div class="bg-surface-container-low border border-outline-variant rounded-2xl p-5 font-mono text-xs text-on-surface overflow-x-auto mb-6">
<pre class="text-[#206e1b]"><span class="text-outline-variant">// Cuplikan logika redirect setelah login sukses</span>
$user = Auth::user();
if ($user->isAdmin()) {
    $redirectUrl = route('admin.dashboard');
} elseif ($user->isGuru()) {
    $redirectUrl = route('guru.dashboard');
} else {
    $redirectUrl = route('home');
}</pre>
                    </div>

                    <div class="mb-6 bg-amber-500/10 border-l-4 border-secondary p-5 rounded-r-2xl">
                        <p class="text-xs font-bold text-[#795900] uppercase tracking-wider flex items-center gap-1.5 mb-1.5">
                            <span class="material-symbols-outlined text-base">warning</span> Warning: Validasi Registrasi
                        </p>
                        <p class="text-xs text-on-surface-variant leading-relaxed">
                            Form registrasi mewajibkan data `role` bernilai `'user'` atau `'guru'`. Input `'admin'` diblokir dalam request registrasi publik demi alasan keamanan data sistem.
                        </p>
                    </div>
                </section>

                {{-- Section 3.2 --}}
                <section id="sec-3-2" class="docs-section scroll-mt-20">
                    <h2 class="font-headline text-3xl font-bold text-on-surface mb-4">3.2 PageController</h2>
                    <p class="text-sm text-on-surface-variant leading-relaxed mb-6">
                        `PageController` melayani rute utama pembelajaran siswa. Salah satu fungsi terpenting adalah `home()` yang mengatur pembukaan level berdasarkan relasi kelulusan kuis sebelumnya:
                    </p>

                    <div class="bg-surface-container-low border border-outline-variant rounded-2xl p-5 font-mono text-xs text-on-surface overflow-x-auto mb-6">
<pre class="text-[#206e1b]"><span class="text-outline-variant">// Memeriksa progress level bertingkat</span>
$levels = $subChapter->levels->sortBy('order_index')->values();
$prevDone = true; <span class="text-outline-variant">// level pertama default terbuka</span>
foreach ($levels as $level) {
    $isCompleted = isset($progress[$level->id]) &amp;&amp; $progress[$level->id];
    if ($isCompleted) {
        $levelStatuses[$level->id] = 'completed';
        $prevDone = true;
    } elseif ($prevDone) {
        $levelStatuses[$level->id] = 'active';
        $prevDone = false;
    } else {
        $levelStatuses[$level->id] = 'locked';
    }
}</pre>
                    </div>
                </section>

                {{-- Section 3.3 --}}
                <section id="sec-3-3" class="docs-section scroll-mt-20">
                    <h2 class="font-headline text-3xl font-bold text-on-surface mb-4">3.3 GuruDashboardController</h2>
                    <p class="text-sm text-on-surface-variant leading-relaxed mb-6">
                        `GuruDashboardController` menangani operasional kelas dari sudut pandang Guru. Kelas baru dibuat menggunakan hash acak 6 digit yang dipastikan tidak bentrok di database:
                    </p>

                    <div class="bg-surface-container-low border border-outline-variant rounded-2xl p-5 font-mono text-xs text-on-surface overflow-x-auto mb-6">
<pre class="text-[#206e1b]"><span class="text-outline-variant">// Mengenerate kode kelas acak unik</span>
do {
    $code = strtoupper(Str::random(6));
} while (Classroom::where('code', $code)->exists());

auth()->user()->classroomsAsTeacher()->create([
    'name'        => $request->name,
    'description' => $request->description,
    'code'        => $code,
]);</pre>
                    </div>
                </section>

                {{-- Section 3.4 --}}
                <section id="sec-3-4" class="docs-section scroll-mt-20">
                    <h2 class="font-headline text-3xl font-bold text-on-surface mb-4">3.4 StudentClassroomController</h2>
                    <p class="text-sm text-on-surface-variant leading-relaxed mb-6">
                        Mengontrol interaksi siswa mendaftar ke kelas. Pencarian dilakukan berdasarkan string kode unik kelas. Jika kode ditemukan, baris pendaftaran akan disisipkan ke pivot table `classroom_student`.
                    </p>
                </section>

                {{-- Section 4-1 --}}
                <section id="sec-4-1" class="docs-section scroll-mt-20">
                    <h2 class="font-headline text-3xl font-bold text-on-surface mb-4">4.1 Model User &amp; Relasi</h2>
                    <p class="text-sm text-on-surface-variant leading-relaxed mb-6">
                        Model [User.php](file:///d:/Development/AksaraLoka/app/Models/User.php) menampung logika perolehan level berbasis total XP (XP_CONFIG) serta streak harian. Terdapat pula pendefinisian relasi kelas:
                    </p>

                    <div class="bg-surface-container-low border border-outline-variant rounded-2xl p-5 font-mono text-xs text-on-surface overflow-x-auto mb-6">
<pre class="text-[#206e1b]"><span class="text-outline-variant">// Relasi guru ke kelas miliknya</span>
public function classroomsAsTeacher() {
    return $this->hasMany(Classroom::class, 'teacher_id');
}

<span class="text-outline-variant">// Relasi siswa ke kelas yang diikuti</span>
public function classroomsAsStudent() {
    return $this->belongsToMany(Classroom::class, 'classroom_student', 'student_id', 'classroom_id')
        ->withPivot('joined_at')
        ->withTimestamps();
}</pre>
                    </div>
                </section>

                {{-- Section 4.2 --}}
                <section id="sec-4-2" class="docs-section scroll-mt-20">
                    <h2 class="font-headline text-3xl font-bold text-on-surface mb-4">4.2 Model Alur Belajar</h2>
                    <p class="text-sm text-on-surface-variant leading-relaxed mb-6">
                        Model relasi bertingkat untuk kuis dirancang secara linear. `Chapter` memiliki banyak `SubChapter`, yang mana setiap `SubChapter` memiliki banyak `Level`. Setiap `Level` memiliki kuis berupa banyak data `Question` dan pilihan ganda `QuestionOption`.
                    </p>
                </section>

                {{-- Section 5.1 --}}
                <section id="sec-5-1" class="docs-section scroll-mt-20">
                    <h2 class="font-headline text-3xl font-bold text-on-surface mb-4">5.1 Middleware Peran</h2>
                    <p class="text-sm text-on-surface-variant leading-relaxed mb-6">
                        Hak akses dibatasi secara ketat via middleware. Terdapat [IsGuru.php](file:///d:/Development/AksaraLoka/app/Http/Middleware/IsGuru.php) yang memvalidasi bahwa hanya pengguna dengan `role === 'guru'` yang diperkenankan mengakses route Guru:
                    </p>

                    <div class="bg-surface-container-low border border-outline-variant rounded-2xl p-5 font-mono text-xs text-on-surface overflow-x-auto mb-6">
<pre class="text-[#206e1b]"><span class="text-outline-variant">// Pendaftaran middleware alias di bootstrap/app.php</span>
$middleware->alias([
    'admin' => \App\Http\Middleware\IsAdmin::class,
    'guru'  => \App\Http\Middleware\IsGuru::class,
]);</pre>
                    </div>
                </section>

                {{-- Section 5.2 --}}
                <section id="sec-5-2" class="docs-section scroll-mt-20">
                    <h2 class="font-headline text-3xl font-bold text-on-surface mb-4">5.2 Alur Pemantauan Progress</h2>
                    <p class="text-sm text-on-surface-variant leading-relaxed mb-6">
                        Guru memantau data progress belajar mahasiswa terdaftar lewat visualisasi persentase penyelesaian level di halaman detail kelas. Pada menu monitor detail mahasiswa, kueri database menarik riwayat pengerjaan dari tabel `user_level_progress` yang disandingkan dengan alur belajar lengkap untuk melahirkan checklist progres belajar siswa.
                    </p>
                </section>

            </div>

        </main>
    </div>

    {{-- Interactive JavaScript for Docs --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebarLinks = document.querySelectorAll('.docs-sidebar-link');
            const sections = document.querySelectorAll('.docs-section');
            const contentPane = document.getElementById('docsContent');
            const searchInput = document.getElementById('docsSearchInput');
            const emptyState = document.getElementById('docsEmptyState');
            const sidebarCats = document.querySelectorAll('.docs-sidebar-cat');

            // ── ScrollSpy Logic ───────────────────────────────────────────
            const observerOptions = {
                root: contentPane,
                rootMargin: '-10% 0px -70% 0px',
                threshold: 0
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.getAttribute('id');
                        sidebarLinks.forEach(link => {
                            if (link.getAttribute('href') === `#${id}`) {
                                link.classList.add('active-sidebar-link');
                            } else {
                                link.classList.remove('active-sidebar-link');
                            }
                        });
                    }
                });
            }, observerOptions);

            sections.forEach(section => observer.observe(section));

            // ── Search Filtering Logic ────────────────────────────────────
            searchInput.addEventListener('input', () => {
                const query = searchInput.value.toLowerCase().trim();
                let matchesCount = 0;

                sections.forEach(section => {
                    const text = section.innerText.toLowerCase();
                    const isMatch = text.includes(query);

                    if (isMatch) {
                        section.classList.remove('hidden');
                        matchesCount++;
                    } else {
                        section.classList.add('hidden');
                    }
                });

                // Show/hide empty state
                if (matchesCount === 0 && query !== '') {
                    emptyState.classList.remove('hidden');
                } else {
                    emptyState.classList.add('hidden');
                }

                // Filter sidebar links based on search
                sidebarLinks.forEach(link => {
                    const hash = link.getAttribute('href');
                    const targetSection = document.querySelector(hash);
                    
                    if (targetSection && !targetSection.classList.contains('hidden')) {
                        link.parentElement.classList.remove('hidden');
                    } else {
                        link.parentElement.classList.add('hidden');
                    }
                });

                // Hide empty categories in sidebar
                sidebarCats.forEach(cat => {
                    const visibleLinks = cat.querySelectorAll('ul li:not(.hidden)');
                    if (visibleLinks.length === 0 && query !== '') {
                        cat.classList.add('hidden');
                    } else {
                        cat.classList.remove('hidden');
                    }
                });
            });
        });
    </script>
</body>
</html>
