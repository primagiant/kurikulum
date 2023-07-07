<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BahanKajian>
 */
class BahanKajianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $number = $this->faker->unique()->numberBetween(1, 99);
        $kode_bk = 'BK' . str_pad($number, 2, '0', STR_PAD_LEFT);

        return [
            'id_prodi' => 1,
            'kode_bk' => $kode_bk,
            'nama_bk' => $this->faker->name(),
            'deskripsi_bk' => $this->faker->text(),
            'bobot_min' => 0,
            'bobot_max' => 100,
            'active' => 1,
        ];
    }
}
