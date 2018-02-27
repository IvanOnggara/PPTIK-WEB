<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Jadwal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->increments('id_jadwal');
            $table->string('id_dosen');
            $table->string('jenis_sertifikasi');
            $table->string('id_kelas_1');
            $table->string('id_kelas_2');
            $table->string('id_kelas_3');
            $table->date('tanggal_1');
            $table->date('tanggal_2');
            $table->date('tanggal_3');
            $table->time('jam_awal_1');
            $table->time('jam_akhir_1');
            $table->time('jam_awal_2');
            $table->time('jam_akhir_2');
            $table->time('jam_awal_3');
            $table->time('jam_akhir_3');
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
        Schema::drop('jadwal');
    }
}

