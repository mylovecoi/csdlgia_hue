<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDmgiahhdvkDonviTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmgiahhdvk_donvi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('matt')->nullable();
            $table->string('manhom')->nullable();
            $table->string('mahhdv')->nullable();
            $table->string('tenhhdv')->nullable();
            $table->string('dacdiemkt')->nullable();
            $table->string('xuatxu')->nullable();
            $table->string('dvt')->nullable();
            $table->string('theodoi')->nullable();
            $table->string('madv')->nullable(20);
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
        Schema::dropIfExists('dmgiahhdvk_donvi');
    }
}
