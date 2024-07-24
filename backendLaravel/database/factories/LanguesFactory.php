<?php

namespace Database\Factories;

use App\Models\cv;
use App\Models\Profil;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Langues>
 */
class LanguesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom'  => $this->faker->languageCode(),
            'niveau'    => $this->faker->randomElement(['A1', 'A2', 'B1', 'B2']),
            'cv_id' => cv::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
