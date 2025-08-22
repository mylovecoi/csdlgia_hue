<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToPhilephiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('philephi', function (Blueprint $table) {
            $table->string('truyendulieu')->nullable();
            $table->date('thoigiantruyen')->nullable();
        });

        Schema::table('dmphilephi', function (Blueprint $table) {
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
        Schema::table('philephi', function (Blueprint $table) {
            $table->dropColumn('truyendulieu');
            $table->dropColumn('thoigiantruyen');
        });

        Schema::table('dmphilephi', function (Blueprint $table) {
            $table->dropColumn('truyendulieu');
            $table->dropColumn('thoigiantruyen');
        });
    }
}
