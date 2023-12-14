<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAsetPengembalian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aset_pengembalian', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user_pengembalian')->nullable();
            $table->bigInteger('id_aset')->nullable();
            $table->dateTime('tgl_pengembalian')->nullable();
            $table->integer('pengantar_pengembalian')->nullable();
            $table->integer('penerima_pengembalian')->nullable();
            $table->integer('kondisi_pengembalian')->nullable();
            $table->longText('ket_pengembalian')->nullable();

                $table->string('title_pengembalian')->nullable();
                $table->string('filename_pengembalian')->nullable();

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
        Schema::dropIfExists('aset_pengembalian');
    }
}
