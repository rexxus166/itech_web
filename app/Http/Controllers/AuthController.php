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
    public function loginTest(Request $request){
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

    // Menangani logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
