<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiathuetscongctdfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giathuetscongctdf', function (Blueprint $table) {
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
        Schema::dropIfExists('giathuetscongctdf');
    }
}
