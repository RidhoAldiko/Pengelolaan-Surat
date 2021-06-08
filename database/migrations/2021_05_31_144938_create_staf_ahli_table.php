<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStafAhliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staf_ahli', function (Blueprint $table) {
            $table->smallIncrements('id_staf_ahli');
            $table->string('nama_staf_ahli',70)->unique();
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
        Schema::dropIfExists('staf_ahli');
    }
}
