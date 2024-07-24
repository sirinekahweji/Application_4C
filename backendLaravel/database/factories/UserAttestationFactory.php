<?php

namespace Database\Factories;

use App\Models\Attestation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAttestation>
 */
class UserAttestationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'attestation_id' => Attestation::get('id')->random(),
            'user_id' => User::get('id')->random(),
            'image' => $this->faker->imageUrl(),
            'created_at' => now(),
        ];
    }
}
