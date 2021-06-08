<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asisten', function (Blueprint $table) {
            $table->smallIncrements('id_asisten');
            $table->string('nama_asisten',70)->unique();
            $table->tinyInteger('status');//0=aktif 1 = nonaktif
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asisten');
    }
}
