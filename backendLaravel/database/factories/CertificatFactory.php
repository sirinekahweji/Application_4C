<?php

namespace Database\Factories;

use App\Models\cv;
use App\Models\Profil;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Certificat>
 */
class CertificatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => $this->faker->sentence(4),
            'description' => $this->faker->sentence(3),
            'date' => $this->faker->date,
            'categorie'  => $this->faker->randomElement(['Développement web', 'Base de données', 'Langage C++']),
            'type_certificat' => $this->faker->randomElement(['Externe', '4c']),
            'organisation'  => $this->faker->company(),
            'certificat' =>$this->faker->imageUrl(),
            'cv_id' => cv::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
