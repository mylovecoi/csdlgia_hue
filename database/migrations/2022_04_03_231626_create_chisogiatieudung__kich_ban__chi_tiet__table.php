<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChisogiatieudungKichBanChiTietTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chisogiatieudung_KichBan_ChiTiet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('masokichban')->nullable();
            $table->string('masohanghoa')->nullable();
            $table->string('phanloai')->nullable();
            $table->double('ketqua')->nullable();
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
        Schema::dropIfExists('chisogiatieudung_KichBan_ChiTiet');
    }
}
