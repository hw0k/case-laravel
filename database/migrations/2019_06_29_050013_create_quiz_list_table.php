<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('QUIZ_LIST_TB', function (Blueprint $table) {
            $table->bigInteger('ca_idx')->unsigned();
            $table->Integer('qu_li_sequence');
            $table->bigInteger('qu_idx')->unsigned();

            $table->primary(['ca_idx', 'qu_li_sequence']);
            $table->foreign('ca_idx')->references('ca_idx')->on('CASE_TB');
            $table->foreign('qu_idx')->references('qu_idx')->on('QUIZ_TB');
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
        Schema::dropIfExists('QUIZ_LIST_TB');
    }
}
