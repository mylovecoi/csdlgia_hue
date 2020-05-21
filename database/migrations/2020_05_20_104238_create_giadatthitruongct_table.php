<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiadatthitruongctTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giadatthitruongct', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahs')->nullable();
            $table->string('loaidat')->nullable();
            $table->string('khuvuc')->nullable();
            $table->string('mota')->nullable();
            $table->double('dientich')->default(0);
            $table->double('giaquydinh')->default(0);
            $table->double('giathitruong')->default(0);
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
        Schema::dropIfExists('giadatthitruongct');
    }
}
