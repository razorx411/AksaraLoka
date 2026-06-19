<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chapters', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('title');
            $blueprint->text('description')->nullable();
            $blueprint->integer('order_index'); // Mengatur urutan bab
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
