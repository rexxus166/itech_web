<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostinganUser;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        return view('user.postingan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'bahasa' => 'required|in:python,cpp' // Validasi bahasa
        ]);

        PostinganUser::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'bahasa' => $request->bahasa, // Simpan bahasa
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('postingan.index')->with('success', 'Kode berhasil disimpan.');
    }

    public function index()
    {
        $postingans = PostinganUser::where('user_id', Auth::id())->latest()->get();
        return view('user.postingan.index', compact('postingans'));
    }
}
