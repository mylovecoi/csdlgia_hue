<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiathuemuanhaxhctTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giathuemuanhaxhct', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahs')->nullable();
            $table->text('maso')->nullable();
            $table->text('phanloai')->nullable()->default('THUENHA');
            $table->string('dvt',30)->nullable();
            $table->double('dongia')->default(0);
            $table->double('dongiathue')->default(0);
            $table->date('tungay')->nullable();
            $table->date('denngay')->nullable();
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
        Schema::dropIfExists('giathuemuanhaxhct');
    }
}
