<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gameweek_id')->constrained('gameweeks');
            $table->date('kickoff_time')->nullable();
            $table->boolean('finished')->default(false);
            $table->boolean('points_counted')->default(false);
            $table->foreignId('team_home_id')->constrained('teams');
            $table->foreignId('team_away_id')->constrained('teams');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
