<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('icon')->default('workspace_premium');
            $table->string('color')->default('primary'); // primary | secondary | tertiary
            $table->string('condition_type');
            // Supported: first_level, levels_5, levels_10, levels_20,
            //            streak_3, streak_7, streak_30,
            //            xp_100, xp_500, xp_1000
            $table->integer('condition_value')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};

