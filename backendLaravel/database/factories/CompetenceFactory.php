<?php

namespace Database\Factories;

use App\Models\cv;
use App\Models\Profil;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Competence>
 */
class CompetenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->sentence(3),
            'niveau'  => $this->faker->randomElement(['Débutant', 'Intermédiaire', 'Expert']),
            'cv_id' => cv::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
