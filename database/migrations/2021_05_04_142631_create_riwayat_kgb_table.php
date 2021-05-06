<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatKgbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_kgb', function (Blueprint $table) {
            $table->smallIncrements('id_riwayat_kgb');
            $table->char('nip_pegawai',18);
            $table->smallInteger('id_gaji')->unsigned();
            $table->date('mulai_berlaku');

            // foreign key dari tabel golongan
            $table->foreign('id_gaji')->references('id_gaji')->on('gaji')->onUpdate('cascade');
            // foreign key dari tabel pegawai
            $table->foreign('nip_pegawai')->references('nip_pegawai')->on('pegawai')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_kgb');
    }
}
