<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('question_options', function (Blueprint $blueprint) {
            $blueprint->id();
            // Menghubungkan ke tabel questions
            $blueprint->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            $blueprint->string('option_text'); // "Mangan", "Turu"
            $blueprint->boolean('is_correct')->default(false); // Penentu jawaban benar
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('question_options');
    }
};