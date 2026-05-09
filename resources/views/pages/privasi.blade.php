@extends('layouts.landing')

@section('title', 'Kebijakan Privasi')

@section('content')
<main class="pt-32 pb-20 bg-surface-container-low min-h-screen">
    <div class="max-w-4xl mx-auto px-6">
        <div class="bg-surface-container-lowest p-10 md:p-16 rounded-[3rem] shadow-sm border border-outline-variant">
            <h1 class="font-headline text-4xl text-primary font-bold mb-8">Kebijakan Privasi</h1>
            
            <div class="prose prose-slate max-w-none text-on-surface-variant leading-relaxed space-y-8">
                <section>
                    <h2 class="text-xl font-bold text-on-surface mb-4">1. Informasi yang Kami Kumpulkan</h2>
                    <p>Aksaraloka mengumpulkan informasi minimal yang diperlukan untuk menyediakan pengalaman belajar yang personal:</p>
                    <ul class="list-disc ml-6 mt-4 space-y-2">
                        <li><strong>Informasi Akun:</strong> Nama pengguna, alamat email, dan kata sandi terenkripsi.</li>
                        <li><strong>Progres Belajar:</strong> Data latihan yang diselesaikan, skor XP, level, dan pencapaian.</li>
                        <li><strong>Data Teknis:</strong> Alamat IP dan informasi browser untuk keamanan sesi.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-on-surface mb-4">2. Penggunaan Informasi</h2>
                    <p>Kami menggunakan informasi Anda hanya untuk:</p>
                    <ul class="list-disc ml-6 mt-4 space-y-2">
                        <li>Mengelola akun dan melacak progres belajar Anda.</li>
                        <li>Menampilkan peringkat Anda di papan peringkat global.</li>
                        <li>Mengirimkan notifikasi penting terkait layanan (jika diperlukan).</li>
                        <li>Meningkatkan kualitas materi dan pengalaman pengguna di platform.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-on-surface mb-4">3. Keamanan Data</h2>
                    <p>Keamanan data Anda adalah prioritas kami. Aksaraloka menggunakan enkripsi standar industri (Bcrypt) untuk menyimpan kata sandi Anda. Kami tidak pernah membagikan atau menjual data pribadi Anda kepada pihak ketiga mana pun.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-on-surface mb-4">4. Hak Anda</h2>
                    <p>Anda memiliki hak penuh atas data Anda, termasuk:</p>
                    <ul class="list-disc ml-6 mt-4 space-y-2">
                        <li>Hak untuk mengakses dan memperbarui informasi profil Anda kapan saja.</li>
                        <li>Hak untuk menghapus akun dan seluruh data terkait secara permanen melalui menu Pengaturan Profil.</li>
                    </ul>
                </section>

                <div class="pt-10 border-t border-outline-variant flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary/10 text-primary rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined">security</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-on-surface">Data Anda Aman</p>
                            <p class="text-[10px] text-on-surface-variant">Terakhir diperbarui: 8 Mei 2026</p>
                        </div>
                    </div>
                    <a href="{{ route('landing') }}" class="px-8 py-3 bg-surface-container-high text-on-surface font-bold rounded-xl hover:bg-primary/10 hover:text-primary transition-all text-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
