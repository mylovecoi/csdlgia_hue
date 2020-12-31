<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiarungctTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giarungct', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahs')->nullable();
            $table->string('manhom')->nullable();
            $table->string('phanloai')->nullable();
            $table->text('noidung')->nullable();
            $table->string('dvt')->nullable(25);
            $table->double('dientich')->nullable();
            $table->double('dientichsd')->nullable();
            $table->double('giatri')->nullable();
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
        Schema::dropIfExists('giarungct');
    }
}
