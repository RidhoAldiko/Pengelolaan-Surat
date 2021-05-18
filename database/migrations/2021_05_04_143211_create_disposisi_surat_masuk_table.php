<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisposisiSuratMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposisi_surat_masuk', function (Blueprint $table) {
            $table->smallIncrements('id_disposisi_surat_masuk');
            $table->smallInteger('id_surat_masuk')->unsigned();
            $table->char('indeks',100);
            $table->date('tanggal_disposisi');
            $table->timestamps();

            $table->foreign('id_surat_masuk')->references('id_surat_masuk')->on('surat_masuk')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disposisi_surat_masuk');
    }
}
