<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToPengajar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengajar', function (Blueprint $table) {
            $table->tinyInteger('mta');
            $table->tinyInteger('mos');
            $table->tinyInteger('scm');
            $table->tinyInteger('mtcna');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengajar', function (Blueprint $table) {
            $table->dropcolumn('mta');
            $table->dropcolumn('mos');
            $table->dropcolumn('scm');
            $table->dropcolumn('mtcna');
        });
    }
}
