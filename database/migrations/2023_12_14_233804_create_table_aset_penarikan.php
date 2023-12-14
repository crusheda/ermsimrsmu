<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAsetPenarikan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aset_penarikan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user_penarikan')->nullable();
            $table->bigInteger('id_aset')->nullable();
            $table->dateTime('tgl_penarikan')->nullable();
            $table->integer('kondisi_penarikan')->nullable();
            $table->longText('ket_penarikan')->nullable();

                $table->string('title_penarikan', 200)->nullable();
                $table->string('filename_penarikan', 200)->nullable();

            $table->integer('status_penarikan')->nullable();
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
        Schema::dropIfExists('aset_penarikan');
    }
}
