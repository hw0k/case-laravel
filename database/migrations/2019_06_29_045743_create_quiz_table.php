<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('QUIZ_TB', function (Blueprint $table) {
            $table->bigIncrements('qu_idx');
            $table->string('qu_question');
            $table->string('qu_rAnswer')->nullable();
            $table->string('qu_table');
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
        Schema::dropIfExists('QUIZ_TB');
    }
}
