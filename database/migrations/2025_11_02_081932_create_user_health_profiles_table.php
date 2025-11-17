<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_health_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Data kesehatan
            $table->float('height')->nullable()->comment('Tinggi badan (cm)');
            $table->float('weight')->nullable()->comment('Berat badan (kg)');
            $table->string('blood_type', 3)->nullable()->comment('Golongan darah');
            $table->string('blood_pressure', 10)->nullable()->comment('Tekanan darah, contoh: 120/80');
            $table->text('disease_history')->nullable()->comment('Riwayat penyakit');
            $table->text('allergies')->nullable()->comment('Alergi');

            // Target kesehatan
            $table->float('target_weight')->nullable()->comment('Target berat badan (kg)');
            $table->integer('workout_frequency_per_week')->nullable()->comment('Target olahraga per minggu');
            $table->float('workout_progress')->nullable()->comment('Persentase progress olahraga');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_health_profiles');
    }
};
