<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_contents', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel sub_materials
            $table->foreignId('sub_material_id')->constrained('sub_materials')->onDelete('cascade');
            $table->string('title'); // Contoh: "Ha", "Na", "Ca"
            $table->string('subtitle')->nullable(); // Contoh label di bawahnya: "Aksara Nglegena"
            $table->string('image_path')->nullable(); // Menyimpan nama file gambar karakter aksaranya (jika menggunakan gambar)
            $table->text('additional_info')->nullable(); // Tempat narasi atau keterangan cara pelafalan/penulisan materi detailnya
            $table->integer('order_index'); // Mengatur urutan grid kartu materi (kiri ke kanan, atas ke bawah)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_contents');
    }
};
