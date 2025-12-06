<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Stmt\TryCatch;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Menangani login
    public function loginTest(Request $request)
    {
        print_r($request->all());
    }
    public function login(Request $request)
    {
        try {
            // print_r($request->all());
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

                return redirect()->intended('/');
            }

            return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
        } catch (ValidationException $th) {
            return back()->withErrors($th->errors())->withInput();
        }
    }

    // Menampilkan form registrasi
    public function showRegister()
    {
        return view('auth.register');
    }

    // Menangani registrasi
    public function registerUser(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed:password_confirmation',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            Auth::login($user);

            return redirect('/login');
        } catch (ValidationException $th) {
            return back()->withErrors($th->errors())->withInput();
        }
    }

    // ==========================================
    // API AUTHENTICATION (KHUSUS FLUTTER)
    // ==========================================

    public function loginApi(\Illuminate\Http\Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek credential
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Buat Token (Sanctum)
            // Pastikan User model punya trait HasApiTokens (Default Laravel sudah ada)
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                'data' => [
                    'user' => $user,
                    'token' => $token, // Token ini penting buat Flutter
                ]
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau Password salah',
        ], 401);
    }

    public function registerApi(\Illuminate\Http\Request $request)
    {
        // Validasi input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8', // Sesuaikan dengan validasi Flutter
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Buat User Baru
        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'user', // Default role
        ]);

        // Langsung buat token biar user nggak usah login ulang
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registrasi Berhasil',
            'data' => [
                'user' => $user,
                'token' => $token,
            ]
        ], 201);
    }

    // Menangani logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
