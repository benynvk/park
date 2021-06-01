<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReplacePlayerColumnInMatchEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('match_events', function (Blueprint $table) {
            $table->dropColumn('player_name');
            $table->integer('player_id')->after('team_id');
            $table->integer('related_player_id')->after('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('match_events', function (Blueprint $table) {
            $table->string('player_name');
            $table->dropColumn('player_id');
            $table->dropColumn('related_player_id');
        });
    }
}
