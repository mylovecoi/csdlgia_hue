<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiaspdvcutheNhomdmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giaspdvcuthe_nhomdm', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('manhom')->nullable();
            $table->string('mota')->nullable();
            $table->string('theodoi')->nullable();
            $table->date('apdungtungay')->nullable();
            $table->date('apdungdenngay')->nullable();
            $table->string('truyendulieu')->nullable();
            $table->date('thoigiantruyen')->nullable();
            $table->string('ghichu')->nullable();
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
        Schema::dropIfExists('giaspdvcuthe_nhomdm');
    }
}
