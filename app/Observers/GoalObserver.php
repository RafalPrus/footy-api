<?php

namespace App\Observers;

use App\Models\Goal;
use App\Models\Player;

class GoalObserver
{
    /**
     * Handle the Goal "created" event.
     */
    public function creating(Goal $goal): void
    {
        $player = Player::find($goal->player->id);
        $player->update([
            'goals' => $player->goals + 1
        ]);
    }
    public function created(Goal $goal): void
    {
        //
    }

    /**
     * Handle the Goal "updated" event.
     */
    public function updated(Goal $goal): void
    {
        //
    }

    /**
     * Handle the Goal "deleted" event.
     */
    public function deleted(Goal $goal): void
    {
        //
    }

    /**
     * Handle the Goal "restored" event.
     */
    public function restored(Goal $goal): void
    {
        //
    }

    /**
     * Handle the Goal "force deleted" event.
     */
    public function forceDeleted(Goal $goal): void
    {
        //
    }
}
