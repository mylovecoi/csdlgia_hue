<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToGiaspdvciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('giaspdvci', function (Blueprint $table) {
            $table->string('truyendulieu')->nullable();
            $table->date('thoigiantruyen')->nullable();
        });

        Schema::table('giaspdvcidm', function (Blueprint $table) {
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
        Schema::table('giaspdvci', function (Blueprint $table) {
            $table->dropColumn('truyendulieu');
            $table->dropColumn('thoigiantruyen');
        });

        Schema::table('giaspdvcidm', function (Blueprint $table) {
            $table->dropColumn('truyendulieu');
            $table->dropColumn('thoigiantruyen');
        });
    }
}
