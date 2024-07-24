<?php

namespace Database\Factories;

use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom'  => $this->faker->lastName(),
            'prenom'=>$this->faker->firstName(),
            'fonctionnalite' => $this->faker->jobTitle(),
            'phone'=>$this->faker->randomNumber(8),
            'isResponsable' =>  rand(0,1),
            'email'=>$this->faker->unique()->safeEmail() ,
            'entreprise_id' => Entreprise::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
