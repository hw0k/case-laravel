<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseExampleATable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CASE_EXAMPLE_A_TB', function (Blueprint $table) {
            $table->bigIncrements('ex_a_idx');
            $table->bigInteger('qu_idx')->unsigned();
            $table->bigInteger('u_idx')->unsigned();
            $table->string('ex_a_answer');

            $table->foreign('qu_idx')->references('qu_idx')->on('QUIZ_TB');
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
        Schema::dropIfExists('CASE_EXAMPLE_A_TB');
    }
}
