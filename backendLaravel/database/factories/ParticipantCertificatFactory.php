<?php

namespace Database\Factories;

use App\Models\certificat4c;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\participantCertificat>
 */
class ParticipantCertificatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'certificat4c_id' => certificat4c::get('id')->random(),
            'user_id' => User::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
