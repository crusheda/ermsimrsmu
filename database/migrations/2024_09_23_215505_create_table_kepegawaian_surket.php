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

            $table->integer('no_surat');
            $table->integer('th_surat');
            $table->date('tgl_surat');
            $table->string('pegawai_nama');
            $table->string('pegawai_ttl');
            $table->string('pegawai_pendidikan')->comment('Pendidikan Terakhir');
            $table->string('pegawai_alamat');
            $table->date('pegawai_tmt');
            $table->date('pegawai_tat')->nullable();
            $table->string('profesi')->comment('Perawat/Bidan/Petugas Kasir/dll')->nullable();
            $table->longText('deskripsi')->nullable();

            $table->boolean('progress')->comment('0=pengajuan;1=diverifikasi;2=ditolak');
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
