<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prodis = array('Ilmu Komputer', "Sistem Informasi", "TRPL", "PTI");
        foreach ($prodis as $key => $prodi) {
            Prodi::create([
                'kode_prodi' => "000" . $key,
                'nama_prodi' => $prodi,
                'active' => true,
            ]);
        }
    }
}
