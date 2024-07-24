<?php

namespace Database\Factories;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\React>
 */
class ReactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type'  => $this->faker->randomElement(['like', 'dislike']),
            'user_id' => User::get('id')->random(),
            'publication_id' => Publication::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
