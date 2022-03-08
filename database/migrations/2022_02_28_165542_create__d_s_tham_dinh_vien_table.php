<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDSThamDinhVienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DSThamDinhVien', function (Blueprint $table) {
            $table->increments('id');
            $table->string('GIAY_CN_DU_DK_DKKD', 20)->nullable();
            $table->string('TEN_TIENG_VIET')->nullable();
            $table->string('HO_TEN')->nullable();
            $table->date('NGAY_SINH')->nullable();
            $table->string('GIOI_TINH')->default(0);
            $table->string('CMT_HO_CHIEU')->nullable();
            $table->date('NGAY_CAP_CMT')->nullable();
            $table->string('NOI_CAP_CMT')->nullable();
            $table->string('NGUYEN_QUAN')->nullable();
            $table->string('TINH_THANH')->nullable();
            $table->string('DIA_CHI_THUONG_TRU')->nullable();
            $table->string('DIA_CHI_TAM_TRU')->nullable();
            $table->string('DIEN_THOAI')->nullable();
            $table->string('EMAIL')->nullable();
            $table->string('SO_THE_TDV')->nullable();
            $table->date('NGAY_CAP_THE_TDV')->nullable();
            $table->boolean('LA_NGUOI_DAI_DIEN_PL')->nullable();
            $table->boolean('LA_LANH_DAO_DN')->nullable();
            $table->string('ghichu')->nullable();
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
        Schema::dropIfExists('DSThamDinhVien');
    }
}
