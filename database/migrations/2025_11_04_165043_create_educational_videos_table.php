<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('educational_videos', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel users (creator video)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Data utama video
            $table->string('title');
            $table->string('category')->nullable();
            $table->text('excerpt')->nullable(); // ringkasan singkat
            $table->string('thumbnail')->nullable(); // gambar preview
            $table->string('video_url'); // path atau link video
            $table->integer('duration')->nullable(); // durasi video (menit)

            // Statistik video
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educational_videos');
    }
};
