<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Contoh: "Aksara Jawa", "Ngoko"
            $table->string('slug')->unique(); // Untuk kebutuhan URL routing (misal: /perpustakaan/aksara-jawa)
            $table->integer('order_index'); // Untuk mengurutkan tab menu filter
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};