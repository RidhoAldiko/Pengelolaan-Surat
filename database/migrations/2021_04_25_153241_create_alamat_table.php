<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlamatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alamat', function (Blueprint $table) {
            $table->smallIncrements('id_alamat');
            $table->char('nip_pegawai',18);
            $table->string('jalan',60);
            $table->string('kelurahan_desa',50);
            $table->string('kecamatan',60);
            $table->string('kabupaten_kota',50);
            $table->string('provinsi',50);


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
        Schema::dropIfExists('alamat');
    }
}
