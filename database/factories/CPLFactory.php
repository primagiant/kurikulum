<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CPL>
 */
class CPLFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $number = $this->faker->unique()->numberBetween(1, 99);
        $kode_cpl = 'CPL' . str_pad($number, 2, '0', STR_PAD_LEFT);
        $unsur = ['Sikap', 'Keterampilan Umum', 'Pengetahuan', 'Keterampilan Khusus'];

        return [
            'kode_cpl' => $kode_cpl,
            'id_prodi' => 1,
            'deskripsi_cpl' => fake()->text(),
            'unsur' => $this->faker->randomElement($unsur),
            'referensi' => fake()->text(),
            'active' => true,
        ];
    }
}
