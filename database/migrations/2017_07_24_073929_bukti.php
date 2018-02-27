<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bukti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukti', function (Blueprint $table) {
            $table->increments('id_bukti');
            $table->integer('nim');
            $table->string('bukti');
            $table->string('jenis_sertifikasi',10);
            $table->integer('pengambilan_ke');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bukti');
    }
}
