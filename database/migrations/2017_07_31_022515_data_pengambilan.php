<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DataPengambilan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pengambilan', function (Blueprint $table) {
            $table->integer('nim');
            $table->string('mta');
            $table->string('mos');
            $table->string('mtcna');
            $table->string('scm');
            
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
        Schema::drop('data_pengambilan');
    }
}
