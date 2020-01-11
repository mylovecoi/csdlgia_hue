<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDanhmucchucnangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //cấp độ: 1: mức csdl: CSDL về mức giá HH-DV, CSDL thẩm định giá, ...
            //2: Định giá, Giá HH-DV khác, Giá lệ phí trước bạ
            //3: Giá đất, giá nước, ...
        Schema::create('danhmucchucnang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('maso')->unique();
            $table->integer('capdo')->default(9);
            $table->string('maso_goc')->nullable();
            $table->string('menu')->nullable();
            $table->text('mota')->nullable();
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
        Schema::dropIfExists('danhmucchucnang');
    }
}
