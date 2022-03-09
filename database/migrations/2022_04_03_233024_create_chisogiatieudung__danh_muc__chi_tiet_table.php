<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChisogiatieudungDanhMucChiTietTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chisogiatieudung_DanhMuc_ChiTiet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('masodanhmuc')->nullable();
            $table->string('masonhomhanghoa')->nullable();
            $table->string('masohanghoa')->nullable();
            $table->string('tenhanghoa')->nullable();
            $table->string('masogoc')->nullable();
            $table->double('stt')->default(1);
            $table->string('stt_bc')->nullable();
            $table->string('dvt')->nullable();
            $table->double('quyensogoc')->nullable();
            $table->boolean('baocao')->nullable();
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
        Schema::dropIfExists('chisogiatieudung_DanhMuc_ChiTiet');
    }
}
