<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Kita masukkan data dari gallery.html ke sini
        DB::table('products')->insert([
            [
                'name' => 'Batik Shoes Hand Made',
                'category' => 'shoes',
                'price' => 420000,
                'image' => 'sepatu1.jpeg', // Pastikan file ini ada di public/uploaded_img
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jaket Jeans',
                'category' => 'clothes',
                'price' => 558000,
                'image' => 'jaket1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wall Decoration',
                'category' => 'paint',
                'price' => 620000,
                'image' => 'lukisan1.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paint Totebag',
                'category' => 'bags',
                'price' => 120000,
                'image' => 'totebag1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Anda bisa tambahkan produk lain dari gallery.html di sini
        ]);
    }
}
