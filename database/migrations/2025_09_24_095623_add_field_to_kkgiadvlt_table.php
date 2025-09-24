<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToKkgiadvltTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kkgiadvlt', function (Blueprint $table) {
            $table->string('truyendulieu')->nullable();
            $table->date('thoigiantruyen')->nullable();
        });

        Schema::table('kkgiadvch', function (Blueprint $table) {
            $table->string('truyendulieu')->nullable();
            $table->date('thoigiantruyen')->nullable();
        });

        Schema::table('kkgiahplx', function (Blueprint $table) {
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
        Schema::table('kkgiadvlt', function (Blueprint $table) {
            $table->dropColumn('truyendulieu');
            $table->dropColumn('thoigiantruyen');
        });

        Schema::table('kkgiadvch', function (Blueprint $table) {
            $table->dropColumn('truyendulieu');
            $table->dropColumn('thoigiantruyen');
        });

        Schema::table('kkgiahplx', function (Blueprint $table) {
            $table->dropColumn('truyendulieu');
            $table->dropColumn('thoigiantruyen');
        });
    }
}
