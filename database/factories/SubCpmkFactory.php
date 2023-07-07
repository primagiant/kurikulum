<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCpmk>
 */
class SubCpmkFactory extends Factory
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
            'id_map_cpmk_mk' => 1,
            'kode_sub_cpmk' => "Sub-CPMKXXYZ",
            'deskripsi_sub_cpmk' => fake()->text(),
            'active' => 1
        ];
    }
}
