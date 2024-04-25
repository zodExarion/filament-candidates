<?php

namespace Database\Factories;

use App\Models\Candidates;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidatesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'sex' => $this->faker->randomElement(['male', 'female', 'other']),
            'date_of_birth' => $this->faker->date(),
            'position' => $this->faker->jobTitle,
            'language_knowledge' => $this->faker->text,
            'driving_license' => null, // For now, as it's nullable
            'cv' => null, // For now, as it's nullable
            'own_transport' => $this->faker->boolean,
            'is_working' => $this->faker->randomElement([0, 1, 2, 3]), // Randomly assign is_working value
        ];
    }
}
