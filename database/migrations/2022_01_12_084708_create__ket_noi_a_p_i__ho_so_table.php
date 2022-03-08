<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKetNoiAPIHoSoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('KetNoiAPI_HoSo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('maso')->nullable();//Mã chức năng
            $table->string('tentruong')->nullable();
            $table->string('tendong')->nullable();
            $table->text('mota')->nullable();
            $table->string('kieudulieu')->nullable();
            $table->string('dinhdang')->nullable();
            $table->string('dodai')->nullable();
            $table->boolean('batbuoc')->nullable();
            $table->string('macdinh')->nullable();
            $table->integer('stt')->default(1);
            $table->text('ghichu')->nullable();
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
        Schema::dropIfExists('KetNoiAPI_HoSo');
    }
}
