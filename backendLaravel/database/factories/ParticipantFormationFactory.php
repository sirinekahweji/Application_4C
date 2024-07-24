<?php

namespace Database\Factories;

use App\Models\FichierEvaluation;
use App\Models\Formation4C;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\participantFormation>
 */
class ParticipantFormationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'formation4c_id' => Formation4C::get('id')->random(),
            'user_id' => User::get('id')->random(),
            'fichierEvaluation_id' => FichierEvaluation::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
