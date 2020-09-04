<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFootballMatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('football_matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('football_tour_id')->unsigned();
            $table->foreign('football_tour_id')->references('id')->on('football_tours');
            $table->string('player_1');
            $table->string('player_2');
            $table->tinyInteger('winner')->nullable()->unsigned();
            $table->tinyInteger('player_1_goals')->nullable()->unsigned();
            $table->tinyInteger('player_2_goals')->nullable()->unsigned();
            $table->date('game_date');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('football_matches');
        Schema::enableForeignKeyConstraints();
    }
}
