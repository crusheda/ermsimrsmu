<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAsetPemeliharaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aset_pemeliharaan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user_pemeliharaan')->nullable();
            $table->bigInteger('id_aset')->nullable();
            $table->longText('hasil_pemeliharaan')->nullable();
            $table->longText('rekomendasi_pemeliharaan')->nullable();
            $table->integer('petugas_pemeliharaan')->nullable();
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
        Schema::dropIfExists('aset_pemeliharaan');
    }
}
