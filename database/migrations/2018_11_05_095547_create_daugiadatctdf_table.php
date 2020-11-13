<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaugiadatctdfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daugiadatctdf', function (Blueprint $table) {
            $table->increments('id');
            $table->string('solo')->nullable();
            $table->string('sothua')->nullable();
            $table->string('sotobando')->nullable();
            $table->string('loaidat')->nullable();
            $table->string('khuvuc')->nullable();
            $table->string('dvt')->nullable();
            $table->string('mota')->nullable();
            $table->double('dientich')->default(0);
            $table->double('giakhoidiem')->default(0);
            $table->double('giadaugia')->default(0);
            $table->string('mahs')->nullable();
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
        Schema::dropIfExists('daugiadatctdf');
    }
}
