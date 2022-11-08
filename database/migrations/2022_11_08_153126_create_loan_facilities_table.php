<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_facilities', function (Blueprint $table) {
            $table->id('loan_facility_id');
            $table->unsignedBigInteger('facility_id');
            $table->string('total_facility');
            $table->dateTime('from_date');
            $table->dateTime('to_date');
            $table->date('date');
            $table->string('status');
            $table->unsignedBigInteger('person_submitted');
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
        Schema::dropIfExists('loan_facilities');
    }
}
