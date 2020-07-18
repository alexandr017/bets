<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFootballTours extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('football_tours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('football_category_id')->unsigned();
            $table->foreign('football_category_id')->references('id')->on('football_categories');
            $table->string('tour_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('football_tours');
    }
}
