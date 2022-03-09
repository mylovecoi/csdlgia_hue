<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChisogiatieudungQuyenSoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chisogiatieudung_QuyenSo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('masodanhmuc')->nullable();
            $table->string('masohanghoa')->nullable();
            $table->string('namapdung')->nullable();
            $table->double('quyensonongthon')->nullable();
            $table->double('quyensothanhthi')->nullable();
            $table->double('quyensotoantinh')->nullable();
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
        Schema::dropIfExists('chisogiatieudung_QuyenSo');
    }
}
