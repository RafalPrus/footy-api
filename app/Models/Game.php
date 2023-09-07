<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
