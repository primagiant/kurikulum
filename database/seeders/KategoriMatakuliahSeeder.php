<?php

namespace Database\Seeders;

use App\Models\KategoriMatakuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriMatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KategoriMatakuliah::create([
            'description' => 'MK-Wajib'
        ]);
        KategoriMatakuliah::create([
            'description' => 'MK-Pilihan'
        ]);
        KategoriMatakuliah::create([
            'description' => 'MKWK'
        ]);
    }
}
