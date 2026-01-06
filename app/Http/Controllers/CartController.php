<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 1. Tambah Barang ke Keranjang
    public function addToCart(Request $request, $productId)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login dulu!');
        }

        $userId = Auth::id();

        // Cek apakah barang ini sudah ada di keranjang user tersebut?
        $existingCart = Cart::where('user_id', $userId)
                            ->where('product_id', $productId)
                            ->first();

        if ($existingCart) {
            // Jika sudah ada, kita anggap user ingin update jumlahnya?
            // Atau sementara kita biarkan (info: barang sudah di keranjang)
            return redirect()->back()->with('warning', 'Produk sudah ada di keranjang!');
        } else {
            // Jika belum ada, buat baru
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $request->qty // Ambil jumlah dari input form
            ]);
        }

        return redirect('/cart')->with('success', 'Produk berhasil ditambahkan!');
    }

    // 2. Lihat Isi Keranjang
    public function showCart()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Ambil semua data keranjang milik User yang sedang login
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        return view('cart', ['cartItems' => $cartItems]);
    }

    // 3. Update Jumlah (Qty)
    public function updateCart(Request $request, $cartId)
    {
        $cart = Cart::find($cartId);
        $cart->quantity = $request->qty;
        $cart->save();

        return redirect()->back()->with('success', 'Jumlah berhasil diupdate!');
    }

    // 4. Hapus Barang
    public function deleteCart($cartId)
    {
        Cart::destroy($cartId);
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang!');
    }

    // 5. Hapus Semua (Delete All)
    public function deleteAll()
    {
        Cart::where('user_id', Auth::id())->delete();
        return redirect()->back()->with('success', 'Keranjang dikosongkan!');
    }
}
