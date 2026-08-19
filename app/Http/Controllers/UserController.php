<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 1. Tampilkan Halaman Profil
    public function showProfile()
    {
        return view('profile');
    }

    // 2. Form Update Profil (Nama/Email/Pass)
    public function showUpdateProfile()
    {
        return view('update_profile');
    }

    // 3. Proses Update Profil
    public function updateProfile(Request $request)
    {
        // PERBAIKAN: Menggunakan User::find agar VS Code mengenali method save()
        $user = User::find(Auth::id());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'number' => 'required|numeric',
        ]);

        // Update data dasar
        $user->name = $request->name;
        $user->email = $request->email;
        $user->number = $request->number;

        // Cek jika user mau ganti password
        if ($request->filled('old_pass') && $request->filled('new_pass')) {
            // Cek password lama benar gak?
            if (! Hash::check($request->old_pass, $user->password)) {
                return back()->with('error', 'Password lama salah!');
            }
            // Cek konfirmasi password baru
            if ($request->new_pass != $request->confirm_pass) {
                return back()->with('error', 'Konfirmasi password tidak cocok!');
            }

            $user->password = Hash::make($request->new_pass);
        }

        $user->save(); // Error P1013 harusnya hilang sekarang

        return back()->with('success', 'Profil berhasil diupdate!');
    }

    // 4. Form Update Alamat
    public function showUpdateAddress()
    {
        return view('update_address');
    }

    // 5. Proses Update Alamat
    public function updateAddress(Request $request)
    {
        // PERBAIKAN: Menggunakan User::find agar method update() dikenali
        $user = User::find(Auth::id());

        $request->validate([
            'flat' => 'required',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pin_code' => 'required|numeric',
        ]);

        $user->update($request->all()); // Error P1013 harusnya hilang sekarang

        return back()->with('success', 'Alamat berhasil disimpan!');
    }
}
