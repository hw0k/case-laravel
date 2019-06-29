<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseTournamentATable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CASE_TOURNAMENT_A_TB', function (Blueprint $table) {
            $table->bigInteger('ex_co_idx')->unsigned();
            $table->Integer('to_a_round');
            $table->bigInteger('u_idx')->unsigned();

            $table->primary(['ex_co_idx','to_a_round']);
            
            $table->foreign('ex_co_idx')->references('ex_co_idx')->on('CASE_EXAMPLE_COLUMN_TB');
            $table->foreign('u_idx')->references('u_idx')->on('USER_TB');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CASE_TOURNAMENT_A_TB');
    }
}
