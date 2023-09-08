<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Game;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Goal>
 */
class GoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $teamA = \App\Models\Team::find(1)->pluck('id')->toArray();
        // $playersTeamA = $teamA->players->pluck('id')->toArray();
        // $teamH = \App\Models\Team::find(2)->pluck('id')->toArray();
        // $playersTeamH = $teamH->players->pluck('id')->toArray();

        $game = Game::factory()->create();

        return [
            'game_id' => $game->id,
            'player_id' => fake()->randomElement($game->team_a->players->pluck('id')->toArray()),
            'minute' => fake()->numberBetween(1, 94);
            
        ];

        // $table->foreignId('game_id')->constrained();
        // $table->foreignId('player_id')->constrained();
        // $table->unsignedTinyInteger('minute');
        // $table->timestamps();
    }
}
