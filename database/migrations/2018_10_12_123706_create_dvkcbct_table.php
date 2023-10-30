<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDvkcbctTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {//chưa dùng
        Schema::create('dvkcbct', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahs')->nullable();
            $table->string('maspdv')->nullable();
            $table->string('dvt')->nullable();
            $table->double('giadv')->default(0);
            $table->double('giatoithieu')->default(0);
            $table->double('giatoida')->default(0);
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
        Schema::dropIfExists('dvkcbct');
    }
}
