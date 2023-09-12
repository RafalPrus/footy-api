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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->date('foundation_date');
            $table->text('city');
            $table->text('street');
            $table->unsignedMediumInteger('stadium_capacity');
            $table->unsignedSmallInteger('strength');
            $table->unsignedSmallInteger('goals')->default(0);
            $table->unsignedSmallInteger('goals_conceded')->default(0);
            $table->text('test')->default('some text');
            $table->tinyInteger('points')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
