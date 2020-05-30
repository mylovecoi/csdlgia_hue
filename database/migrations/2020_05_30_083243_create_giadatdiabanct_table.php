<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiadatdiabanctTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giadatdiabanct', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahs')->nullable();
            $table->string('madiaban')->nullable();
            $table->string('maxp')->nullable();
            $table->string('maloaidat')->nullable();
            $table->string('khuvuc')->nullable();//tên đường, phố, ...
            $table->text('diemdau')->nullable();
            $table->text('diemcuoi')->nullable();
            $table->text('loaiduong')->nullable();
            $table->text('mota')->nullable();
            $table->string('mdsd')->nullable();
            $table->decimal('giavt1',10,2)->default(0);
            $table->decimal('giavt2',10,2)->default(0);
            $table->decimal('giavt3',10,2)->default(0);
            $table->decimal('giavt4',10,2)->default(0);
            $table->decimal('giavt5',10,2)->default(0);
            $table->double('hesok')->default(1);
            $table->double('sapxep')->default(0);
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
        Schema::dropIfExists('giadatdiabanct');
    }
}
