<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEffortSuratKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('effort_surat_keluar', function (Blueprint $table) {
            $table->smallIncrements('id_effort_surat');
            $table->smallInteger('id_surat_keluar')->unsigned();
            $table->char('indeks',100);
            $table->date('tanggal_effort');
            $table->timestamps();

            $table->foreign('id_surat_keluar')->references('id_surat_keluar')->on('surat_keluar')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('effort_surat_keluar');
    }
}
