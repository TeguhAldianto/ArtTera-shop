<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Info Pengiriman (Sesuai checkout.html dan update_address.html)
            $table->string('name');
            $table->string('number');
            $table->string('email');
            $table->string('method'); // Cash on delivery, credit card, dll
            $table->text('address'); // Gabungan jalan, kota, negara

            $table->decimal('total_price', 12, 0); // Total belanja
            $table->string('payment_status')->default('pending'); // pending/completed

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
