<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();

            // Relasi ke user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Info paket langganan
            $table->string('plan_name'); // contoh: Basic, Premium, Pro
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('duration_days')->default(30); // lama berlangganan dalam hari

            // Tanggal aktif dan berakhir
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();

            // Status langganan
            $table->enum('status', ['active', 'expired', 'cancelled', 'pending'])->default('pending');

            // Optional: data pembayaran
            $table->string('payment_method')->nullable(); // midtrans, xendit, manual, dll
            $table->string('transaction_id')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('payment_token')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
