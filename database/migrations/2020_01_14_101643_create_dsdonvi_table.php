<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDsdonviTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsdonvi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('madiaban')->nullable();
            $table->string('maqhns')->nullable(50);
            $table->string('madv')->unique(50);
            $table->string('tendv')->nullable();
            $table->string('diachi')->nullable();
            $table->text('ttlienhe')->nullable();
            $table->string('emailql')->nullable(50);
            $table->string('emailqt')->nullable(50);
            $table->integer('songaylv')->default(3);
            $table->string('tendvhienthi')->nullable();
            $table->string('tendvcqhienthi')->nullable();
            $table->string('chucvuky')->nullable();
            $table->string('chucvukythay')->nullable();
            $table->string('nguoiky')->nullable();
            $table->string('diadanh')->nullable();
            $table->string('chucnang')->nullable();//Tổng hợp; Nhập liệu; Quản trị
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
        Schema::dropIfExists('dsdonvi');
    }
}
