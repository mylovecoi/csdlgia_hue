<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToGiadvdtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dmgiadvgddt', function (Blueprint $table) {
            $table->string('truyendulieu')->nullable();
            $table->date('thoigiantruyen')->nullable();
        });

        Schema::table('giadvgddt', function (Blueprint $table) {
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
        Schema::table('dmgiadvgddt', function (Blueprint $table) {
            $table->dropColumn('truyendulieu');
            $table->dropColumn('thoigiantruyen');
        });

        Schema::table('giadvgddt', function (Blueprint $table) {
            $table->dropColumn('truyendulieu');
            $table->dropColumn('thoigiantruyen');
        });
    }
}
