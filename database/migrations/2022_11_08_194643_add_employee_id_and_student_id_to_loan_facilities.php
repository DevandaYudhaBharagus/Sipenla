<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmployeeIdAndStudentIdToLoanFacilities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_facilities', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id')->nullable()->after('status');
            $table->unsignedBigInteger('student_id')->nullable()->after('employee_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_facilities', function (Blueprint $table) {
            //
        });
    }
}
