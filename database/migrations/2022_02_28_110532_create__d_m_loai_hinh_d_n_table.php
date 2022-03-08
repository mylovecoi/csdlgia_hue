<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDMLoaiHinhDNTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DMLoaiHinhDN', function (Blueprint $table) {
            $table->increments('id');
            $table->string('maloaihinhdn')->nullable();
            $table->string('tenloaihinhdn')->nullable();
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
        Schema::dropIfExists('DMLoaiHinhDN');
    }
}
