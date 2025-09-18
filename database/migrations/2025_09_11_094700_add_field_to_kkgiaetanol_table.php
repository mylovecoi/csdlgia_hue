<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToKkgiaetanolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kkgiaetanol', function (Blueprint $table) {
            $table->string('truyendulieu')->nullable();
            $table->date('thoigiantruyen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kkgiaetanol', function (Blueprint $table) {
            $table->dropColumn('truyendulieu');
            $table->dropColumn('thoigiantruyen');
        });
    }
}
