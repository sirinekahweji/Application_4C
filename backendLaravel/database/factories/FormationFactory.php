<?php

namespace Database\Factories;

use App\Models\cv;
use App\Models\Profil;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Formation>
 */
class FormationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre'  => $this->faker->sentence(4),
            'description'   => $this->faker->sentence(10),
            'categorie'  => $this->faker->randomElement(['Développement web', 'Marketing digital']),
            'date'      => $this->faker->date,
            'type_formation'  => $this->faker->randomElement(['formation4C','formationExterne']),
            'organisation'   => $this->faker->company(),
            'cv_id' => cv::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
