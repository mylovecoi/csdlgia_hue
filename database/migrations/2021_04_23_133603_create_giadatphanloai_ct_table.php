<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiadatphanloaiCtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giadatphanloai_ct', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahs')->nullable();
            $table->string('maloaidat')->nullable();
            $table->string('khuvuc')->nullable();//tên đường, phố, ...
            $table->integer('vitri')->default(1);//vị trí đất
            $table->double('banggiadat')->default(0);
            $table->double('giacuthe')->default(0);
            $table->double('hesodc')->default(1);
            $table->double('sapxep')->default(0);
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
        Schema::dropIfExists('giadatphanloai_ct');
    }
}
