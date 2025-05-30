<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChisogiatieudungChiTietTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chisogiatieudung_ChiTiet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mahs')->nullable();
            $table->string('masonhomhanghoa')->nullable();
            $table->string('masohanghoa')->nullable();
            $table->string('tenhanghoa')->nullable();
            $table->string('masogoc')->nullable();
            $table->double('stt')->default(1);
            $table->string('stt_bc')->nullable();
            $table->string('dvt')->nullable();
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
        Schema::dropIfExists('chisogiatieudung_ChiTiet');
    }
}
