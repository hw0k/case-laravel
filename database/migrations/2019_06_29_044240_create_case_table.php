<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CASE_TB', function (Blueprint $table) {
            $table->bigIncrements('ca_idx');
            $table->string('ca_title');
            $table->bigInteger('u_idx')->unsigned();
            $table->integer('ca_point')->default(0);

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
        Schema::dropIfExists('CASE_TB');
    }
}
