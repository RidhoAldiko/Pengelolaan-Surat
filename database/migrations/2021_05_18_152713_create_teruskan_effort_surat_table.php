<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeruskanEffortSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teruskan_effort_surat', function (Blueprint $table) {
            $table->id('id_teruskan_effort_surat');
            $table->char('id');
            $table->smallInteger('id_effort_surat')->unsigned();
            $table->text('instruksi');
            $table->string('paraf');
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
            $table->foreign('id_effort_surat')->references('id_effort_surat')->on('effort_surat_keluar')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teruskan_effort_surat');
    }
}
