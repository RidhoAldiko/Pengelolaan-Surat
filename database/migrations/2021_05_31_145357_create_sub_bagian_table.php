<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubBagianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_bagian', function (Blueprint $table) {
            $table->smallIncrements('id_sub_bagian');
            $table->smallInteger('id_bagian')->unsigned();
            $table->string('nama_sub_bagian',70)->unique();
            $table->tinyInteger('status');//0=aktif 1 = nonaktif

            
            // foreign key dari tabel pegawai
            $table->foreign('id_bagian')->references('id_bagian')->on('bagian')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_bagian');
    }
}
