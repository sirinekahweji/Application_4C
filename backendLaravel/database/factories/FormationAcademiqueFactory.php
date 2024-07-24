<?php

namespace Database\Factories;

use App\Models\cv;
use App\Models\Profil;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FormationAcademique>
 */
class FormationAcademiqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'etablissement'  => $this->faker->sentence(3),
            'diplome'        => $this->faker->word(),
            'domaineEtude'    => $this->faker->randomElement(['Informatique', 'Mathématiques', 'Physique']),
            'dateDebut'      => $this->faker->dateTimeBetween('-5 years'),
            'dateFin'        => $this->faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now', $timezone = null),
            'description'       => $this->faker->sentence(5),
            'cv_id' => cv::get('id')->random(),
            'created_at' => now(),
        ];
    }
}