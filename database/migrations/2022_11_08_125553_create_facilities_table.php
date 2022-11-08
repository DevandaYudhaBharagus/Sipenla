<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id('facility_id');
            $table->string('facility_code');
            $table->string('facility_name');
            $table->string('number_of_facility');
            $table->string('year');
            $table->string('owned_by');
            $table->string('status');
            $table->dateTime('date');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('facilities');
    }
}
