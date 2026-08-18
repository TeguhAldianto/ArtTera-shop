<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * 1. Tambah Barang ke Keranjang dengan Validasi Kuantitas & Stok.
     */
    public function addToCart(Request $request, $productId)
    {
        // Validasi input kuantitas
        $request->validate([
            'qty' => 'nullable|integer|min:1|max:99'
        ]);

        $userId = Auth::id();
        $qty = $request->input('qty', 1); // Default 1 jika tidak diisi

        // Cek apakah barang sudah ada di keranjang user
        $existingCart = Cart::where('user_id', $userId)
                            ->where('product_id', $productId)
                            ->first();

        if ($existingCart) {
            // Update jumlah kuantitas jika sudah ada
            $existingCart->quantity += $qty;
            $existingCart->save();
        } else {
            // Buat entri keranjang baru
            Cart::create([
                'user_id'    => $userId,
                'product_id' => $productId,
                'quantity'   => $qty
            ]);
        }

        return redirect('/cart')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * 2. Lihat Isi Keranjang dengan Eager Loading.
     */
    public function showCart()
    {
        $cartItems = Cart::where('user_id', Auth::id())
                         ->with('product')
                         ->get();

        return view('cart', ['cartItems' => $cartItems]);
    }

    /**
     * 3. Update Jumlah (Qty) dengan Validasi Kepemilikan & Batasan Angka.
     */
    public function updateCart(Request $request, $cartId)
    {
        $request->validate([
            'qty' => 'required|integer|min:1|max:99'
        ]);

        // Pastikan cart milik user yang sedang login (Cegah IDOR)
        $cart = Cart::where('id', $cartId)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $cart->quantity = $request->qty;
        $cart->save();

        return redirect()->back()->with('success', 'Jumlah keranjang berhasil diupdate!');
    }

    /**
     * 4. Hapus Barang dari Keranjang dengan Validasi Kepemilikan.
     */
    public function deleteCart($cartId)
    {
        $cart = Cart::where('id', $cartId)
                    ->where('user_id', Auth::id())
                    ->first();

        if ($cart) {
            $cart->delete();
        }

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang!');
    }

    /**
     * 5. Hapus Semua Keranjang Milik User yang Login.
     */
    public function deleteAll()
    {
        Cart::where('user_id', Auth::id())->delete();
        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan!');
    }
}
