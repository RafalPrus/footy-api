<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Game;
use App\Models\Goal;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $teamH = \App\Models\Team::factory(1)->create();
        $teamA = \App\Models\Team::factory(1)->create();
        \App\Models\Contract::factory(12)->create(['team_id' => $teamH[0]->id]);
        \App\Models\Contract::factory(12)->create(['team_id' => $teamA[0]->id]);

        $game = Game::factory()->create(['team_home' => $teamH[0]->id, 'team_away' => $teamA[0]->id]);
        Goal::factory(2)->create(['game_id' => $game->id, 'player_id' => $teamH[0]->players()->first()->id ,'team_id' => $teamH[0]->id]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
