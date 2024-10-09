<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKepegawaianSurket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kepegawaian_surket', function (Blueprint $table) {
            $table->id();

                $table->unsignedBigInteger('ref_id')->comment('ID from Table Referensi');
                $table->foreign('ref_id')->references('id')->on('referensi');

                $table->unsignedInteger('pegawai_id')->comment('ID from Table Users');
                $table->foreign('pegawai_id')->references('id')->on('users');

            $table->string('pegawai_nama');
            $table->string('pegawai_ttl');
            $table->string('pegawai_pendidikan')->comment('Pendidikan Terakhir');
            $table->string('pegawai_alamat');

            $table->integer('progress')->comment('0=pengajuan;1=dalam_proses;2=selesai;3=ditolak');
            $table->integer('valid')->comment('Verify from User Kepegawaian')->nullable();
            $table->dateTime('tgl_valid')->nullable();

            $table->string('title', 200)->nullable();
            $table->string('filename', 200)->nullable();
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
        Schema::dropIfExists('kepegawaian_surket');
    }
}
