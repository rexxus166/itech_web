<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Menampilkan halaman About Us
    public function aboutUs()
    {
        return view('about.about-us');
    }
}
