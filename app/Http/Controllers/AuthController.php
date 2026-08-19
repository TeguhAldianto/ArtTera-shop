<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; // Panggil Buku Tamu (Model User)
use Illuminate\Support\Facades\Auth; // Alat pengacak password
use Illuminate\Support\Facades\Hash; // Alat autentikasi utama

class AuthController extends Controller
{
    // === BAGIAN REGISTER ===

    // 1. Tampilkan Formulir
    public function showRegisterForm()
    {
        return view('register');
    }

    // 2. Proses Data Pendaftaran
    public function register(Request $request)
    {
        // Validasi: Pastikan data lengkap & email belum terpakai
        $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email', // Email harus unik
            'password' => 'required|min:5|confirmed', // Password harus cocok dengan konfirmasi
        ]);

        // Buat User Baru di Database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password wajib di-hash (diacak)
        ]);

        // Setelah daftar, langsung arahkan ke halaman login
        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login!');
    }

    // === BAGIAN LOGIN ===

    // 1. Tampilkan Formulir
    public function showLoginForm()
    {
        return view('login');
    }

    // 2. Proses Cek Login
    public function login(Request $request)
    {
        // Ambil input email & password saja
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek apakah cocok dengan database?
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Perbarui sesi agar aman

            return redirect()->intended('/'); // Masuk ke Home
        }

        // Jika salah password/email
        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ]);
    }

    // === BAGIAN LOGOUT ===
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
