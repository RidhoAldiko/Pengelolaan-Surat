<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisasi', function (Blueprint $table) {
            $table->smallIncrements('id_organisasi');
            $table->char('nip_pegawai',18);
            $table->string('waktu',60);
            $table->string('nama',100);
            $table->string('kedudukan',60);
            $table->string('tahun_mulai',5);
            $table->string('tahun_selesai',5);
            $table->text('tempat');
            $table->string('pimpinan',30);


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
        Schema::dropIfExists('organisasi');
    }
}
