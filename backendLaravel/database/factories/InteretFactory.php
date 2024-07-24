<?php

namespace Database\Factories;
use App\Models\cv;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\interet>
 */
class InteretFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'interet'  => $this->faker->sentence(3),
            'cv_id' => cv::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
