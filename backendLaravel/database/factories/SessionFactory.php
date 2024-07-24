<?php

namespace Database\Factories;

use App\Models\Formation4C;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\session>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date'  => $this->faker->date(),
            'lieu'  => $this->faker->city(),
            'heure'  => $this->faker->time(),
            'duree'  => $this->faker->randomNumber(),
            'formation4c_id' => Formation4C::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
