<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDsxaphuongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsxaphuong', function (Blueprint $table) {
            $table->increments('id');
            $table->string('maxp')->unique();
            $table->string('tenxp')->nullable();
            $table->string('madiaban')->nullable();
            $table->string('level')->nullable();//X
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
        Schema::dropIfExists('dsxaphuong');
    }
}
