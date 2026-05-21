<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            
            // Fitur Gamifikasi ala Duolingo
            $table->integer('streak_count')->default(0); // Mencatat ikon api (streak harian)
            $table->integer('total_points')->default(0); // Mencatat total EXP / Koin pengguna
            
            $table->timestamps(); // Otomatis membuat kolom 'created_at' dan 'updated_at'
            
            // Fitur Soft Delete (Penghapusan Semu)
            // Otomatis membuat kolom 'deleted_at'. Jika user menghapus akun, 
            // kolom ini akan terisi waktu penghapusan (bukan NULL lagi).
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};