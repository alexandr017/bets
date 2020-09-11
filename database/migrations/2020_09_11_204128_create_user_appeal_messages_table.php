<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAppealMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_appeal_messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_appeal_theme_id')->unsigned();
            $table->foreign('user_appeal_theme_id')->references('id')->on('user_appeal_themes');
            $table->boolean('sender');
            $table->text('message');
            $table->boolean('status_for_admin');
            $table->boolean('status_for_user');
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
        Schema::dropIfExists('user_appeal_messages');
    }
}
