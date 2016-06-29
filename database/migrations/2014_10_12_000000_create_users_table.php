<?php

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
            $table->bigIncrements('id');
            $table->string('firstName', 50);
            $table->string('lastName', 50);
            $table->string('profileTitle', 256);
            $table->string('email')->unique();
            /**
             * Gender:
             * Male
             * Female
             */
            $table->string('gender', 10);
            $table->date('dateOfBirth');
            /**
             * Types are: Member/Admin
             */
            $table->string('type', 10);
            /**
             * status:
             * -1: blocked
             *  0: inactive
             *  1: active
             */
            $table->smallInteger('status');
            $table->string('password', 60);
            $table->timestamp('lastLogin');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
