<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DataSertifikat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_sertifikat', function (Blueprint $table) {
            $table->string('id_sertifikat',20);
            $table->integer('nim');
            $table->string('jenis_sertifikasi',12);
            $table->primary('id_sertifikat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('data_sertifikat');
    }
}
