<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiathuedatnuocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giathuedatnuoc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahs')->nullable();
            $table->string('madiaban')->nullable();
            $table->string('maxp')->nullable();
            $table->string('soqd')->nullable();
            $table->string('ghichu')->nullable();
            $table->text('lichsu')->nullable(); //Thao tác lịch sử hồ sơ theo dạng JSON
            $table->string('congbo')->nullable(25);
            //Thông tin hồ sơ khi khởi tạo (level lấy theo thông tin đơn vị)
            $table->date('thoidiem')->nullable();
            $table->string('macqcq')->nullable(20);
            $table->string('madv')->nullable(20);
            $table->string('lydo')->nullable();
            $table->string('thongtin')->nullable();
            $table->string('trangthai')->nullable();
//Thông tin Hô sơ khi gửi đơn vị cấp trên (Cấp H, T tùy theo level đơn vị khởi tạo)
            $table->date('thoidiem_h')->nullable();
            $table->string('macqcq_h')->nullable(20);
            $table->string('madv_h')->nullable(20);
            $table->string('lydo_h')->nullable();
            $table->string('thongtin_h')->nullable();
            $table->string('trangthai_h')->nullable();
//Thông tin Hô sơ khi gửi đơn vị cấp trên (Cấp T tùy theo level đơn vị khởi tạo)
            $table->date('thoidiem_t')->nullable();
            $table->string('macqcq_t')->nullable(20);
            $table->string('madv_t')->nullable(20);
            $table->string('lydo_t')->nullable();
            $table->string('thongtin_t')->nullable();
            $table->string('trangthai_t')->nullable();
//Thông tin Hồ sơ khi gửi đến đơn vị tổng hợp toàn Tỉnh
            $table->date('thoidiem_ad')->nullable();
            $table->string('macqcq_ad')->nullable(20);
            $table->string('madv_ad')->nullable(20);
            $table->string('lydo_ad')->nullable();
            $table->string('thongtin_ad')->nullable();
            $table->string('trangthai_ad')->nullable();
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
        Schema::dropIfExists('giathuedatnuoc');
    }
}
