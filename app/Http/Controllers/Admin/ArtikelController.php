<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::latest()->get();
        return view('admin.artikel.index', compact('artikels'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'author' => 'required',
        ]);

        // Membuat slug dari judul
        $slug = Str::slug($request->judul);

        // Cek apakah slug sudah ada di database
        $existingSlug = Artikel::where('slug', $slug)->first();
        if ($existingSlug) {
            // Jika slug sudah ada, kembalikan error
            return back()->withErrors(['slug' => 'Slug sudah terpakai, silakan gunakan judul yang berbeda.']);
        }

        // Jika slug belum ada, simpan artikel baru
        Artikel::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'isi' => $request->isi,
            'author' => $request->author,
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Artikel $artikel)
    {
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'author' => 'required',
        ]);

        // Membuat slug dari judul baru
        $slug = Str::slug($request->judul);

        // Cek apakah slug sudah ada di database dan bukan milik artikel yang sedang diedit
        $existingSlug = Artikel::where('slug', $slug)->where('id', '!=', $artikel->id)->first();
        if ($existingSlug) {
            // Jika slug sudah ada, kembalikan error
            return back()->withErrors(['slug' => 'Slug sudah terpakai, silakan gunakan judul yang berbeda.']);
        }

        // Jika slug belum ada, update artikel
        $artikel->update([
            'judul' => $request->judul,
            'slug' => $slug,
            'isi' => $request->isi,
            'author' => $request->author,
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
