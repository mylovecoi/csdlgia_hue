<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiavangngoaitedmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giavangngoaitedm', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahhdv')->nullable();
            $table->string('tenhhdv')->nullable();
            $table->string('dacdiemkt')->nullable();
            $table->string('xuatxu')->nullable();
            $table->string('dvt')->nullable();
            $table->double('gia')->nullable();
            $table->string('loaigia')->nullable();
            $table->string('theodoi')->nullable();
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
        Schema::dropIfExists('giavangngoaitedm');
    }
}
