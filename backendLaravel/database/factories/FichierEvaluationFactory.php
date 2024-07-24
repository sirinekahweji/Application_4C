<?php

namespace Database\Factories;

use App\Models\participantFormation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FichierEvaluation>
 */
class FichierEvaluationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'avis' => $this->faker->sentence(10),
            'created_at' => now(),
        ];
    }
}
