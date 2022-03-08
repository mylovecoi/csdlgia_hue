<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDMHinhThucThanhToanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DMHinhThucThanhToan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahinhthucthanhtoan')->nullable();
            $table->string('tenhinhthucthanhtoan')->nullable();
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
        Schema::dropIfExists('DMHinhThucThanhToan');
    }
}
