<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiacuocvanchuyenctTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giacuocvanchuyenct', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahs')->nullable();
            $table->string('tencuoc')->nullable();
            $table->double('tukm')->default(0);//tên đường, phố, ...
            $table->double('denkm')->default(0);
            $table->string('bachh')->nullable();
            $table->string('phanloai')->nullable();

            $table->double('giavc1',10,2)->default(0);
            $table->double('giavc2',10,2)->default(0);
            $table->double('giavc3',10,2)->default(0);
            $table->double('giavc4',10,2)->default(0);
            $table->double('giavc5',10,2)->default(0);
            $table->text('gc')->nullable();
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
        Schema::dropIfExists('giacuocvanchuyenct');
    }
}
