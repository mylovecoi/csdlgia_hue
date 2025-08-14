<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThoigiantruyenToGiahhdvcndmTable extends Migration
{
    public function up()
    {
        Schema::table('giahhdvcndm', function (Blueprint $table) {
            $table->date('thoigiantruyen')->nullable();
        });
    }

    public function down()
    {
        Schema::table('giahhdvcndm', function (Blueprint $table) {
            $table->dropColumn('thoigiantruyen');
        });
    }
}
