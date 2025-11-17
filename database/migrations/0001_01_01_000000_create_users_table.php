<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable(); // Tambahkan ini
            $table->string('phone')->nullable();
            $table->string('alamat')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('password');
            $table->enum('role', ['user', 'doctor', 'admin'])->default('user');
            $table->string('specialization')->nullable();
            $table->string('license_number')->nullable();
            $table->string('profile_photo')->nullable();
            $table->boolean('is_active')->default(true);
            $table->time('practice_start_time')->nullable(); // jam mulai praktek dokter
            $table->time('practice_end_time')->nullable();   // jam selesai praktek dokter
            $table->string('practice_days')->nullable();
            $table->boolean('is_online')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};