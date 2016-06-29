<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookCopies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_copies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bookCode', 50);
            /**
             * Status:
             * 0: On loan
             * 1: Active
             * 2: Lost
             * 3: Damaged
             * 4: withdrawn
             */
            $table->smallInteger('status');
            $table->bigInteger('book_id')->unsigned();
            $table->foreign('book_id')
                  ->references('id')->on('books')
                  ->onDelete('cascade');
            $table->bigInteger('added_by')->unsigned()
                  ->reference('id')->on('users')
                  ->onDelete('cascade');
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
        Schema::drop('books_copies');
    }
}
