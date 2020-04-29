<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDsvanphongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsvanphong', function (Blueprint $table) {
            $table->increments('id');
            $table->string('maso')->unique();
            $table->string('vanphong')->nullable();
            $table->string('hoten')->nullable();
            $table->string('chucvu')->nullable();
            $table->string('sdt')->nullable();
            $table->string('skype')->nullable();
            $table->string('facebook')->nullable();
            $table->integer('stt')->default(99);
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
        Schema::dropIfExists('dsvanphong');
    }
}
