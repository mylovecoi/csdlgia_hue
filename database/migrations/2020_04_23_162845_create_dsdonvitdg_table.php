<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDsdonvitdgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsdonvitdg', function (Blueprint $table) {
            $table->increments('id');
            $table->string('maso')->unique();
            $table->string('tendv')->nullable();
            $table->string('diachi')->nullable();
            $table->string('nguoidaidien')->nullable();
            $table->string('chucvu')->nullable();
            $table->string('sothe')->nullable();
            $table->date('ngaycap')->nullable();
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
        Schema::dropIfExists('dsdonvitdg');
    }
}
