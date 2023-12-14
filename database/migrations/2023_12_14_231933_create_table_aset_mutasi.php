<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAsetMutasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aset_mutasi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user_mutasi')->nullable();
            $table->bigInteger('id_aset')->nullable();
            $table->integer('id_ruangan_mutasi')->nullable();
            $table->integer('kondisi_mutasi')->nullable();
            $table->longText('ket_mutasi')->nullable();

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
        Schema::dropIfExists('aset_mutasi');
    }
}
