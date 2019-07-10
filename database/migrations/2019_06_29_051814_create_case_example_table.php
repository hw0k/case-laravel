<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseExampleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CASE_EXAMPLE_TB', function (Blueprint $table) {
            $table->bigInteger('qu_idx')->unsigned();
            $table->string('ex_type');
            $table->bigInteger('me_idx')->nullable()->unsigned();

            $table->primary('qu_idx');
            $table->foreign('qu_idx')->references('qu_idx')->on('QUIZ_TB');
            $table->foreign('me_idx')->references('me_idx')->on('MEDIA_TB');
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
        Schema::dropIfExists('CASE_EXAMPLE_TB');
    }
}
