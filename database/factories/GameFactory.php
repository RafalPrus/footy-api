<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Team;
use App\Models\Gameweek;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kickoff_time' => fake()->dateTimeBetween('-16 weeks', '-1 week'),
            'gameweek_id' => Gameweek::factory(),
            'team_home_id' => Team::factory(),
            'team_away_id' => Team::factory(),

        ];
    }
}
