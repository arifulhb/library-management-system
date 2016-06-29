<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 256);
            $table->string('isbn10', 10);
            $table->string('isbn13', 13)->nullable();
            $table->date('publishDate')->nullable();
            $table->string('publishYear')->nullable();
            $table->string('edition', 100)->nullable();
            $table->bigInteger('publisher_id')->unsigned();
            $table->foreign('publisher_id')
                  ->references('id')->on('publishers')
                  ->onDelete('cascade');
//            $table->string('bookCode', 50);
            $table->string('shelfName', 100);
            $table->string('shelfRackLevel', 2)->nullable()->default('01');
            $table->string('thumbnail', 256)->nullable();
            $table->bigInteger('added_by')->unsigned();
            $table->foreign('added_by')
                   ->references('id')->on('users')
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
        Schema::drop('books');
    }
}
