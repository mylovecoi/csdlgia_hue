<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTruyendulieuAndThoigiantruyenToGiahhdvcnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('giahhdvcn', function (Blueprint $table) {
            $table->string('truyendulieu')->nullable();
            $table->string('thoigiantruyen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('giahhdvcn', function (Blueprint $table) {
            $table->dropColumn('truyendulieu'); // Xóa cột khi rollback
            $table->dropColumn('thoigiantruyen'); // Xóa cột khi rollback
        });
    }
}
