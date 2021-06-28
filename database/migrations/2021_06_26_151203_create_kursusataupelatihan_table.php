<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKursusataupelatihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kursusataupelatihan', function (Blueprint $table) {
            $table->smallIncrements('id_kursus');
            $table->char('nip_pegawai',18);
            $table->string('nama_kursus',200);
            $table->date('mulai');
            $table->date('selesai');
            $table->string('tanda_lulus',200);
            $table->text('tempat');
            $table->text('keterangan')->nullable();
            
             // foreign key dari tabel pegawai
             $table->foreign('nip_pegawai')->references('nip_pegawai')->on('pegawai')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kursusataupelatihan');
    }
}
