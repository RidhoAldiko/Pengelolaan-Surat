<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_pegawai', function (Blueprint $table) {
            $table->smallIncrements('id_dokpegawai');
            $table->char('nip_pegawai',18);
            $table->string('nama_dokumen',60);
            $table->text('keterangan')->nullable()->default('-');
            $table->string('file_dokumen',254);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumen_pegawai');
    }
}
