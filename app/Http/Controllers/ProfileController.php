<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // Menampilkan halaman profile
    public function index()
    {
        $user = Auth::user();  // Mendapatkan data pengguna yang sedang login
        return view('profile.index', compact('user'));  // Mengirim data pengguna ke view
    }

    // Mengupdate profile pengguna
    public function update(Request $request)
    {
        $user = Auth::user();  // Mendapatkan pengguna yang sedang login

        // Validasi data yang akan diperbarui
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,  // Pastikan email sudah ada
            'password' => 'nullable|confirmed|min:8',  // Password opsional, tetapi jika ada harus dikonfirmasi
        ]);

        // Mengupdate data pengguna
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Jika password diisi, update password pengguna
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        // Simpan perubahan
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profile berhasil diperbarui!');
    }
}
