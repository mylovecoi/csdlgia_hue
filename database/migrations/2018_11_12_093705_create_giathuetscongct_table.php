<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiathuetscongctTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giathuetscongct', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mataisan')->nullable();
            $table->string('tents')->nullable();
            $table->string('dvt')->nullable();
            $table->string('dongiathue')->nullable();
            $table->string('dvthue')->nullable();
            $table->string('hdthue')->nullable();
            $table->string('ththue')->nullable();
            $table->string('sotienthuenam')->nullable();
            $table->string('mahs')->nullable();
            $table->string('diachi')->nullable();
            $table->string('soqdpd')->nullable();
            $table->date('thoigianpd')->nullable();
            $table->string('soqddg')->nullable();
            $table->date('thoigiandg')->nullable();
            $table->date('thuetungay')->nullable();
            $table->date('thuedenngay')->nullable();
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
        Schema::dropIfExists('giathuetscongct');
    }
}
