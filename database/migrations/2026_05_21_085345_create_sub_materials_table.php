<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_materials', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel materi utama
            $table->foreignId('material_id')->constrained('materials')->onDelete('cascade');
            $table->string('title'); // Contoh: "Aksara Dasar", "Pasangan", "Sandhangan"
            $table->text('description')->nullable(); // Deskripsi singkat jika dibutuhkan
            $table->integer('order_index'); // Untuk mengurutkan list materi dari atas ke bawah
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_materials');
    }
};