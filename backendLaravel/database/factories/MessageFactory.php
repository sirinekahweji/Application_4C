<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'message'  => $this->faker->sentence(10),
            'emmetteur_id' => User::get('id')->random(),
            'recepteur_id' => User::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
