<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');
            $table->unsignedBigInteger('user_id');
            $table->string('nisn')->unique();
            $table->string('nik', 16)->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('gender');
            $table->string('phone', 13);
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->date('date_school_now');
            $table->text('address');
            $table->string('religion');
            $table->string('school_origin');
            $table->string('school_now');
            $table->text('parent_address');
            $table->text('mother_profession');
            $table->text('father_profession');
            $table->text('mother_education');
            $table->text('father_education');
            $table->text('family_name');
            $table->text('family_address');
            $table->string('family_profession');
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
        Schema::dropIfExists('students');
    }
}
