<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buku::create([
            'judul' => 'Laravel for Beginners',
            'penerbit' => 'O\'Reilly Media',
            'tgl_terbit' => '2023-01-15',
            'stok' => 10,
        ]);

        Buku::create([
            'judul' => 'Mastering PHP',
            'penerbit' => 'Packt Publishing',
            'tgl_terbit' => '2022-05-20',
            'stok' => 7,
        ]);
    }
}
