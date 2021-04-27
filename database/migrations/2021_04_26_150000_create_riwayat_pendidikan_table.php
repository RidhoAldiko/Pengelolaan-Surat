<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPendidikanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_pendidikan', function (Blueprint $table) {
            $table->smallIncrements('id_riwayatpendidikan');
            $table->char('nip_pegawai',18);
            $table->string('jenis_pendidikan',30);
            $table->string('nama_pendidikan',60);
            $table->string('jurusan',60);
            $table->string('no_sttb',30);
            $table->date('tgl_sttb');
            $table->text('tempat');
            $table->string('nama_kepsek',50);
            $table->date('mulai');
            $table->date('sampai');
            $table->string('tanda_lulus',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_pendidikan');
    }
}
