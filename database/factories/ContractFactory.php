<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $players = \App\Models\Player::pluck('id')->toArray();
        $teams = \App\Models\Team::pluck('id')->toArray();
        return [
            'player_id' => fake()->randomElement($players),
            'team_id' => fake()->randomElement($teams),
            'start_date' => fake()->dateTimeBetween('-5 years', '-1 year'),
            'end_date' => fake()->dateTimeBetween('1 year', '5 years'),
        ];
    }
}
