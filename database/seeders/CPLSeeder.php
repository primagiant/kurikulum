<?php

namespace Database\Seeders;

use App\Models\CPL;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CPLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CPL::factory()->count(15)->create();
    }
}
