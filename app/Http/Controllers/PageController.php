<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function landing()
    {
        return view('pages.landing');
    }

    public function home()
    {
        return view('pages.home');
    }

    public function materi()
    {
        $materiList = [
            ['href' => route('materi.aksara'), 'judul' => 'Aksara Jawa', 'tag' => 'Dasar', 'desc' => 'Belajar huruf aksara Jawa', 'cat' => 'aksara'],
            ['href' => route('materi.ngoko'),  'judul' => 'Bahasa Ngoko', 'tag' => 'Dasar', 'desc' => 'Bahasa sehari-hari', 'cat' => 'bahasa'],
            ['href' => route('materi.krama'),  'judul' => 'Krama Alus', 'tag' => 'Sopan', 'desc' => 'Bahasa menghormati', 'cat' => 'bahasa'],
            ['href' => route('materi.kosakata'), 'judul' => 'Kosakata & Percakapan', 'tag' => 'Kreatif', 'desc' => 'Salam, perkenalan, dan percakapan sehari-hari', 'cat' => 'kosakata'],
            ['href' => route('materi.cerita'), 'judul' => 'Cerita Jawa', 'tag' => 'Literasi', 'desc' => 'Cerita rakyat & pemahaman teks', 'cat' => 'cerita'],
        ];
        return view('pages.materi', compact('materiList'));
    }

    public function materiAksara()
    {
        $hanacaraka = [
            ['aksara' => 'ꦲ', 'latin' => 'Ha'], ['aksara' => 'ꦤ', 'latin' => 'Na'],
            ['aksara' => 'ꦕ', 'latin' => 'Ca'], ['aksara' => 'ꦫ', 'latin' => 'Ra'],
            ['aksara' => 'ꦏ', 'latin' => 'Ka'], ['aksara' => 'ꦢ', 'latin' => 'Da'],
            ['aksara' => 'ꦠ', 'latin' => 'Ta'], ['aksara' => 'ꦱ', 'latin' => 'Sa'],
            ['aksara' => 'ꦮ', 'latin' => 'Wa'], ['aksara' => 'ꦭ', 'latin' => 'La'],
            ['aksara' => 'ꦥ', 'latin' => 'Pa'], ['aksara' => 'ꦝ', 'latin' => 'Dha'],
            ['aksara' => 'ꦗ', 'latin' => 'Ja'], ['aksara' => 'ꦪ', 'latin' => 'Ya'],
            ['aksara' => 'ꦚ', 'latin' => 'Nya'], ['aksara' => 'ꦩ', 'latin' => 'Ma'],
            ['aksara' => 'ꦒ', 'latin' => 'Ga'], ['aksara' => 'ꦧ', 'latin' => 'Ba'],
            ['aksara' => 'ꦛ', 'latin' => 'Tha'], ['aksara' => 'ꦔ', 'latin' => 'Nga'],
        ];
        $rows = array_chunk($hanacaraka, 5);
        $sandhangan = [
            ['nama' => 'Wulu (i)', 'contoh' => 'ꦏꦶ = ki'], ['nama' => 'Suku (u)', 'contoh' => 'ꦏꦸ = ku'],
            ['nama' => 'Taling (é)', 'contoh' => 'ꦏꦺ = ké'], ['nama' => 'Pepet (e)', 'contoh' => 'ꦏꦼ = ke'],
        ];
        $contohKata = [
            ['latin' => 'Mangan', 'aksara' => 'ꦩꦔꦤ'], ['latin' => 'Kula', 'aksara' => 'ꦏꦸꦭ'],
            ['latin' => 'Omah', 'aksara' => 'ꦄꦩꦃ'], ['latin' => 'Banyu', 'aksara' => 'ꦧꦚꦸ'],
        ];
        return view('pages.materi-aksara', compact('hanacaraka', 'rows', 'sandhangan', 'contohKata'));
    }

    public function materiNgoko()
    {
        $kosakata = [
            ['ngoko' => 'Aku', 'indonesia' => 'Saya'], ['ngoko' => 'Kowe', 'indonesia' => 'Kamu'],
            ['ngoko' => 'Mangan', 'indonesia' => 'Makan'], ['ngoko' => 'Turu', 'indonesia' => 'Tidur'],
            ['ngoko' => 'Lunga', 'indonesia' => 'Pergi'], ['ngoko' => 'Ngombe', 'indonesia' => 'Minum'],
            ['ngoko' => 'Omah', 'indonesia' => 'Rumah'], ['ngoko' => 'Banyu', 'indonesia' => 'Air'],
        ];
        $kalimat = ['Aku mangan.', 'Kowe lunga neng endi?', 'Aku arep turu.', 'Aku ngombe banyu.'];
        $percakapan = [
            ['nama' => 'A', 'ucap' => 'Hei, kowe lagi apa?'], ['nama' => 'B', 'ucap' => 'Aku lagi mangan.'],
            ['nama' => 'A', 'ucap' => 'Bareng aku yo!'], ['nama' => 'B', 'ucap' => 'Iyo, ayo!'],
        ];
        return view('pages.materi-ngoko', compact('kosakata', 'kalimat', 'percakapan'));
    }

    public function materiKrama()
    {
        $kosakata = [
            ['ngoko' => 'Aku', 'krama' => 'Kula'], ['ngoko' => 'Kowe', 'krama' => 'Panjenengan'],
            ['ngoko' => 'Mangan', 'krama' => 'Nedha'], ['ngoko' => 'Lunga', 'krama' => 'Kesah'],
            ['ngoko' => 'Turu', 'krama' => 'Sare'], ['ngoko' => 'Omah', 'krama' => 'Griyo'],
            ['ngoko' => 'Ngombe', 'krama' => 'Ngunjuk'], ['ngoko' => 'Weruh', 'krama' => 'Mangertos'],
        ];
        $percakapan = [
            ['nama' => 'A', 'ucap' => 'Sugeng enjing, Pak.'], ['nama' => 'B', 'ucap' => 'Nggih, sugeng enjing.'],
            ['nama' => 'A', 'ucap' => 'Panjenengan badhe tindak pundi?'], ['nama' => 'B', 'ucap' => 'Kula badhe kesah dhateng pasar.'],
        ];
        return view('pages.materi-krama', compact('kosakata', 'percakapan'));
    }

    public function kosakata()
    {
        $salam = [
            ['jawa' => 'Sugeng enjing', 'indonesia' => 'Selamat pagi', 'konteks' => 'Pagi hari'],
            ['jawa' => 'Sugeng siang', 'indonesia' => 'Selamat siang', 'konteks' => 'Siang hari'],
            ['jawa' => 'Sugeng sonten', 'indonesia' => 'Selamat sore', 'konteks' => 'Sore hari'],
            ['jawa' => 'Sugeng dalu', 'indonesia' => 'Selamat malam', 'konteks' => 'Malam hari'],
            ['jawa' => 'Piye kabarmu?', 'indonesia' => 'Apa kabar?', 'konteks' => 'Menanyakan kondisi'],
        ];
        $keluarga = [
            ['jawa' => 'Bapak', 'indonesia' => 'Ayah'], ['jawa' => 'Ibu', 'indonesia' => 'Ibu'],
            ['jawa' => 'Kakang', 'indonesia' => 'Kakak laki-laki'], ['jawa' => 'Mbak', 'indonesia' => 'Kakak perempuan'],
            ['jawa' => 'Adhi', 'indonesia' => 'Adik'], ['jawa' => 'Eyang', 'indonesia' => 'Kakek/Nenek'],
        ];
        $aktivitas = [
            ['jawa' => 'Mangan', 'indonesia' => 'Makan'], ['jawa' => 'Ngombe', 'indonesia' => 'Minum'],
            ['jawa' => 'Turu', 'indonesia' => 'Tidur'], ['jawa' => 'Lunga', 'indonesia' => 'Pergi'],
            ['jawa' => 'Mulih', 'indonesia' => 'Pulang'], ['jawa' => 'Sinau', 'indonesia' => 'Belajar'],
            ['jawa' => 'Dolanan', 'indonesia' => 'Bermain'], ['jawa' => 'Makarya', 'indonesia' => 'Bekerja'],
        ];
        $dialog = [
            ['nama' => 'Budi', 'ucap' => 'Sugeng enjing, Siti!'],
            ['nama' => 'Siti', 'ucap' => 'Sugeng enjing, Budi. Piye kabarmu?'],
            ['nama' => 'Budi', 'ucap' => 'Apik, matur nuwun. Kowe arep neng ngendi?'],
            ['nama' => 'Siti', 'ucap' => 'Aku arep sinau neng perpustakaan.'],
            ['nama' => 'Budi', 'ucap' => 'Wah, apik! Ayo bebarengan.'],
            ['nama' => 'Siti', 'ucap' => 'Iyo, ayo!'],
        ];
        $pola = [
            ['pola' => 'Subyek + Predikat', 'contoh' => 'Aku mangan.'],
            ['pola' => 'Subyek + Predikat + Obyek', 'contoh' => 'Aku mangan sega.'],
            ['pola' => 'Subyek + arep + Predikat', 'contoh' => 'Aku arep lunga.'],
            ['pola' => 'Subyek + lagi + Predikat', 'contoh' => 'Aku lagi sinau.'],
        ];
        return view('pages.kosakata', compact('salam', 'keluarga', 'aktivitas', 'dialog', 'pola'));
    }

    public function materiCerita()
    {
        $jenisTeks = [
            ['nama' => 'Narasi', 'desc' => 'Crita utawa kedadeyan kang urut wektune'],
            ['nama' => 'Deskripsi', 'desc' => 'Gambaran sawijining kahanan utawa barang'],
            ['nama' => 'Eksposisi', 'desc' => 'Njlentrehake informasi kanthi runtut'],
            ['nama' => 'Argumentasi', 'desc' => 'Nyampekake panemune penulis kanthi bukti'],
            ['nama' => 'Persuasi', 'desc' => 'Ngajak pamaca nglakoni sawijining tumindak'],
        ];
        $unsurCerita = [
            ['nama' => 'Tema', 'desc' => 'Gagasan utama sing dadi dhasare crita'],
            ['nama' => 'Alur', 'desc' => 'Urutan kedadeyan ing crita (maju / mundur)'],
            ['nama' => 'Tokoh', 'desc' => 'Paraga sing ana ing crita'],
            ['nama' => 'Latar', 'desc' => 'Panggonan, wektu, lan kahanan crita'],
            ['nama' => 'Amanat', 'desc' => 'Piwulang kang bisa dijupuk saka crita'],
        ];
        $unsurParagraf = [
            ['nama' => 'Gagasan utama', 'desc' => 'Inti pikiran paragraf'],
            ['nama' => 'Kalimat utama', 'desc' => 'Kalimat sing ngemot gagasan utama'],
            ['nama' => 'Kalimat penjelas', 'desc' => 'Rincian tambahan'],
            ['nama' => 'Kalimat penegas', 'desc' => 'Penguat (opsional)'],
        ];
        return view('pages.materi-cerita', compact('jenisTeks', 'unsurCerita', 'unsurParagraf'));
    }

    public function peringkat()
    {
        $leaderboard = [
            ['rank' => 1, 'nama' => 'Dwiki A.R.', 'xp' => 4200, 'level' => 12, 'badge' => '🥇'],
            ['rank' => 2, 'nama' => 'Zaki W.L.', 'xp' => 3750, 'level' => 11, 'badge' => '🥈'],
            ['rank' => 3, 'nama' => 'Hafid F.', 'xp' => 3200, 'level' => 10, 'badge' => '🥉'],
            ['rank' => 4, 'nama' => 'Arjuna Pratama', 'xp' => 2800, 'level' => 9, 'badge' => ''],
            ['rank' => 5, 'nama' => 'Siti Rahayu', 'xp' => 2400, 'level' => 8, 'badge' => ''],
            ['rank' => 6, 'nama' => 'Bima Sakti', 'xp' => 2100, 'level' => 7, 'badge' => ''],
            ['rank' => 7, 'nama' => 'Dewi Ratnasari', 'xp' => 1800, 'level' => 6, 'badge' => ''],
            ['rank' => 8, 'nama' => 'Raka Firmansyah', 'xp' => 1500, 'level' => 5, 'badge' => ''],
            ['rank' => 9, 'nama' => 'Nadia Putri', 'xp' => 1200, 'level' => 4, 'badge' => ''],
            ['rank' => 10, 'nama' => 'Galih Wicaksono', 'xp' => 900, 'level' => 3, 'badge' => ''],
        ];
        $topThree = array_slice($leaderboard, 0, 3);
        $sisaRanking = array_slice($leaderboard, 3);
        return view('pages.peringkat', compact('topThree', 'sisaRanking', 'leaderboard'));
    }

    public function privasi()
    {
        $pasal = [
            ['judul' => '1. Pengumpulan Informasi', 'isi' => 'AksaraLoka dapat mengumpulkan informasi pribadi pengguna, seperti nama dan alamat email, serta data penggunaan yang berkaitan dengan aktivitas pembelajaran di dalam platform.'],
            ['judul' => '2. Penggunaan Informasi', 'isi' => 'Informasi yang dikumpulkan digunakan untuk meningkatkan kualitas layanan, mengembangkan fitur, serta memberikan pengalaman belajar yang lebih optimal kepada pengguna.'],
            ['judul' => '3. Perlindungan Data', 'isi' => 'AksaraLoka berkomitmen untuk menjaga keamanan data pengguna dengan menerapkan langkah-langkah perlindungan yang wajar guna mencegah akses, perubahan, atau penyalahgunaan data tanpa izin.'],
            ['judul' => '4. Penggunaan Cookies', 'isi' => 'Platform ini dapat menggunakan cookies untuk menyimpan preferensi pengguna dan meningkatkan efisiensi serta kenyamanan dalam penggunaan layanan.'],
            ['judul' => '5. Perubahan Kebijakan', 'isi' => 'Kebijakan Privasi ini dapat diperbarui sewaktu-waktu. Setiap perubahan akan ditampilkan pada halaman ini dan berlaku sejak tanggal pembaruan.'],
            ['judul' => '6. Kontak', 'isi' => 'Apabila terdapat pertanyaan atau permintaan terkait kebijakan ini, pengguna dapat menghubungi tim AksaraLoka melalui halaman kontak yang tersedia.'],
        ];
        return view('pages.privasi', compact('pasal'));
    }
}
