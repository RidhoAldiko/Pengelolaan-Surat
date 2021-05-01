<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengalamanKeluarNegeriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengalaman_keluar_negeri', function (Blueprint $table) {
            $table->smallIncrements('id_keluarnegri');
            $table->char('nip_pegawai',18);
            $table->string('negara',30);
            $table->string('tujuan',100);
            $table->string('lama',20);
            $table->string('membiayai',60);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengalaman_keluar_negeri');
    }
}
