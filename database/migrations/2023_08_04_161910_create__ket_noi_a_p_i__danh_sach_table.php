<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKetNoiAPIDanhSachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('KetNoiAPI_DanhSach', function (Blueprint $table) {
            $table->increments('id');
            $table->string('maso')->nullable();//Mã chức năng
            //Link kết nối
            $table->string('linkTruyenGet')->nullable();
            $table->string('linkTruyenPost')->nullable();
            $table->string('linkTruyenPut')->nullable();
            //Link Xuất dữ liệu
            $table->string('linkDuLieuGet')->nullable();
            $table->string('linkDuLieuPost')->nullable();
            $table->string('linkDuLieuPut')->nullable();
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
        Schema::dropIfExists('KetNoiAPI_DanhSach');
    }
}
