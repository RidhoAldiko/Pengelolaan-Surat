<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_surat', function (Blueprint $table) {
            $table->smallIncrements('id_level_surat');
            $table->string('nama_level',70)->unique();
            $table->tinyInteger('urutan_level');//0=aktif 1 = nonaktif
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('level_surat');
    }
}
