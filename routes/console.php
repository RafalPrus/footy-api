<?php

use App\Models\Contract;
use App\Models\Game;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('mt', function () {
    $p = Game::find(1);

    dd($p->teamAway);
})->purpose('Display an inspiring quote');

Artisan::command('my', function () {
    $p = Player::find(25);

    dd($p->team);
})->purpose('Display an inspiring quote');

Artisan::command('game', function () {
    $game = Game::find(1);

    dd(count($game->scorers));
})->purpose('Display an inspiring quote');

Artisan::command('team', function () {
    $game = Team::find(1);

    dd($game->homeGames());
})->purpose('Display an inspiring quote');
