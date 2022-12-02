<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMutasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutasis', function (Blueprint $table) {
            $table->id('mutasi_id');
            $table->unsignedBigInteger('student_id');
            $table->string('to_school');
            $table->string('letter_school_transfer');
            $table->string('letter_ijazah');
            $table->string('letter_no_sanksi');
            $table->string('letter_recom_diknas');
            $table->string('kartu_keluarga');
            $table->string('surat_keterangan_pindah_sekolah');
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
        Schema::dropIfExists('mutasis');
    }
}
