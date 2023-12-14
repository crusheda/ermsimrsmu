<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAsetPeminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aset_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user_peminjaman')->nullable();
            $table->bigInteger('id_aset')->nullable();
            $table->integer('id_ruangan_peminjaman')->nullable();
            $table->dateTime('tgl_peminjaman')->nullable();
            $table->date('rencana_tgl_pengembalian_peminjaman')->nullable();
            $table->integer('penanggungjawab_peminjaman')->nullable();
            $table->longText('kelengkapan_peminjaman')->nullable();
            $table->longText('ket_peminjaman')->nullable();

                $table->string('title_peminjaman')->nullable();
                $table->string('filename_peminjaman')->nullable();

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
        Schema::dropIfExists('aset_peminjaman');
    }
}
