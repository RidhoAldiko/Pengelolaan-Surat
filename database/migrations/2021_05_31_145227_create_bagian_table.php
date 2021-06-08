<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBagianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bagian', function (Blueprint $table) {
            $table->smallIncrements('id_bagian');
            $table->smallInteger('id_asisten')->unsigned();
            $table->string('nama_bagian',70)->unique();
            $table->tinyInteger('status');//0=aktif 1 = nonaktif

            
            // foreign key dari tabel pegawai
            $table->foreign('id_asisten')->references('id_asisten')->on('asisten')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bagian');
    }
}
