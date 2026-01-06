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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // ID Unik (No. Rak)
            $table->string('name'); // Nama Produk (cth: Batik Shoes)
            $table->string('category'); // Kategori (cth: shoes)
            $table->decimal('price', 10, 0); // Harga (cth: 420000) - pakai decimal agar aman
            $table->string('image'); // Nama file gambar (cth: sepatu1.jpeg)
            $table->timestamps(); // Mencatat kapan dibuat/diedit
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
