<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFootballBets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('football_bets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('football_match_id')->unsigned();
            $table->foreign('football_match_id')->references('id')->on('football_matches');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->decimal('sum_in');
            $table->decimal('sum_out')->nullable();
            $table->tinyInteger('to_player')->nullable()->unsigned();
            $table->smallInteger('status');

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
        Schema::dropIfExists('football_bets');
    }
}
