<?php

namespace Database\Factories;

use App\Models\Player;
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
        //TODO: how to override factories?
        return [
            'game_id' => Game::factory()->create(),
            'player_id' => Player::factory()->create(),
            'minute' => fake()->numberBetween(1, 94),

        ];

        // $table->foreignId('game_id')->constrained();
        // $table->foreignId('player_id')->constrained();
        // $table->unsignedTinyInteger('minute');
        // $table->timestamps();
    }
}
