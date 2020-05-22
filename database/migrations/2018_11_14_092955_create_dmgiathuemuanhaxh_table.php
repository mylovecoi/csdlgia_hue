<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDmgiathuemuanhaxhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmnhaxh', function (Blueprint $table) {
            $table->increments('id');
            $table->string('maso')->unique();
            $table->string('phanloai')->nullable();
            $table->string('tennha')->nullable();
            $table->string('diachi')->nullable();
            $table->string('donviql')->nullable();
            $table->date('thoigian')->nullable();
            $table->double('dientich')->default(0);
            $table->string('hientrang')->nullable()->default('SUDUNG');
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
        Schema::dropIfExists('dmnhaxh');
    }
}
