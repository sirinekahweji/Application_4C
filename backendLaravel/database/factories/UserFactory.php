<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->firstName(),
            'prenom'  => $this->faker->lastName(),
            'phoneNumber'  => $this->faker->randomNumber(),
            'cin' =>  rand(11111111, 99999999),
            'code_qr'  => $this->faker->sentence(),
            'photoProfile'  => $this->faker->imageUrl(),
            'photoCouverture'   => $this->faker->imageUrl(),
            'genre'  => $this->faker->boolean(),
            'dateNaissance' => $this->faker->dateTimeBetween('-60 years', '-18 years'),
            'lienLinkdIn'  => 'https://www.linkedin.com/in/' . strtolower('john-doe'),
            'adresse'  => fake()->address(),
            'Gouvernorat'  => $this->faker->country() ,
            'user_type'   => $this->faker->randomElement(['Etudiant', 'Enseignant','PersonnelEntreprise']),
            'nbEtoiles' => rand(1,5),
            'role_id' => Role::get('id')->random(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
