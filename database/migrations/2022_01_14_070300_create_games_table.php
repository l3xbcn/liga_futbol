<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('edition_id');
            $table->foreign('edition_id')
                ->references('id')
                ->on('editions')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedTinyInteger('match_day');            
            $table->unsignedBigInteger('team_local_id');
            $table->unsignedBigInteger('team_visitor_id');
            $table->foreign('team_local_id')
                ->references('id')
                ->on('teams')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('team_visitor_id')
                ->references('id')
                ->on('teams')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->unique(array('edition_id','match_day','team_local_id','team_visitor_id'));




            $table->unsignedTinyInteger('goals_local');
            $table->unsignedTinyInteger('goals_visitor');




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
        Schema::dropIfExists('games');
    }
}
