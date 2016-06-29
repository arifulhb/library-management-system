<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('gender', 10)->nullable();
            $table->date('dateOfBirth')->nullable();
            $table->text('shortBio')->nullable();
            $table->string('country', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('twitter', 100)->nullable();
            $table->string('website', 100)->nullable();
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
        Schema::drop('authors');
    }
}
