<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    // Halaman Utama
    public function index()
    {
        // Ambil 6 produk terbaru saja untuk di Home
        $products = Product::latest()->take(6)->get();
        return view('home', ['all_products' => $products]);
    }

    // Halaman Gallery (Menampilkan Semua Produk)
    public function gallery()
    {
        // Ambil SEMUA produk
        $products = Product::latest()->get();
        return view('gallery', ['all_products' => $products]);
    }

    // Halaman About
    public function about()
    {
        return view('about');
    }

    // Halaman Contact
    public function contact()
    {
        return view('contact');
    }

    // 5. Fitur Pencarian
    public function search(Request $request)
    {
        // Ambil apa yang diketik user di kotak pencarian
        $query = $request->input('search_box');

        // Cari di database: Produk yang namanya MIRIP dengan ketikan user
        // 'like' dan '%' artinya mencari kecocokan sebagian kata
        if ($query) {
            $products = Product::where('name', 'LIKE', "%{$query}%")
                ->orWhere('category', 'LIKE', "%{$query}%") // Opsional: Cari di kategori juga
                ->get();
        } else {
            $products = collect(); // Kalau tidak mengetik apa-apa, kosongkan hasil
        }

        return view('search', ['products' => $products, 'query' => $query]);
    }

    // Jangan lupa tutup kurung kurawal class di sini
}
