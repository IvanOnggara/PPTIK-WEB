<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StatusMahasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_mahasiswa', function (Blueprint $table) {
            $table->integer('nim');
            $table->string('status_mta');
            $table->string('status_mos');
            $table->string('status_mtcna');
            $table->string('status_scm');
            
            $table->primary('nim');
            
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
        Schema::drop('status_mahasiswa');
    }
}
