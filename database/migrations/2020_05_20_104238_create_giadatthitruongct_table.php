<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiadatthitruongctTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giadatthitruongct', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahs')->nullable();
            $table->string('loaidat')->nullable();
            $table->string('khuvuc')->nullable();
            $table->string('hdban')->nullable();
            $table->string('tenkhudat')->nullable();
            $table->string('diachi')->nullable();
            $table->string('soqdban')->nullable();
            $table->date('thoigianban')->nullable();
            $table->string('soqdgiakd')->nullable();
            $table->date('thoigiangiakd')->nullable();
            $table->double('dientichdat')->default(0);
            $table->double('dongiadat')->default(0);
            $table->double('giatridat')->default(0);
            $table->double('dientichts')->default(0);
            $table->double('dongiats')->default(0);
            $table->double('giatrits')->default(0);
            $table->double('tonggiatri')->default(0);
            $table->double('giadaugia')->default(0);
            $table->double('giathitruong')->default(0);
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
        Schema::dropIfExists('giadatthitruongct');
    }
}
