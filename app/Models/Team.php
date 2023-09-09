<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

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

}
