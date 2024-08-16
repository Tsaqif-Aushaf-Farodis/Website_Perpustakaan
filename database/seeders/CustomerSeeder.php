<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'nama' => 'Tsaqif',
            'tmp_lahir' => 'Banyumas',
            'tgl_lahir' => '1998-10-20',
            'jenis_kelamin' => 'Laki-laki',
        ]);
    }
}
