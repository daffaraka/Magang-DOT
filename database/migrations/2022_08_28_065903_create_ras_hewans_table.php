<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRasHewansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ras_hewans', function (Blueprint $table) {
            $table->bigIncrements('id_ras_hewan');
            $table->string('nama_ras');
            $table->string('asal_ras');
            $table->unsignedBigInteger('id_jenis_hewan');
            $table->foreign('id_jenis_hewan')->references('id_jenis_hewan')->on('jenis_hewans')
                                                      ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('ras_hewans');
    }
}
