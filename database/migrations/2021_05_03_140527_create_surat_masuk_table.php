<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->smallIncrements('id_surat_masuk');
            $table->string('pengirim');
            $table->char('nomor_surat',100);
            $table->date('tanggal_surat');
            $table->text('perihal');
            $table->text('isi_ringkasan');
            $table->char('hubungan_nomor_surat',100)->nullable();
            $table->string('file_surat');
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_masuk');
    }
}
