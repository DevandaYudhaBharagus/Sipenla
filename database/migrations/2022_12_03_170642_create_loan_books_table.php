<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_books', function (Blueprint $table) {
            $table->id('loan_book_id');
            $table->unsignedBigInteger('book_id');
            $table->string('total_book');
            $table->dateTime('from_date');
            $table->dateTime('to_date');
            $table->date('date');
            $table->string('status');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
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
        Schema::dropIfExists('loan_books');
    }
}
