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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->mediumText('bio');
            $table->string('image');
            $table->string('email')->unique();
            $table->string('sex');
            $table->boolean('is_approved');
            $table->boolean('is_admin');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('sex')
                ->references('sex')->on('sexes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
