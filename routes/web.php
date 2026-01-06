<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

// Panggil fungsi 'index' milik HomeController
Route::get('/', [HomeController::class, 'index']);

// Route Baru
Route::get('/gallery', [HomeController::class, 'gallery']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [HomeController::class, 'contact']);

// Route untuk Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Route untuk Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Route untuk Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Group Route: Hanya bisa diakses kalau sudah LOGIN (auth)
Route::middleware(['auth'])->group(function () {

    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');

    // Menambah barang (butuh ID produk)
    Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');

    // Update jumlah
    Route::post('/update-cart/{id}', [CartController::class, 'updateCart'])->name('cart.update');

    // Hapus item
    Route::get('/delete-cart/{id}', [CartController::class, 'deleteCart'])->name('cart.delete');

    // Hapus semua
    Route::get('/delete-all-cart', [CartController::class, 'deleteAll'])->name('cart.delete_all');

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/orders', [OrderController::class, 'orders'])->name('orders');

// Profil
Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');

// Update Profil
Route::get('/update-profile', [UserController::class, 'showUpdateProfile'])->name('profile.edit');
Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('profile.update');

// Update Alamat
Route::get('/update-address', [UserController::class, 'showUpdateAddress'])->name('address.edit');
Route::post('/update-address', [UserController::class, 'updateAddress'])->name('address.update');

// contact
Route::get('/search', [HomeController::class, 'search'])->name('search');
});
