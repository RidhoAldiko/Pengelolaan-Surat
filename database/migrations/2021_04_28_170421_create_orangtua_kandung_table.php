<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrangtuaKandungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orangtua_kandung', function (Blueprint $table) {
            $table->smallIncrements('id_orangtua');
            $table->char('nip_pegawai',18);
            $table->string('status',10);
            $table->string('nama',60);
            $table->date('tgl_lahir');
            $table->string('pekerjaan',50);
            $table->text('keterangan')->nullable()->default('-');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orangtua_kandung');
    }
}
