<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTruyendulieuToGiahhdvcndmTable extends Migration
{
    public function up()
    {
        Schema::table('giahhdvcndm', function (Blueprint $table) {
            $table->string('truyendulieu')->nullable();
        });
    }

    public function down()
    {
        Schema::table('giahhdvcndm', function (Blueprint $table) {
            $table->dropColumn('truyendulieu');
        });
    }
}
