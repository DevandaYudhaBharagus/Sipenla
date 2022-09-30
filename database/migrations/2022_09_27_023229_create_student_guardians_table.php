<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentGuardiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_guardians', function (Blueprint $table) {
            $table->id('guardian_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('student_id');
            $table->string('guardian_name');
            $table->string('no_kk');
            $table->string('phone', 13);
            $table->string('religion');
            $table->text('address');
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
        Schema::dropIfExists('student_guardians');
    }
}
