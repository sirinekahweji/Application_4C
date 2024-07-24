<?php

namespace Database\Factories;

use App\Models\cv;
use App\Models\Profil;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'poste' => $this->faker->jobTitle(),
            'entreprise' => $this->faker->company(),
            'lieu' => $this->faker->city() . ', ' .$this->faker->country(),
            'dateDebut' => $this->faker->dateTimeBetween('-5 years', '-1 year'),
            'dateFin' => $this->faker->dateTimeBetween('-5 years', '-1 year'),
            'description' => $this->faker->sentence(10),
            'cv_id' => cv::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
