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
            $table->smallInteger('id_jabatan')->unsigned();
            $table->smallIncrements('id_unit');
            $table->string('nama_unit',70)->unique();
            $table->tinyInteger('status');//0=aktif 1 = nonaktif

            // foreign key dari tabel jabatan
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatan')->onUpdate('cascade');

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
