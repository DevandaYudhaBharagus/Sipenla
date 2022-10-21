<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employee_id');
            $table->unsignedBigInteger('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('nik', 16)->unique();
            $table->string('nuptk', 16)->unique();
            $table->string('npsn', 16)->unique();
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->text('address');
            $table->string('phone', 13);
            $table->string('religion');
            $table->string('education');
            $table->string('family_name');
            $table->text('family_address');
            $table->string('position');
            $table->unsignedBigInteger('company_id');
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
        Schema::dropIfExists('employees');
    }
}
