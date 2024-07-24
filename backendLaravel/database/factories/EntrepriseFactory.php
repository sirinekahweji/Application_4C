<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entreprise>
 */
class EntrepriseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->company(),
            'secteurActivite' => $this->faker->randomElement(['Tech', 'Santé', 'Services', 'Agroalimentaire']),
            'adresse' => $this->faker->streetAddress() . " " . $this->faker->buildingNumber(),
            'phone' => $this->faker->randomNumber(),
            'created_at' => now(),
        ];
    }
}
