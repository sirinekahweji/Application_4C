<?php

namespace Database\Factories;

use App\Models\Profil;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attestation>
 */
class AttestationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->sentence(2),
            'type' => $this->faker->sentence(2),
            'description' => $this->faker->sentence(10),
            'image' => $this->faker->imageUrl(),
            'choix' => $this->faker->randomNumber(),
            'created_at' => now(),
        ];
    }
}
