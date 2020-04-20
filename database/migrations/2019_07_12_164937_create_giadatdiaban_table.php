<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiadatdiabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giadatdiaban', function (Blueprint $table) {
            $table->increments('id');
            $table->string('maso')->unique(); //lưu thay id -- để trong trường hợp cần lưu chi tiết thay đổi giá
            $table->string('madiaban')->nullable();
            $table->string('maxp')->nullable();
            $table->string('madv')->nullable(20);
            $table->string('soqd')->nullable();
            $table->string('nam')->nullable();

            $table->string('maloaidat')->nullable();
            $table->string('khuvuc')->nullable();//tên đường, phố, ...
            $table->text('diemdau')->nullable();
            $table->text('diemcuoi')->nullable();
            $table->text('loaiduong')->nullable();

            $table->text('mota')->nullable();
            $table->string('mdsd')->nullable();

            $table->double('giavt1')->default(0);
            $table->double('giavt2')->default(0);
            $table->double('giavt3')->default(0);
            $table->double('giavt4')->default(0);
            $table->double('giavt5')->default(0);
            $table->double('hesok')->default(1);

            $table->double('sapxep')->default(0);
            $table->string('trangthai')->nullable();
            $table->string('congbo')->nullable(25);
            $table->text('lichsu')->nullable(); //Thao tác lịch sử hồ sơ theo dạng JSON
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
        Schema::dropIfExists('giadatdiaban');
    }
}
