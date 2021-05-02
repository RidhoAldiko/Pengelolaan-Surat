<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiklatPenjenjanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diklat_penjenjangan', function (Blueprint $table) {
            $table->smallIncrements('id_diklat');
            $table->char('nip_pegawai',18);
            $table->string('nama_diklat',60);
            $table->string('tahun',5);
            $table->string('nomor',60);
            $table->date('tanggal');
            $table->string('bukti_lulus',254);//ini bukti lulus
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diklat_penjenjangan');
    }
}
