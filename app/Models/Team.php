<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Team extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, (new Contract())->getTable())
            ->where('contracts.end_date', '>=', now()->toDateTimeString());
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    public function playersValue()
    {
        return $this->belongsToMany(Player::class, (new Contract())->getTable())
            ->where('contracts.end_date', '>=', now()->toDateTimeString())
            ->pluck('value')
            ->sum();
    }

    public function homeGames(): HasMany
    {
        return $this->hasMany(Game::class, 'team_home_id');
    }

    public function awayGames(): HasMany
    {
        return $this->hasMany(Game::class, 'team_away_id');
    }

    public function allGames()
    {
        return $this->awayGames->merge($this->homeGames);
    }

    public function numberOfPlayedGames(): Attribute
    {
        $awayGames = count($this->awayGames()->where('finished', true)->get());
        $homeGames = count($this->homeGames()->where('finished', true)->get());
        $sum = $awayGames + $homeGames;
        
        return Attribute::make(
            get: fn ($value) => $sum,
        );
    }

    public function avgGoalsPerGame(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->goals / $this->numberOfPlayedGames,
        );
    }
}
