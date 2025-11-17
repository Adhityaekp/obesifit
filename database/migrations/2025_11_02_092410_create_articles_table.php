<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel users (penulis artikel)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Data utama artikel
            $table->string('title');
            $table->string('category')->nullable();
            $table->text('excerpt')->nullable(); // ringkasan singkat
            $table->string('featured_image')->nullable(); // gambar utama
            $table->integer('read_time')->nullable(); // dalam menit

            // Statistik artikel
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
