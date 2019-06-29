<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseTextATable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CASE_TEXT_A_TB', function (Blueprint $table) {
            $table->bigIncrements('te_a_idx');
            $table->bigInteger('qu_idx')->unsigned();
            $table->bigInteger('u_idx')->unsigned();
            $table->string('te_a_answer');

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
        Schema::dropIfExists('CASE_TEXT_A_TB');
    }
}
