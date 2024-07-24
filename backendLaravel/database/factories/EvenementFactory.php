<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evenement>
 */
class EvenementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code_qr' => $this->faker->sentence(),
            'affiche' => $this->faker->imageUrl(),
            'capacite' =>  rand(10, 25),
            'dateLimiteInscription' => $this->faker->date(),
            'categorie' => $this->faker->sentence(3),
            'lieu' => $this->faker->country(),
            'description' => $this->faker->sentence(10),
            'titre' => $this->faker->sentence(3),
            'date' => $this->faker->date(),
            'organisateur' => $this->faker->company(),
            'created_at' => now(),
        ];
    }
}
