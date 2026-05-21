<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_level_progress', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $blueprint->foreignId('level_id')->constrained('levels')->onDelete('cascade');
            $blueprint->boolean('is_completed')->default(false);
            $blueprint->timestamp('completed_at')->useCurrent();
            $blueprint->timestamps();

            // Mencegah duplikasi data agar user tidak menyimpan progress ganda di level yang sama
            $blueprint->unique(['user_id', 'level_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_level_progress');
    }
};