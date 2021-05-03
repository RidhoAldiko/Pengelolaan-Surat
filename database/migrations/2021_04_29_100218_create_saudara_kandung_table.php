<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaudaraKandungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saudara_kandung', function (Blueprint $table) {
            $table->smallIncrements('id_saudarakandung');
            $table->char('nip_pegawai',18);
            $table->string('nama',60);
            $table->string('jenis_kelamin',10);
            $table->date('tgl_lahir');
            $table->string('pekerjaan',50);
            $table->text('keterangan')->default('-');


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
        Schema::dropIfExists('saudara_kandung');
    }
}
