<?php

namespace Tests\Feature;

use App\Models\Player;
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
    private Player $homeTeamPlayer;
    private Player $awayTeamPlayer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->homeTeam = \App\Models\Team::factory(1)->create(['points' => 0])[0];
        $this->awayTeam = \App\Models\Team::factory(1)->create(['points' => 0])[0];

        $this->homeTeamPlayer = (\App\Models\Contract::factory(1)->create([
            'team_id' => $this->homeTeam->id
        ])[0])->player;

        $this->awayTeamPlayer = (\App\Models\Contract::factory(1)->create([
            'team_id' => $this->awayTeam->id
        ])[0])->player;

        $this->game = Game::factory()->create([
            'team_home_id' => $this->homeTeam->id,
            'team_away_id' => $this->awayTeam->id
        ]);

        Goal::factory(2)->create([
            'game_id' => $this->game->id,
            'player_id' => $this->homeTeam->players()->first()->id ,
            'team_id' => $this->homeTeam->id
        ]);

        Goal::factory(3)->create([
            'game_id' => $this->game->id,
            'player_id' => $this->awayTeam->players()->first()->id ,
            'team_id' => $this->awayTeam->id
        ]);

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

    public function test_game_shows_correct_scorers(): void
    {
        $scorers = $this->game->scorers;
        $this->assertTrue($scorers->contains($this->homeTeamPlayer));
        $this->assertTrue($scorers->contains($this->awayTeamPlayer));
    }

    public function test_observer_adds_points_correctly(): void
    {
        $this->game->update([
            'finished' => true
        ]);

        $this->awayTeam->refresh();
        $this->homeTeam->refresh();
        $this->assertTrue($this->awayTeam->points == 3);
        $this->assertTrue($this->homeTeam->points == 0);
    }

    public function test_observer_not_adds_points_when_game_not_finished(): void
    {
        $this->game->update([
            'kickoff_time' => now()
        ]);
        
        $this->awayTeam->refresh();
        $this->homeTeam->refresh();
        $this->assertTrue($this->awayTeam->points == 0);
        $this->assertTrue($this->homeTeam->points == 0);
    }

    public function test_observer_not_adds_points_when_points_already_counted(): void
    {
        $this->game->update([
            'finished' => true
        ]);
        
        $this->awayTeam->refresh();
        $this->game->refresh();

        $this->assertTrue($this->game->points_counted == true);

        $this->game->update([
            'kickoff_time' => now()
        ]);

        $this->assertTrue($this->awayTeam->points == 3);
        $this->assertTrue($this->homeTeam->points == 0);
    }
}
