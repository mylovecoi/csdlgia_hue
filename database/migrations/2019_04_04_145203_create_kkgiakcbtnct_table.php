<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKkgiakcbtnctTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkgiakcbtnct', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahs')->nullable();
            $table->string('maxa')->nullable();
            $table->string('madv')->nullable();
            $table->text('tendvcu')->nullable();
            $table->string('qccl')->nullable();
            $table->string('dvt')->nullable();
            $table->double('gialk')->default(0);
            $table->double('giakk')->default(0);
            $table->string('ghichu')->nullable();
            $table->string('trangthai')->nullable();
            $table->string('thuevat')->nullable();
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
        Schema::dropIfExists('kkgiakcbtnct');
    }
}
