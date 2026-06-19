<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_chapters', function (Blueprint $blueprint) {
            $blueprint->id();
            // Menghubungkan ke tabel chapters
            $blueprint->foreignId('chapter_id')->constrained('chapters')->onDelete('cascade');
            $blueprint->string('title');
            $blueprint->integer('order_index');
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_chapters');
    }
};
