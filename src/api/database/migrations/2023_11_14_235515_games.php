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
        Schema::create('games', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('homeTeam');
            $table->unsignedBigInteger('awayTeam');
            $table->unsignedBigInteger('season');
            $table->integer('homeScore');
            $table->integer('awayScore');
            $table->timestamps();
        });

        Schema::table('games', function (Blueprint $table){
            $table->foreign('homeTeam')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('awayTeam')->references('id')->on('teams')->onDelete('cascade');
            
            $table->foreign('season')->references('id')->on('seasons')->onDelete('cascade');

            $table->unique(["homeTeam", "awayTeam", "season"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Matches');
    }
};
