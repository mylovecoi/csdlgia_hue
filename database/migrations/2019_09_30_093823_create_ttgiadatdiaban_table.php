<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTtgiadatdiabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ttgiadatdiaban', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('mahs')->nullable();
            $table->string('soqd')->unique();
            $table->date('ngayqd_banhanh')->nullable();
            $table->date('ngayqd_apdung')->nullable();
            $table->string('mota')->nullable();
            $table->string('ipf1')->nullable();
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
        Schema::dropIfExists('ttgiadatdiaban');
    }
}
