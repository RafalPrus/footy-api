<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Team;
use App\Models\Game;
use App\Models\Goal;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase;

    private Team $homeTeam;
    private Team $awayTeam;
    private Game $game;

    protected function setUp(): void
    {
        parent::setUp();

        $this->homeTeam = \App\Models\Team::factory(1)->create()[0];
        $this->awayTeam = \App\Models\Team::factory(1)->create()[0];
        \App\Models\Contract::factory(1)->create(['team_id' => $this->homeTeam->id]);
        \App\Models\Contract::factory(1)->create(['team_id' => $this->awayTeam->id]);

        $this->game = Game::factory()->create(['team_home_id' => $this->homeTeam->id, 'team_away_id' => $this->awayTeam->id]);

        Goal::factory(2)->create(['game_id' => $this->game->id, 'player_id' => $this->homeTeam->players()->first()->id ,'team_id' => $this->homeTeam->id]);
        Goal::factory(3)->create(['game_id' => $this->game->id, 'player_id' => $this->awayTeam->players()->first()->id ,'team_id' => $this->awayTeam->id]);

        foreach($this->homeTeam->players as $player) {
            $this->game->players()->attach([$player->id => ['is_home' => true]]);
        }

        foreach($this->awayTeam->players as $player) {
            $this->game->players()->attach([$player->id => ['is_home' => false]]);
        }
    }
    /**
     * A basic feature test example.
     */
    public function test_game_shows_correct_amount_of_goals(): void
    {
        $homeTeamGoals = $this->game->homeTeamGoals;
        $awayTeamGoals = $this->game->awayTeamGoals;

        $this->assertEquals(2, $homeTeamGoals);
        $this->assertEquals(3, $awayTeamGoals);
    }

    public function test_game_shows_correct_amount_of_scorers(): void
    {
        $scorersNumber = count($this->game->scorers);
        $this->assertEquals(5, $scorersNumber);
    }
}
