<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'date_of_birth' => fake()->dateTimeBetween('-30 years', '-20 years'),
            'fitness_status' => fake()->randomElement(['ok', 'injury']),
            'position' => fake()->randomElement(['GK', 'CB', 'RB', 'ST']),
            'value' => fake()->numberBetween(1000000, 200000000),
        ];
    }
}
