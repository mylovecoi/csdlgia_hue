<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKkgiadaxaydungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkgiadaxaydung', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahs')->unique();

            $table->string('madiaban')->nullable(30);
            $table->date('ngaynhap')->nullable();
            $table->date('ngayhieuluc')->nullable();
            $table->string('socv')->nullable();
            $table->string('socvlk')->nullable();
            $table->string('ngaycvlk')->nullable();
            $table->text('ytcauthanhgia')->nullable();
            $table->text('thydggadgia')->nullable();
            $table->text('ttnguoinop')->nullable();

            $table->string('plhs')->nullable();
            $table->string('thoihan')->nullable();
            $table->string('dvt')->nullable();
            $table->string('congbo')->nullable();
            $table->text('lichsu')->nullable();
            $table->text('ghichu')->nullable();

            //Thông tin hồ sơ khi khởi tạo (level lấy theo thông tin đơn vị)
            $table->string('macqcq')->nullable(20);
            $table->string('madv')->nullable(20);
            $table->date('ngaynhan')->nullable();
            $table->string('sohsnhan')->nullable(20);
            $table->string('nguoichuyen',100)->nullable();
            $table->dateTime('ngaychuyen')->nullable();
            $table->text('lydo')->nullable();
            $table->string('trangthai')->nullable(20);
            //Thông tin Hô sơ khi gửi đơn vị cấp trên (Cấp H, T tùy theo level đơn vị khởi tạo)
            $table->string('macqcq_h')->nullable(20);
            $table->string('madv_h')->nullable(20);
            $table->date('ngaynhan_h')->nullable();
            $table->string('sohsnhan_h')->nullable(20);
            $table->string('nguoichuyen_h',100)->nullable();
            $table->dateTime('ngaychuyen_h')->nullable();
            $table->text('lydo_h')->nullable();
            $table->string('trangthai_h')->nullable(20);
            //Thông tin Hô sơ khi gửi đơn vị cấp trên (Cấp H, T tùy theo level đơn vị khởi tạo)
            $table->string('macqcq_t')->nullable(20);
            $table->string('madv_t')->nullable(20);
            $table->date('ngaynhan_t')->nullable();
            $table->string('sohsnhan_t')->nullable(20);
            $table->string('nguoichuyen_t',100)->nullable();
            $table->dateTime('ngaychuyen_t')->nullable();
            $table->text('lydo_t')->nullable();
            $table->string('trangthai_t')->nullable(20);
            //Thông tin Hô sơ khi gửi đơn vị cấp trên (Cấp H, T tùy theo level đơn vị khởi tạo)
            $table->string('macqcq_ad')->nullable(20);
            $table->string('madv_ad')->nullable(20);
            $table->date('ngaynhan_ad')->nullable();
            $table->string('sohsnhan_ad')->nullable(20);
            $table->string('nguoichuyen_ad',100)->nullable();
            $table->dateTime('ngaychuyen_ad')->nullable();
            $table->text('lydo_ad')->nullable();
            $table->string('trangthai_ad')->nullable(20);
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
        Schema::dropIfExists('kkgiadaxaydung');
    }
}
