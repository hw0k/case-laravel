<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('USER_INTEREST_TB', function (Blueprint $table) {
            $table->bigInteger('u_idx')->unsigned();
            $table->bigInteger('i_idx')->unsigned();

            $table->primary(['u_idx','i_idx']);
            
            $table->foreign('u_idx')->references('u_idx')->on('USER_TB');
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
        Schema::dropIfExists('USER_INTEREST_TB');
    }
}
