<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function homeTeamGoals(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => count($this->goals()
                                                        ->where('team_id', $this->team_home_id)
                                                        ->get())
        );
    }

    public function awayTeamGoals(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => count($this->goals()
                                                        ->where('team_id', $this->team_away_id)
                                                        ->get())
        );
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class)
                    ->withPivot('is_home');
    }

    public function homePlayers(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $this->players()->where('is_home', true)->get()
        );
    }

    public function awayPlayers()
    {
        return $this->players()->where('is_home', false)->get();
    }


}
