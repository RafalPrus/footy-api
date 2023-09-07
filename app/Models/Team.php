<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    public function players(): array
    {
        $contracts = $this->contracts;
        $players = [];

        foreach($contracts as $contract) {
            if ($contract->isActual()) {
                $players[] = $contract->player;
            }
        }

        return $players;
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

}
