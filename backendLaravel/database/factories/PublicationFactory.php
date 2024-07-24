<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publication>
 */
class PublicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description'  => $this->faker->sentence(10),
            'cible'          => $this->faker->randomElement(['public', 'private']),
            'responsable_id' => User::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
