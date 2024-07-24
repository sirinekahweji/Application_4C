<?php

namespace Database\Factories;

use App\Models\Formation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Formation4C>
 */
class Formation4CFactory extends Factory
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
            'nbSession' =>  $this->faker->randomNumber(2),
            'formateur' =>  $this->faker->firstName() . " " .$this->faker->lastName(),
            'affiche' => $this->faker->imageUrl(),
            'capacite' =>  rand(10, 25),
            'titre' =>  $this->faker->sentence(3),
            'categorie' =>  $this->faker->sentence(3),
            'dateLimiteInscription' => $this->faker->date(),
            'created_at' => now(),
        ];
    }
}
