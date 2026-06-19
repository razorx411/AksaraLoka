<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class LibrarySeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing first
        Library::truncate();

        // 1. Aksara Jawa
        Library::create([
            'slug'        => 'aksara-jawa',
            'title'       => 'Aksara Jawa',
            'subtitle'    => 'Huruf dasar Hanacaraka beserta sandhangan dan contoh kata',
            'category'    => 'aksara',
            'tag'         => 'Dasar',
            'description' => 'Belajar huruf aksara Jawa (Nglegena) dan sandhangan serta contoh pemakaiannya.',
            'content'     => [
                'hanacaraka' => [
                    ['aksara' => 'ꦲ', 'latin' => 'Ha'], ['aksara' => 'ꦤ', 'latin' => 'Na'],
                    ['aksara' => 'ꦕ', 'latin' => 'Ca'], ['aksara' => 'ꦫ', 'latin' => 'Ra'],
                    ['aksara' => 'ꦏ', 'latin' => 'Ka'], ['aksara' => 'ꦢ', 'latin' => 'Da'],
                    ['aksara' => 'ꦠ', 'latin' => 'Ta'], ['aksara' => 'ꦱ', 'latin' => 'Sa'],
                    ['aksara' => 'ꦮ', 'latin' => 'Wa'], ['aksara' => 'ꦭ', 'latin' => 'La'],
                    ['aksara' => 'ꦥ', 'latin' => 'Pa'], ['aksara' => 'ꦝ', 'latin' => 'Dha'],
                    ['aksara' => 'ꦗ', 'latin' => 'Ja'], ['aksara' => 'ꦪ', 'latin' => 'Ya'],
                    ['aksara' => 'ꦚ', 'latin' => 'Nya'],['aksara' => 'ꦩ', 'latin' => 'Ma'],
                    ['aksara' => 'ꦒ', 'latin' => 'Ga'], ['aksara' => 'ꦧ', 'latin' => 'Ba'],
                    ['aksara' => 'ꦛ', 'latin' => 'Tha'],['aksara' => 'ꦔ', 'latin' => 'Nga'],
                ],
                'sandhangan' => [
                    ['nama' => 'Wulu (i)',   'contoh' => 'ꦏꦶ = ki'], ['nama' => 'Suku (u)',   'contoh' => 'ꦏꦸ = ku'],
                    ['nama' => 'Taling (é)', 'contoh' => 'ꦏꦺ = ké'], ['nama' => 'Pepet (e)',  'contoh' => 'ꦏꦼ = ke'],
                ],
                'contohKata' => [
                    ['latin' => 'Mangan', 'aksara' => 'ꦩꦔꦤ'], ['latin' => 'Kula',  'aksara' => 'ꦏꦸꦭ'],
                    ['latin' => 'Omah',   'aksara' => 'ꦄꦩꦃ'],  ['latin' => 'Banyu', 'aksara' => 'ꦧꦚꦸ'],
                ]
            ]
        ]);

        // 2. Bahasa Ngoko
        Library::create([
            'slug'        => 'bahasa-ngoko',
            'title'       => 'Bahasa Ngoko',
            'subtitle'    => 'Penggunaan bahasa Jawa tingkat dasar sehari-hari',
            'category'    => 'bahasa',
            'tag'         => 'Dasar',
            'description' => 'Mempelajari kosakata dasar, struktur kalimat, dan dialog sehari-hari tingkat Ngoko.',
            'content'     => [
                'kosakata' => [
                    ['ngoko' => 'Aku',    'indonesia' => 'Saya'],  ['ngoko' => 'Kowe',   'indonesia' => 'Kamu'],
                    ['ngoko' => 'Mangan', 'indonesia' => 'Makan'], ['ngoko' => 'Turu',   'indonesia' => 'Tidur'],
                    ['ngoko' => 'Lunga',  'indonesia' => 'Pergi'], ['ngoko' => 'Ngombe', 'indonesia' => 'Minum'],
                    ['ngoko' => 'Omah',   'indonesia' => 'Rumah'], ['ngoko' => 'Banyu',  'indonesia' => 'Air'],
                ],
                'kalimat' => [
                    'Aku mangan.',
                    'Kowe lunga neng endi?',
                    'Aku arep turu.',
                    'Aku ngombe banyu.'
                ],
                'percakapan' => [
                    ['nama' => 'Budi', 'ucap' => 'Hei, kowe lagi apa?'],
                    ['nama' => 'Siti', 'ucap' => 'Aku lagi mangan.'],
                    ['nama' => 'Budi', 'ucap' => 'Bareng aku yo!'],
                    ['nama' => 'Siti', 'ucap' => 'Iyo, ayo!'],
                ]
            ]
        ]);

        // 3. Krama Alus
        Library::create([
            'slug'        => 'krama-alus',
            'title'       => 'Krama Alus',
            'subtitle'    => 'Tingkatan bahasa sopan untuk menghormati orang lain',
            'category'    => 'bahasa',
            'tag'         => 'Menengah',
            'description' => 'Mempelajari perbedaan padanan kata Ngoko ke Krama Alus dan percakapan formal.',
            'content'     => [
                'kosakata' => [
                    ['ngoko' => 'Aku',    'krama' => 'Kula'],         ['ngoko' => 'Kowe',   'krama' => 'Panjenengan'],
                    ['ngoko' => 'Mangan', 'krama' => 'Nedha'],        ['ngoko' => 'Lunga',  'krama' => 'Kesah'],
                    ['ngoko' => 'Turu',   'krama' => 'Sare'],         ['ngoko' => 'Omah',   'krama' => 'Griyo'],
                    ['ngoko' => 'Ngombe', 'krama' => 'Ngunjuk'],      ['ngoko' => 'Weruh',  'krama' => 'Mangertos'],
                ],
                'percakapan' => [
                    ['nama' => 'Slamet', 'ucap' => 'Sugeng enjing, Pak.'],
                    ['nama' => 'Pak Joko', 'ucap' => 'Nggih, sugeng enjing.'],
                    ['nama' => 'Slamet', 'ucap' => 'Panjenengan badhe tindak pundi?'],
                    ['nama' => 'Pak Joko', 'ucap' => 'Kula badhe kesah dhateng pasar.'],
                ]
            ]
        ]);

        // 4. Kosakata & Percakapan
        Library::create([
            'slug'        => 'kosakata-percakapan',
            'title'       => 'Kosakata & Percakapan',
            'subtitle'    => 'Kamus saku kosakata penting beserta contoh dialog terapan',
            'category'    => 'kosakata',
            'tag'         => 'Menengah',
            'description' => 'Kumpulan kosakata salam, anggota keluarga, aktivitas harian, serta pola kalimat.',
            'content'     => [
                'salam' => [
                    ['jawa' => 'Sugeng enjing',  'indonesia' => 'Selamat pagi',  'konteks' => 'Pagi hari'],
                    ['jawa' => 'Sugeng siang',   'indonesia' => 'Selamat siang', 'konteks' => 'Siang hari'],
                    ['jawa' => 'Sugeng sonten',  'indonesia' => 'Selamat sore',  'konteks' => 'Sore hari'],
                    ['jawa' => 'Sugeng dalu',    'indonesia' => 'Selamat malam', 'konteks' => 'Malam hari'],
                    ['jawa' => 'Piye kabarmu?',  'indonesia' => 'Apa kabar?',    'konteks' => 'Menanyakan kondisi'],
                ],
                'keluarga' => [
                    ['jawa' => 'Bapak',  'indonesia' => 'Ayah'],            ['jawa' => 'Ibu',   'indonesia' => 'Ibu'],
                    ['jawa' => 'Kakang', 'indonesia' => 'Kakak laki-laki'], ['jawa' => 'Mbak',  'indonesia' => 'Kakak perempuan'],
                    ['jawa' => 'Adhi',   'indonesia' => 'Adik'],            ['jawa' => 'Eyang', 'indonesia' => 'Kakek/Nenek'],
                ],
                'aktivitas' => [
                    ['jawa' => 'Mangan',  'indonesia' => 'Makan'],   ['jawa' => 'Ngombe',  'indonesia' => 'Minum'],
                    ['jawa' => 'Turu',    'indonesia' => 'Tidur'],   ['jawa' => 'Lunga',   'indonesia' => 'Pergi'],
                    ['jawa' => 'Mulih',   'indonesia' => 'Pulang'],  ['jawa' => 'Sinau',   'indonesia' => 'Belajar'],
                    ['jawa' => 'Dolanan', 'indonesia' => 'Bermain'], ['jawa' => 'Makarya', 'indonesia' => 'Bekerja'],
                ],
                'dialog' => [
                    ['nama' => 'Budi', 'ucap' => 'Sugeng enjing, Siti!'],
                    ['nama' => 'Siti', 'ucap' => 'Sugeng enjing, Budi. Piye kabarmu?'],
                    ['nama' => 'Budi', 'ucap' => 'Apik, matur nuwun. Kowe arep neng ngendi?'],
                    ['nama' => 'Siti', 'ucap' => 'Aku arep sinau neng perpustakaan.'],
                    ['nama' => 'Budi', 'ucap' => 'Wah, apik! Ayo bebarengan.'],
                    ['nama' => 'Siti', 'ucap' => 'Iyo, ayo!'],
                ],
                'pola' => [
                    ['pola' => 'Subyek + Predikat',           'contoh' => 'Aku mangan.'],
                    ['pola' => 'Subyek + Predikat + Obyek',   'contoh' => 'Aku mangan sega.'],
                    ['pola' => 'Subyek + arep + Predikat',    'contoh' => 'Aku arep lunga.'],
                    ['pola' => 'Subyek + lagi + Predikat',    'contoh' => 'Aku lagi sinau.'],
                ]
            ]
        ]);

        // 5. Cerita Jawa
        Library::create([
            'slug'        => 'cerita-jawa',
            'title'       => 'Cerita Jawa',
            'subtitle'    => 'Panduan literasi, jenis teks, dan unsur intrinsik karya cerita',
            'category'    => 'cerita',
            'tag'         => 'Lanjutan',
            'description' => 'Mempelajari arsitektur cerita Jawa mulai dari jenis paragraf hingga unsur-unsur intrinsiknya.',
            'content'     => [
                'jenisTeks' => [
                    ['nama' => 'Narasi',      'desc' => 'Crita utawa kedadeyan kang urut wektune'],
                    ['nama' => 'Deskripsi',   'desc' => 'Gambaran sawijining kahanan utawa barang'],
                    ['nama' => 'Eksposisi',   'desc' => 'Njlentrehake informasi kanthi runtut'],
                    ['nama' => 'Argumentasi', 'desc' => 'Nyampekake panemune penulis kanthi bukti'],
                    ['nama' => 'Persuasi',    'desc' => 'Ngajak pamaca nglakoni sawijining tumindak'],
                ],
                'unsurCerita' => [
                    ['nama' => 'Tema',    'desc' => 'Gagasan utama sing dadi dhasare crita'],
                    ['nama' => 'Alur',    'desc' => 'Urutan kedadeyan ing crita (maju / mundur)'],
                    ['nama' => 'Tokoh',   'desc' => 'Paraga sing ana ing crita'],
                    ['nama' => 'Latar',   'desc' => 'Panggonan, wektu, lan kahanan crita'],
                    ['nama' => 'Amanat',  'desc' => 'Piwulang kang bisa dijupuk saka crita'],
                ],
                'unsurParagraf' => [
                    ['nama' => 'Gagasan utama',   'desc' => 'Inti pikiran paragraf'],
                    ['nama' => 'Kalimat utama',   'desc' => 'Kalimat sing ngemot gagasan utama'],
                    ['nama' => 'Kalimat penjelas','desc' => 'Rincian tambahan'],
                    ['nama' => 'Kalimat penegas', 'desc' => 'Penguat (opsional)'],
                ]
            ]
        ]);
    }
}

