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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            // Siapa yang belanja? (Hubungkan ke tabel users)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Barang apa yang dibeli? (Hubungkan ke tabel products)
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            // Berapa banyak?
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
