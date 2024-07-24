<?php

namespace Database\Factories;

use App\Models\cv;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\certificat4c>
 */
class Certificat4cFactory extends Factory
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
            'lieu'  => $this->faker->city(),
            'affiche' =>$this->faker->imageUrl(),
            'capacite'  => $this->faker->numberBetween(10,100),
            'dateLimiteInscription' => $this->faker->date,
            'date' => $this->faker->date,
            'certificat' =>$this->faker->imageUrl(),
            'code_qr' => $this->faker->sentence(),
            'prix' => $this->faker->randomNumber(),
            'offre' => $this->faker->randomNumber(),
            'organisation'  => $this->faker->company(),
            'categorie'  => $this->faker->randomElement(['Développement web', 'Base de données', 'Langage C++']),
            'description' => $this->faker->sentence(3),
            'created_at' => now(),
        ];
    }
}
