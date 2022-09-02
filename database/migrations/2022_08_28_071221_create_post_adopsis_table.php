<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostAdopsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_adopsis', function (Blueprint $table) {
            $table->bigIncrements('id_post_adopsi');
            $table->string('nama_post');
            $table->string('lokasi');
            $table->string('syarat_adopsi');

            $table->unsignedBigInteger('id_ras_hewan');
            $table->foreign('id_ras_hewan')->references('id_ras_hewan')->on('ras_hewans')
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
        Schema::dropIfExists('post_adopsis');
    }
}
