<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_kerja', function (Blueprint $table) {
            $table->smallIncrements('id_unit');
            $table->char('nip_pegawai',18);
            $table->smallInteger('id_staf_ahli')->unsigned()->nullable();
            $table->smallInteger('id_asisten')->unsigned()->nullable();
            $table->smallInteger('id_bagian')->unsigned()->nullable();
            $table->smallInteger('id_sub_bagian')->unsigned()->nullable();

            
            // foreign key dari tabel pegawai
            $table->foreign('nip_pegawai')->references('nip_pegawai')->on('pegawai')->onUpdate('cascade');
            $table->foreign('id_staf_ahli')->references('id_staf_ahli')->on('staf_ahli')->onUpdate('cascade');
            $table->foreign('id_asisten')->references('id_asisten')->on('asisten')->onUpdate('cascade');
            $table->foreign('id_bagian')->references('id_bagian')->on('bagian')->onUpdate('cascade');
            $table->foreign('id_sub_bagian')->references('id_sub_bagian')->on('sub_bagian')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit_kerja');
    }
}
