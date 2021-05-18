<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->char('nip_pegawai',18)->primary();
            $table->char('nomor_karpeg',25);
            $table->string('nama_pegawai',60);
            $table->string('tempat_lahir',30);
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin',10);
            $table->string('agama',30);
            $table->string('status_perkawinan',30);
            $table->smallInteger('id_unit')->unsigned();
            $table->smallInteger('id_jabatan')->unsigned();
            $table->string('foto')->nullable();
            $table->tinyInteger('status');//0=aktif 1 = nonaktif
            $table->timestamps();

            // foreign key dari tabel unit_kerja
            $table->foreign('id_unit')->references('id_unit')->on('unit_kerja')->onUpdate('cascade');
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
        Schema::dropIfExists('pegawai');
    }
}
