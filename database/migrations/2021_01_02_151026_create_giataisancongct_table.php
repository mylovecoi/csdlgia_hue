<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiataisancongctTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giataisancongct', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahs')->nullable();
            $table->string('mataisan')->nullable();
            $table->string('tentaisan')->nullable();
            $table->string('dacdiem')->nullable();
            $table->double('giathue')->default(0);
            $table->double('giaban')->default(0);
            $table->double('giapheduyet')->default(0);
            $table->double('giaconlai')->default(0);
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
        Schema::dropIfExists('giataisancongct');
    }
}
