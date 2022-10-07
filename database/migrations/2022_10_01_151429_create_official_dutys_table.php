<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficialDutysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('official_dutys', function (Blueprint $table) {
            $table->id('official_duty_id');
            $table->unsignedBigInteger('employee_id');
            $table->dateTime('duty_from_date');
            $table->dateTime('duty_to_date');
            $table->date('duty_date');
            $table->text('purpose');
            $table->dateTime('time');
            $table->string('place');
            $table->string('abandoned_job');
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('official_dutys');
    }
}
