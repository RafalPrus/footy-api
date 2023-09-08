<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Team;
use App\Models\Player;
use App\Models\Contract;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_team_has_correct_quantity_of_players_with_one_contract(): void
    {
        $team = Team::factory()->create();
        $player = Player::factory()->create();
        $playerContract = Contract::factory()->create(['team_id' => $team->id, 'player_id' => $player->id]);
        
        $teamPlayers = $team->players;
        $teamPlayer = $teamPlayers->first();
        
        $this->assertCount(1, $teamPlayers);
        $this->assertEquals($player->first_name, $teamPlayer->first_name);
    }

    public function test_team_has_correct_quantity_of_players_with_many_contracts(): void
    {
        $team = Team::factory()->create();
        $players = Player::factory(3)->create();

        foreach ($players as $player) {
            Contract::factory()->create(['team_id' => $team->id, 'player_id' => $player->id]);
        }
        
        $teamPlayers = $team->players;
        $teamPlayer = $teamPlayers->first();
        
        $this->assertCount(3, $teamPlayers);
        $this->assertEquals($players->first()->first_name, $teamPlayer->first_name);
    }

    public function test_team_has_correct_quantity_of_players_with_inactual_contract(): void
    {
        $team = Team::factory()->create();
        $players = Player::factory(3)->create();

        foreach ($players as $player) {
            Contract::factory()->create(['team_id' => $team->id, 'player_id' => $player->id]);
        }

        $contract = $team->contracts()->first();
        $contract->end_date = now()->subDay();
        $contract->save();
        
        $teamPlayers = $team->players;
        $teamPlayer = $teamPlayers->first();
        
        $this->assertCount(2, $teamPlayers);
        $this->assertFalse($contract->isActual());
    }
}
