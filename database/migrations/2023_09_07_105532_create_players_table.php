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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->text('first_name');
            $table->text('last_name');
            $table->date('date_of_birth');
            $table->text('fitness_status');
            $table->text('position');
            $table->unsignedSmallInteger('minutes')->default(0);
            $table->unsignedTinyInteger('assists')->default(0);
            $table->unsignedTinyInteger('goals')->default(0);
            $table->unsignedSmallInteger('shots_taken')->default(0);
            $table->unsignedSmallInteger('shots_saved')->nullable();
            $table->unsignedSmallInteger('goals_conceded')->nullable();
            $table->unsignedTinyInteger('red_cards')->default(0);
            $table->unsignedTinyInteger('yellow_cards')->default(0);
            $table->unsignedBigInteger('value')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
