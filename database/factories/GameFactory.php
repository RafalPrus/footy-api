<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Team;

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
            'team_h' => Team::factory(),
            'team_a' => Team::factory(),
            
        ];

        // return [
        //     'player_id' => fake()->randomElement($players),
        //     'team_id' => fake()->randomElement($teams),
        //     'start_date' => fake()->dateTimeBetween('-5 years', '-1 year'),
        //     'end_date' => fake()->dateTimeBetween('1 year', '5 years'),
        // ];
        // $table->id();
        // $table->date('kickoff_time')->nullable();
        // $table->foreignId('team_a')->constrained('teams');
        // $table->foreignId('team_b')->constrained('teams');
        // $table->timestamps();

    }
}
