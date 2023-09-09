<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    public function teamA(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function teamB(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class);
    }
}
