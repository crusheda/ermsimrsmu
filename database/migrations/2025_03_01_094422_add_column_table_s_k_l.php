<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTableSKL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pelayanan_skl', function (Blueprint $table) {
            $table->integer('nik_ayah')->after('hari');
            $table->integer('nik_ibu')->after('hari');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pelayanan_skl', function (Blueprint $table) {
            $table->dropColumn('nik_ibu');
            $table->dropColumn('nik_ayah');
        });
    }
}
