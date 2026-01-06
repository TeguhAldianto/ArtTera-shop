<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // 1. Tampilkan Halaman Checkout
    public function checkout()
    {
        $userId = Auth::id();

        // Ambil keranjang user
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect('/cart')->with('error', 'Keranjang Anda kosong!');
        }

        return view('checkout', ['cartItems' => $cartItems]);
    }

    // 2. Proses Pemesanan (Place Order)
    public function placeOrder(Request $request)
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect('/cart');
        }

        // Validasi Input
        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'email' => 'required|email',
            'method' => 'required', // Ini adalah 'payment method'
            'flat' => 'required',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pin_code' => 'required',
        ]);

        // Hitung Total Harga
        $grandTotal = 0;
        foreach ($cartItems as $item) {
            $grandTotal += ($item->product->price * $item->quantity);
        }

        // Gabungkan Alamat
        $fullAddress = "{$request->flat}, {$request->street}, {$request->city}, {$request->state}, {$request->country} - {$request->pin_code}";

        // A. Simpan ke Tabel Orders
        $order = Order::create([
            'user_id' => $userId,
            'name' => $request->name,
            'number' => $request->number,
            'email' => $request->email,

            // PERBAIKAN PENTING DI SINI:
            // Menggunakan input('method') agar tidak bentrok dengan properti sistem
            'method' => $request->input('method'),

            'address' => $fullAddress,
            'total_price' => $grandTotal,
            'payment_status' => 'pending'
        ]);

        // B. Pindahkan Item Keranjang ke Order Items
        foreach ($cartItems as $item) {
            OrderItem::create([
                // Menggunakan getKey() agar ID terbaca dengan aman
                'order_id' => $order->getKey(),
                'product_id' => $item->product_id,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
            ]);
        }

        // C. Kosongkan Keranjang (Troli)
        Cart::where('user_id', $userId)->delete();

        return redirect('/orders')->with('success', 'Pesanan berhasil dibuat!');
    }

    // 3. Lihat Riwayat Pesanan
    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('orders', ['orders' => $orders]);
    }
}
