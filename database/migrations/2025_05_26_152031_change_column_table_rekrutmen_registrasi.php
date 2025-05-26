<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnTableRekrutmenRegistrasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rekrutmen_registrasi', function (Blueprint $table) {
            $table->string('tempat_lahir')->change(); // ubah tipe kolom 'nama'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rekrutmen_registrasi', function (Blueprint $table) {
            $table->string('tempat_lahir')->change(); // kembalikan ke tipe semula jika rollback
        });
    }
}
