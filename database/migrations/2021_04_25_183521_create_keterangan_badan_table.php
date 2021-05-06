<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeteranganBadanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keterangan_badan', function (Blueprint $table) {
            $table->smallIncrements('id_ketbadan');
            $table->char('nip_pegawai',18);
            $table->integer('tinggi');
            $table->integer('berat_badan');
            $table->string('rambut',30);
            $table->string('bentuk_muka',20);
            $table->string('warna_kulit',30);
            $table->string('ciri_khas',50);
            $table->string('cacat_tubuh',50);


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
        Schema::dropIfExists('keterangan_badan');
    }
}
