<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('levels', function (Blueprint $blueprint) {
            $blueprint->id();
            // Menghubungkan ke tabel sub_chapters
            $blueprint->foreignId('sub_chapter_id')->constrained('sub_chapters')->onDelete('cascade');
            $blueprint->string('title'); // Misal: "Level 1"
            $blueprint->integer('order_index'); // Urutan bulatan
            $blueprint->integer('xp_reward')->default(10); // Hadiah poin
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('levels');
    }
};
