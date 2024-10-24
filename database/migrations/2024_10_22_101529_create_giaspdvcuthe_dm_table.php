<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiaspdvcutheDmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giaspdvcuthe_dm', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('manhom')->nullable();
            $table->string('maso')->nullable();
            $table->string('tenhhdv')->nullable();
            $table->string('dacdiemkt')->nullable();
            $table->string('dvt')->nullable();
            $table->string('hienthi')->nullable();
            $table->string('theodoi')->nullable();
            $table->double('stt')->default(0);
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
        Schema::dropIfExists('giaspdvcuthe_dm');
    }
}
