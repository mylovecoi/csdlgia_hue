<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVanbanqlnnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vanbanqlnn', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahs')->nullable();
            $table->string('kyhieuvb')->nullable();
            $table->string('dvbanhanh')->nullable();
            $table->string('loaivb')->nullable();
            $table->date('ngaybanhanh')->nullable();
            $table->date('ngayapdung')->nullable();
            $table->text('tieude')->nullable();
            $table->text('ghichu')->nullable();
            $table->string('phanloai')->nullable();
            $table->string('ipt1')->nullable();
            $table->string('ipf1')->nullable();

            $table->string('ipt2')->nullable();
            $table->string('ipf2')->nullable();

            $table->string('ipt3')->nullable();
            $table->string('ipf3')->nullable();

            $table->string('ipt4')->nullable();
            $table->string('ipf4')->nullable();

            $table->string('ipt5')->nullable();
            $table->string('ipf5')->nullable();
            $table->string('madv')->nullable(30);
            $table->string('trangthai')->nullable(20);
            $table->date('thoidiem')->nullable();
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
        Schema::dropIfExists('vanbanqlnn');
    }
}
