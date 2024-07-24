<?php

namespace Database\Factories;

use App\Models\Departement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Specialite>
 */
class SpecialiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->sentence(3),
            'abreviation' =>  substr($this->faker->word(), 0 ,2) . strtoupper(substr($this->faker->word(), -1)),
            'departement_id' => Departement::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
