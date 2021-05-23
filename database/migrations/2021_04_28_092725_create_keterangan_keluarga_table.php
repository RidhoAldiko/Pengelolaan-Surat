<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeteranganKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keterangan_keluarga', function (Blueprint $table) {
            $table->smallIncrements('id_ketKeluarga');
            $table->char('nip_pegawai',18);
            $table->string('status',15);
            $table->string('nama',60);
            $table->string('jenis_kelamin',10);
            $table->string('tempat_lahir',60);
            $table->date('tgl_lahir');
            $table->date('tgl_nikah')->nullable();
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
        Schema::dropIfExists('keterangan_keluarga');
    }
}
