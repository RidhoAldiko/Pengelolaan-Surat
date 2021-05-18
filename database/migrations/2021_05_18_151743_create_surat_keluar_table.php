<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->smallIncrements('id_surat_keluar');
            $table->char('nomor_surat',100);
            $table->date('tanggal_surat');
            $table->text('perihal');
            $table->text('isi_ringkasan');
            $table->char('hubungan_nomor_surat',100)->nullable();
            $table->text('alamat');
            $table->text('keterangan');
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
        Schema::dropIfExists('surat_keluar');
    }
}
