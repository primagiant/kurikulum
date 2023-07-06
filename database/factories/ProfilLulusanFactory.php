<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfilLulusan>
 */
class ProfilLulusanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $number = $this->faker->unique()->numberBetween(1, 99);
        $kode_pl = 'PL' . str_pad($number, 2, '0', STR_PAD_LEFT);
        $unsur = ['Sikap', 'Keterampilan Umum', 'Pengetahuan', 'Keterampilan Khusus'];

        return [
            'id_prodi' => 1,
            'kode_pl' => $kode_pl,
            'deskripsi_pl' => fake()->text(),
            'unsur' => $this->faker->randomElement($unsur),
            'referensi' => fake()->text(),
            'active' => 1,
        ];
    }
}
