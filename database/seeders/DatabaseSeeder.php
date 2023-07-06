<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProdiSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CPLSeeder::class,
            ProfilLulusanSeeder::class,
        ]);

        // \App\Models\Role::factory()->hasUsers()->create();
    }
}
