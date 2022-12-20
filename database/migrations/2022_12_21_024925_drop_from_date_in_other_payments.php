<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropFromDateInOtherPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('other_payments', function (Blueprint $table) {
            $table->dropColumn('from_date');
            $table->dropColumn('to_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('other_payments', function (Blueprint $table) {
            //
        });
    }
}
