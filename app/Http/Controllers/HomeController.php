<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    // Halaman Utama
    public function index()
    {
        $products = Product::latest()->take(6)->get();
        return view('home', ['all_products' => $products]);
    }

    // Halaman Gallery
    public function gallery()
    {
        $products = Product::latest()->get();
        return view('gallery', ['all_products' => $products]);
    }

    // PERBAIKAN: Fungsi untuk menampilkan Detail Produk
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product_details', ['product' => $product]);
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function search(Request $request)
    {
        $query = $request->input('search_box');

        if ($query) {
            $products = Product::where('name', 'LIKE', "%{$query}%")
                ->orWhere('category', 'LIKE', "%{$query}%")
                ->get();
        } else {
            $products = collect();
        }

        return view('search', ['products' => $products, 'query' => $query]);
    }
}
