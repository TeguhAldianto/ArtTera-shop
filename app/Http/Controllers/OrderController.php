<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Tampilkan Halaman Checkout.
     */
    public function checkout()
    {
        $userId = Auth::id();

        // Ambil keranjang user beserta produk, pastikan produk tidak null
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        // Filter item yang produknya sudah terhapus
        $cartItems = $cartItems->filter(fn($item) => $item->product !== null);

        if ($cartItems->isEmpty()) {
            return redirect('/cart')->with('error', 'Keranjang Anda kosong atau produk tidak tersedia!');
        }

        return view('checkout', ['cartItems' => $cartItems]);
    }

    /**
     * Proses Pemesanan (Place Order) dengan Database Transaction & Stok Check.
     */
    public function placeOrder(Request $request)
    {
        // 1. Validasi Input Lengkap & Kuantitas
        $request->validate([
            'name'     => 'required|string|max:255',
            'number'   => 'required|string|max:20',
            'email'    => 'required|email|max:255',
            'method'   => 'required|string',
            'flat'     => 'required|string|max:255',
            'street'   => 'required|string|max:255',
            'city'     => 'required|string|max:255',
            'state'    => 'required|string|max:255',
            'country'  => 'required|string|max:255',
            'pin_code' => 'required|string|max:20',
        ]);

        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect('/cart')->with('error', 'Keranjang belanja Anda kosong.');
        }

        // 2. Gunakan Database Transaction untuk Menjaga Integritas Data (Atomic)
        return DB::transaction(function () use ($userId, $request, $cartItems) {
            $grandTotal = 0;

            foreach ($cartItems as $item) {
                if (!$item->product) {
                    continue; // Lewati jika produk sudah dihapus admin
                }

                // Cek Stok Produk
                if (isset($item->product->stock) && $item->product->stock < $item->quantity) {
                    throw new \Exception("Stok untuk produk '{$item->product->name}' tidak mencukupi.");
                }

                $grandTotal += ($item->product->price * $item->quantity);
            }

            if ($grandTotal <= 0) {
                return redirect('/cart')->with('error', 'Total belanja tidak valid.');
            }

            // Gabungkan Alamat dengan Aman
            $fullAddress = implode(', ', [
                $request->flat,
                $request->street,
                $request->city,
                $request->state,
                $request->country
            ]) . " - {$request->pin_code}";

            // A. Simpan ke Tabel Orders
            $order = Order::create([
                'user_id'        => $userId,
                'name'           => $request->name,
                'number'         => $request->number,
                'email'          => $request->email,
                'method'         => $request->input('method'),
                'address'        => $fullAddress,
                'total_price'    => $grandTotal,
                'payment_status' => 'pending'
            ]);

            // B. Pindahkan Item Keranjang ke Order Items & Kurangi Stok (opsional)
            foreach ($cartItems as $item) {
                if (!$item->product) continue;

                OrderItem::create([
                    'order_id'   => $order->getKey(),
                    'product_id' => $item->product_id,
                    'price'      => $item->product->price,
                    'quantity'   => $item->quantity,
                ]);

                // Kurangi stok produk jika kolom stock tersedia
                if (isset($item->product->stock)) {
                    $item->product->decrement('stock', $item->quantity);
                }
            }

            // C. Kosongkan Keranjang Belanja User
            Cart::where('user_id', $userId)->delete();

            return redirect('/orders')->with('success', 'Pesanan berhasil dibuat!');
        });
    }

    /**
     * Lihat Riwayat Pesanan dengan Eager Loading untuk Mencegah N+1 Query.
     */
    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->latest()
            ->get();

        return view('orders', ['orders' => $orders]);
    }
}
