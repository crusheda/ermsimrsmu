<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKepegawaianSurtugCeklis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kepegawaian_surtug_ceklis', function (Blueprint $table) {
            $table->id();

                $table->unsignedBigInteger('surtug_id')->comment('ID from Table Users');
                $table->foreign('surtug_id')->references('id')->on('kepegawaian_surtug');

            $table->integer('user_id')->comment('Verify from User Kepegawaian');

            $table->integer('ceklis1')->comment('Ceklis Surat Tugas')->nullable();
            $table->integer('ceklis2')->comment('Ceklis Nama Petugas Yang Berangkat')->nullable();
            $table->integer('ceklis3')->comment('Ceklis Kendaraan Yang Digunakan')->nullable();
            $table->integer('ceklis4')->comment('Waktu Berangkat Tugas')->nullable();
            $table->integer('ceklis5')->comment('Lama Bertugas')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kepegawaian_surtug_ceklis');
    }
}
