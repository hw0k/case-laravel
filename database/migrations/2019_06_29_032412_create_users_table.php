<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('USER_TB', function (Blueprint $table) {
            $table->bigIncrements('u_idx');
            $table->string('u_name');
            $table->string('u_account');
            $table->string('u_password');
            $table->string('u_age')->nullable();
            $table->string('u_email');
            $table->string('u_phone')->nullable();
            $table->string('u_gender')->nullable();
            $table->string('u_profile')->nullable();
            $table->integer('u_point')->default(0);
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
        Schema::dropIfExists('USER_TB');
    }
}
