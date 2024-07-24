<?php

namespace Database\Factories;

use App\Models\Profil;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Badge>
 */
class BadgeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->sentence(4),
            'image' => $this->faker->imageUrl(),
            'type' => $this->faker->sentence(3),
            'choix' => $this->faker->randomNumber(),
            'created_at' => now(),
        ];
    }
}
