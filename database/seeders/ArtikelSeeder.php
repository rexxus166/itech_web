<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artikel;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        Artikel::create([
            'judul' => 'Belajar Laravel untuk Pemula',
            'isi' => 'Laravel adalah framework PHP yang sangat populer...',
            'author' => 'Admin ITECH',
        ]);
    }
}

