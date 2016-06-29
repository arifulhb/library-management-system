<?php

    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateReservationsTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('reservations', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->date('date');

                $table->bigInteger('book_copy_id')->unsigned();
                $table->foreign('book_copy_id')
                      ->references('id')->on('books_copies')
                      ->onDelete('cascade');

                $table->bigInteger('member_id')->unsigned();
                $table->foreign('member_id')
                      ->references('id')->on('users')
                      ->onDelete('cascade');
                $table->date('dueDate');

                /**
                 * 0: not returned
                 * 1: returned
                 */
                $table->smallInteger('returnStatus');

                $table->timestamp('returnDate');
                $table->double('fine', 4, 2)->default(0.0);
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
            Schema::drop('reservations');
        }
    }
