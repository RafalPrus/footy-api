<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    use HasFactory;

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    public function team(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, (new Contract())->getTable())
            ->where('contracts.end_date', '>=', now()->toDateTimeString());
    }

    public function previousTeams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, (new Contract())->getTable())
            ->where('contracts.end_date', '<', now()->toDateTimeString());
    }
}
