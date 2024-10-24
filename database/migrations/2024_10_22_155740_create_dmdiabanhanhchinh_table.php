<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDmdiabanhanhchinhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmtinhhuyenxa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('madiaban')->nullable();
            $table->string('tendiaban')->nullable();
            $table->string('capdo')->nullable();//T;H;X
            $table->string('theodoi')->nullable();
            $table->date('ngaydung')->nullable();
            $table->string('madiaban_goc')->nullable();           
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
        Schema::dropIfExists('dmtinhhuyenxa');
    }
}
