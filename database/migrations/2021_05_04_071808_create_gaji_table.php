<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGajiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaji', function (Blueprint $table) {
            $table->smallIncrements('id_gaji');
            $table->smallInteger('id_golongan')->unsigned();
            $table->string('mkg',3);
            $table->integer('jumlah_gaji');
            $table->tinyInteger('status');//0=aktif 1 = nonaktif

            // foreign key dari tabel golongan
            $table->foreign('id_golongan')->references('id_golongan')->on('golongan')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gaji');
    }
}
