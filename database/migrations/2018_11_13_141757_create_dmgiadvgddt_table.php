<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDmgiadvgddtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmgiadvgddt', function (Blueprint $table) {
            $table->increments('id');
            $table->string('maspdv')->unique();
            $table->string('tenspdv')->nullable();
            $table->string('phanloai')->nullable();
            $table->string('hientrang')->nullable();
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
        Schema::dropIfExists('dmgiadvgddt');
    }
}
