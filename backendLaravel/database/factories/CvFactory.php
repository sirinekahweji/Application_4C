<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\cv>
 */
class CvFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cvAutomatique' => $this->faker->filePath(),
            'cvCharge'  => $this->faker->filePath() . '.pdf',
            'cvAccredite'  => $this->faker->boolean(),
            'user_id' => User::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
