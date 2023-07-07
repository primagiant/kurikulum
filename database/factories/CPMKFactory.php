<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CPMK>
 */
class CPMKFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_prodi' => 1,
            'id_cpl' => 1,
            'kode_cpmk' => "CPMLXXY",
            'deskripsi_cpmk' => fake()->text(),
            'active' => 1,
        ];
    }
}
