<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeruskanDisposisiMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teruskan_disposisi_masuk', function (Blueprint $table) {
            $table->id('id_teruskan_surat_masuk');
            $table->char('id');
            $table->smallInteger('id_disposisi_surat_masuk')->unsigned();
            $table->text('instruksi');
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
            
            $table->foreign('id_disposisi_surat_masuk')->references('id_disposisi_surat_masuk')->on('disposisi_surat_masuk')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teruskan_disposisi_masuk');
    }
}
