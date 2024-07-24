<?php

namespace Database\Factories;

use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonnelEntreprise>
 */
class PersonnelEntrepriseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fonctionnalite'  => $this->faker->jobTitle(),
            'entreprise_id' => Entreprise::get('id')->random(),
            'user_id' => User::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
