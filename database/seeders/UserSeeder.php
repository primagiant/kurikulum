<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole = Role::where('name', 'super_admin')->first();
        $koorProdiRole = Role::where('name', 'koor_prodi')->first();
        $dosenRole = Role::where('name', 'dosen')->first();

        $superAdmin = User::create([
            'name' => "Super Admin",
            'email' => "superadmin@sistem.com",
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ]);

        $koorProdi = User::create([
            'name' => "Koor Prodi Ilmu Komputer",
            'email' => 'ilkom@sistem.com',
            'email_verified_at' => now(),
            'prodi' => 1,
            'password' => bcrypt('password')
        ]);

        $dosen1 = User::create([
            'name' => "Dosen",
            'email' => 'dosen1@sistem.com',
            'email_verified_at' => now(),
            'prodi' => 1,
            'password' => bcrypt('password')
        ]);

        $superAdmin->roles()->attach($superAdminRole);
        $koorProdi->roles()->attach($koorProdiRole);
        $dosen1->roles()->attach($dosenRole);
    }
}
