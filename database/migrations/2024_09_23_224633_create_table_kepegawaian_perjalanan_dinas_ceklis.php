<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKepegawaianPerjalananDinasCeklis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kepegawaian_pd_ceklis', function (Blueprint $table) { // pd = Perjalanan Dinas
            $table->id();

                $table->unsignedBigInteger('pd_id')->comment('ID from Table kepegawaian_pd');
                $table->foreign('pd_id')->references('id')->on('kepegawaian_pd');

            $table->integer('user_id')->comment('Verify from User Kepegawaian')->nullable();

            $table->boolean('ceklis1')->comment('Ceklis Undangan')->nullable();
            $table->boolean('ceklis2')->comment('Ceklis Surat Tugas')->nullable();
            $table->boolean('ceklis3')->comment('Ceklis Disposisi')->nullable();
            $table->boolean('ceklis4')->comment('Ceklis Laporan')->nullable();

            $table->integer('ceklis5')->comment('Ceklis Nama Petugas Yang Berangkat')->nullable();
            $table->integer('ceklis6')->comment('Ceklis Kendaraan Yang Digunakan')->nullable();
            $table->integer('ceklis7')->comment('Waktu Berangkat Tugas')->nullable();
            $table->integer('ceklis8')->comment('Lama Bertugas')->nullable();

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
        Schema::dropIfExists('kepegawaian_pd_ceklis');
    }
}
