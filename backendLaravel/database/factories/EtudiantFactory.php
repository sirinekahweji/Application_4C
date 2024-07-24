<?php

namespace Database\Factories;

use App\Models\Classe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'etablissement' => $this->faker->sentence(4),
            'classe_id' => Classe::get('id')->random(),
            'user_id' => User::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
