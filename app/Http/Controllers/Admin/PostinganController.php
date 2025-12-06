<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostinganUser;
use Illuminate\Http\Request;

class PostinganController extends Controller
{
    // Menampilkan daftar postingan
    public function index()
    {
        $postingans = PostinganUser::with('user')->latest()->get();  // Mengambil postingan dengan relasi pengguna
        return view('admin.postingan.index', compact('postingans'));
    }

    // Membuat postingan baru
    public function create()
    {
        // Ambil semua pengguna untuk dipilih dalam form
        $users = \App\Models\User::all();
        return view('admin.postingan.create',
        [
            'users' => $users
        ]);
    }

    // Menyimpan postingan baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        PostinganUser::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('admin.postingan.index')->with('success', 'Postingan berhasil ditambahkan.');
    }

    // edit
    public function edit($id)
    {
        $postingan = PostinganUser::with('user')->find($id);
        $users = \App\Models\User::all();
        return view('admin.postingan.edit', compact('postingan', 'users'));
    }

    // update
    public function update(Request $request, $id)
    {
        $request->
        validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);
        PostinganUser::find($id)->
        update([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'user_id' => $request->user_id
        ]);
        return redirect()->
                    route('admin.postingan.index')->
                    with('success', 'Postingan berhasil diupdate.');
    }
    // Menghapus postingan
    public function destroy(PostinganUser $postingan)
    {
        $postingan->delete();
        return redirect()->route('admin.postingan.index')->with('success', 'Postingan berhasil dihapus');
    }
}
