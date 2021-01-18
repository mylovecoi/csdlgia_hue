<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiarungctTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giarungct', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahs')->nullable();
            $table->string('manhom')->nullable();
            $table->string('phanloai')->nullable();
            $table->text('noidung')->nullable();
            $table->string('dvt')->nullable(25);
            $table->double('dientich')->default(0);
            $table->double('dientichsd')->default(0);
            $table->double('giatri')->default(0);
            $table->double('giakhoidiem')->default(0);
            $table->double('dongia')->default(0);
            $table->string('dvthue')->nullable();
            $table->string('diachi')->nullable();
            $table->string('soqdpd')->nullable();
            $table->date('thoigianpd')->nullable();
            $table->string('soqdgkd')->nullable();
            $table->date('thoigiangkd')->nullable();
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
        Schema::dropIfExists('giarungct');
    }
}
