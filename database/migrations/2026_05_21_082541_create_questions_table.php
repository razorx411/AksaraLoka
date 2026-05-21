<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $blueprint) {
            $blueprint->id();
            // Menghubungkan ke tabel levels (bulatan soal)
            $blueprint->foreignId('level_id')->constrained('levels')->onDelete('cascade');
            $blueprint->text('instruction'); // "Ubah kata menjadi Basa Ngoko"
            $blueprint->text('question_text'); // "Makan"
            $blueprint->string('question_type')->default('multiple_choice');
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};