<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CASE_TAG_TB', function (Blueprint $table) {
            $table->bigInteger('ca_idx')->unsigned();
            $table->bigInteger('i_idx')->unsigned();

            $table->primary(['ca_idx','i_idx']);
            
            $table->foreign('ca_idx')->references('ca_idx')->on('CASE_TB');
            $table->foreign('i_idx')->references('i_idx')->on('INTEREST_RF');
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
        Schema::dropIfExists('CASE_TAG_TB');
    }
}
