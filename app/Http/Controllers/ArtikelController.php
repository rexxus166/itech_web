<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel; // Pastikan model Artikel sudah ada

class ArtikelController extends Controller
{
    // Menampilkan semua artikel
    public function index()
    {
        $artikels = Artikel::latest()->paginate(5);
        return view('artikel.index', compact('artikels'));
    }

    // Menampilkan detail artikel berdasarkan slug
    public function show($slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();
        return view('artikel.show', compact('artikel'));
    }

    // ==========================================
    // API ENDPOINTS (UNTUK FLUTTER/MOBILE)
    // ==========================================

    public function apiIndex()
    {
        // Ambil data artikel (misal ambil semua, urut dari yang terbaru)
        $artikels = Artikel::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Artikel',
            'data'    => $artikels
        ], 200);
    }

    public function apiShow($slug)
    {
        // Cari artikel berdasarkan slug
        $artikel = Artikel::where('slug', $slug)->first();

        if ($artikel) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Artikel',
                'data'    => $artikel
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Artikel Tidak Ditemukan',
            ], 404);
        }
    }
}
