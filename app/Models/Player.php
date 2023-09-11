<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    public function hasActualContract(): Attribute
    {
        $team = $this->team;

        return Attribute::make(
            get: fn($value, $attributes) => ! empty($team)
        );
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, (new Contract())->getTable())
            ->wherePivot('end_date', '>=', now()->toDateTimeString());
    }

    public function team(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $this->teams()->first() ?? 'Free agent'
        );
    }

    public function previousTeams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, (new Contract())->getTable())
            ->where('contracts.end_date', '<', now()->toDateTimeString());
    }

    public function goalsPer90Minutes(): Attribute
    {
        return Attribute::make(
                get: fn($value, $attributes) => ($this->goals && $this->minutes)
                                                    ? $this->goals / ($this->minutes / 90)
                                                    : 0
        );
    }

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class);
    }
}
