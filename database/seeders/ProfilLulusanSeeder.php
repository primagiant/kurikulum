<?php

namespace Database\Seeders;

use App\Models\ProfilLulusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilLulusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProfilLulusan::factory()->count(10)->create();
    }
}
