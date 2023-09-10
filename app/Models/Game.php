<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    public function teamHome(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_home');
    }

    public function teamAway(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_away');
    }

    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class);
    }
}
