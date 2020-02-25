<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiaspdvcidmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giaspdvcidm', function (Blueprint $table) {
            $table->increments('id');
            $table->string('maspdv')->nullable();
            $table->string('tenspdv')->nullable();
            $table->string('dientich')->nullable();
            $table->string('dvt')->nullable();
            $table->string('mota')->nullable();
            $table->string('phanloai')->nullable();
            $table->string('hientrang')->nullable();
            $table->string('madiaban')->nullable();
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
        Schema::dropIfExists('giaspdvcidm');
    }
}
