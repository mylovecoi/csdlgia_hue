<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiadvgddtctTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giadvgddtct', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahs')->nullable();
            $table->string('maspdv')->nullable();
            $table->text('mota')->nullable();
            $table->string('namapdung1')->nullable();
            $table->double('giathanhthi1')->default(0);
            $table->double('gianongthon1')->default(0);
            $table->double('giamiennui1')->default(0);
            $table->string('namapdung2')->nullable();
            $table->double('giathanhthi2')->default(0);
            $table->double('gianongthon2')->default(0);
            $table->double('giamiennui2')->default(0);
            $table->string('namapdung3')->nullable();
            $table->double('giathanhthi3')->default(0);
            $table->double('gianongthon3')->default(0);
            $table->double('giamiennui3')->default(0);
            $table->string('namapdung4')->nullable();
            $table->double('giathanhthi4')->default(0);
            $table->double('gianongthon4')->default(0);
            $table->double('giamiennui4')->default(0);
            $table->string('namapdung5')->nullable();
            $table->double('giathanhthi5')->default(0);
            $table->double('gianongthon5')->default(0);
            $table->double('giamiennui5')->default(0);
            $table->string('gc')->nullable();
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
        Schema::dropIfExists('giadvgddtct');
    }
}
