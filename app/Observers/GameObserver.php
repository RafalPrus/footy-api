<?php

namespace App\Observers;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class GameObserver
{
    /**
     * Handle the Game "created" event.
     */
    public function created(Game $game): void
    {
        //
    }

    /**
     * Handle the Game "updated" event.
     */
    public function updated(Game $game): void
    {
        $homeTeam = $game->teamHome;
        $awayTeam = $game->teamAway;
        $homeTeamPoints = 0;
        $awayTeamPoints = 0;
        if($game->finished && !$game->points_counted) {
            ($game->homeTeamGoals > $game->awayTeamGoals)
                            ? $homeTeamPoints = 3
                            : (($game->homeTeamGoals < $game->awayTeamGoals)
                                                                            ? $awayTeamPoints = 3
                                                                            : $awayTeamPoints = 1 && $homeTeamPoints = 1
                                                                        );
            
            DB::transaction(function () use ($homeTeam, $awayTeam, $homeTeamPoints, $awayTeamPoints, $game) {
                if ($homeTeamPoints) {
                    $homeTeam->update([
                        'points' => $homeTeam->points + $homeTeamPoints
                    ]);
                }
                
                if ($awayTeamPoints) {
                    $awayTeam->update([
                        'points' => $awayTeam->points + $awayTeamPoints
                    ]);
                }

                $game->update([
                    'points_counted' => true
                ]);
            });
        }
    }

    /**
     * Handle the Game "deleted" event.
     */
    public function deleted(Game $game): void
    {
        //
    }

    /**
     * Handle the Game "restored" event.
     */
    public function restored(Game $game): void
    {
        //
    }

    /**
     * Handle the Game "force deleted" event.
     */
    public function forceDeleted(Game $game): void
    {
        //
    }
}
