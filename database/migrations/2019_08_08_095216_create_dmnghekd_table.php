<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDmnghekdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmnghekd', function (Blueprint $table) {
            $table->increments('id');
            $table->string('manganh')->nullable();
            $table->string('manghe')->nullable();
            $table->string('tennghe')->nullable();
            $table->string('madv')->nullable();//trường hợp mỗi mặt hàng do một đơn vị chủ quản # nhau
            $table->string('theodoi')->nullable();
            $table->string('phanloai')->nullable();
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
        Schema::dropIfExists('dmnghekd');
    }
}
