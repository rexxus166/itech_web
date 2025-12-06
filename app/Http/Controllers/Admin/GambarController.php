<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gambar;
use Illuminate\Support\Facades\Storage;

class GambarController extends Controller
{
    public function index()
    {
        $gambars = Gambar::all();
        return view('admin.gambar.index', compact('gambars'));
    }

    public function create()
    {
        return view('admin.gambar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('gambar')->store('gambars', 'public');

        Gambar::create([
            'judul' => $request->judul,
            'gambar' => $path,
        ]);

        return redirect()->route('admin.gambar.index')->with('success', 'Gambar berhasil ditambahkan.');
    }

    public function destroy(Gambar $gambar)
    {
        Storage::disk('public')->delete($gambar->gambar);
        $gambar->delete();

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}
