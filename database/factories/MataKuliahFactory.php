<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MataKuliah>
 */
class MataKuliahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $number = $this->faker->unique()->numberBetween(1, 99);
        $kode_mk_obe = 'MK' . str_pad($number, 2, '0', STR_PAD_LEFT);
        $kode_mk_undiksha = 'UNDIKSHA' . str_pad($number, 2, '0', STR_PAD_LEFT);
        return [
            'id_prodi' => 1,
            'kode_mk_obe' => $kode_mk_obe,
            'kode_mk_undiksha' => $kode_mk_undiksha,
            'nama_mk' => fake()->colorName(),
            'deskripsi_mk' => fake()->text(),
            'sks' => rand(1, 6),
            'semester' => rand(1, 8),
            'id_kategori_mk' => 1,
            'active' => 1
        ];
    }
}
