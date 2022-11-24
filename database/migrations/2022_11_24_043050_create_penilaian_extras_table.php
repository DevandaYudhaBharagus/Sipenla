<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_extras', function (Blueprint $table) {
            $table->id("penilaian_extra_id");
            $table->unsignedBigInteger("student_id");
            $table->unsignedBigInteger("extracurricular_id");
            $table->unsignedBigInteger("semester_id");
            $table->unsignedBigInteger("academic_year_id");
            $table->double("nilai");
            $table->string("status");
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
        Schema::dropIfExists('penilaian_extras');
    }
}
