<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// --- PUBLIC ROUTES (Bisa diakses siapa saja) ---

Route::get('/', [HomeController::class, 'index']);
Route::get('/gallery', [HomeController::class, 'gallery']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [HomeController::class, 'contact']);

// PERBAIKAN: Ini Route yang sebelumnya hilang
Route::get('/product/{id}', [HomeController::class, 'show'])->name('products.show');

// Route Auth
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- PROTECTED ROUTES (Harus Login dulu) ---
Route::middleware(['auth'])->group(function () {

    Route::get('/search', [HomeController::class, 'search'])->name('search');

    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/update-cart/{id}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::get('/delete-cart/{id}', [CartController::class, 'deleteCart'])->name('cart.delete');
    Route::get('/delete-all-cart', [CartController::class, 'deleteAll'])->name('cart.delete_all');

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/orders', [OrderController::class, 'orders'])->name('orders');

    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
    Route::get('/update-profile', [UserController::class, 'showUpdateProfile'])->name('profile.edit');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::get('/update-address', [UserController::class, 'showUpdateAddress'])->name('address.edit');
    Route::post('/update-address', [UserController::class, 'updateAddress'])->name('address.update');
});
