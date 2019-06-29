<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MEDIA_TB', function (Blueprint $table) {
            $table->bigIncrements('me_idx');
            $table->string('me_path');
            $table->bigInteger('me_t_idx')->unsigned();

            $table->foreign('me_t_idx')->references('me_t_idx')->on('MEDIA_TYPE_RF');
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
        Schema::dropIfExists('MEDIA_TB');
    }
}
