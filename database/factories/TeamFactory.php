<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Chelsea', 'Manchester City', 'Arsenal', 'Tottenham']),
            'foundation_date' => fake()->dateTimeBetween('-100 years', '-80 years'),
            'city' => fake()->word(),
            'street' => fake()->word(),
            'stadium_capacity' => fake()->randomNumber(5, true),
            'strength' => fake()->randomDigit(),
        ];
    }
}
