<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('match_id');
            $table->unsignedInteger('team_id');
            $table->string('player_name');
            $table->tinyInteger('type')->comment("1: Goal | 2: Yellow Card | 3: Red Card");
            $table->integer('minutes');
            $table->timestamps();
            $table->foreign('match_id')->references('id')->on('matches');
            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_events');
    }
}
