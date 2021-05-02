<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeteranganLainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keterangan_lain', function (Blueprint $table) {
            $table->smallIncrements('id_ketlain');
            $table->char('nip_pegawai',18);
            $table->string('jenis',60);
            $table->string('penjabat',60);
            $table->string('nomor',60);
            $table->date('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keterangan_lain');
    }
}
