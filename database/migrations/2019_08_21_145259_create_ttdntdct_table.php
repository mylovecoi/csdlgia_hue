<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTtdntdctTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ttdntdct', function (Blueprint $table) {
            $table->increments('id');
            $table->string('madv')->nullable();
            $table->string('manganh')->nullable();
            $table->string('manghe')->nullable();
            $table->string('mahuyen')->nullable();
            $table->string('trangthai')->nullable();
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
        Schema::dropIfExists('ttdntdct');
    }
}
