<?php

namespace Database\Seeders;

use App\Models\BahanKajian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BahanKajianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BahanKajian::factory()->count(10)->create();
    }
}
