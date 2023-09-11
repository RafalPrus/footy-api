<?php

namespace Database\Factories;

use App\Models\Player;
use App\Models\Team;
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
        return [
            'player_id' => Player::factory()->create(),
            'team_id' => Team::factory()->create(),
            'start_date' => fake()->dateTimeBetween('-5 years', '-1 year'),
            'end_date' => fake()->dateTimeBetween('1 year', '5 years'),
        ];
    }
}
