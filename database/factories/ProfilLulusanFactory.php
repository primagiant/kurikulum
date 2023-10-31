<?php

namespace Database\Factories;

use App\Models\ProfilLulusan;
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
        $unsur = ['Sikap', 'Keterampilan Umum', 'Pengetahuan', 'Keterampilan Khusus'];
        $attributes = [
            'id_prodi' => 1,
            'deskripsi_pl' => fake()->text(),
            'unsur' => $this->faker->randomElement($unsur),
            'referensi' => fake()->sentence(),
            'active' => 1,
        ];
        return ProfilLulusan::createProfilLulusan($attributes);
    }
}
