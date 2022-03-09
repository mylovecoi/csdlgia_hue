<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChisogiatieudungDanhMucTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chisogiatieudung_DanhMuc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('masodanhmuc')->unique();
            $table->string('noidung')->nullable();
            $table->date('tungay')->nullable();
            $table->date('denngay')->nullable();
            $table->string('trangthai')->nullable();
            $table->string('ghichu')->nullable();
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
        Schema::dropIfExists('chisogiatieudung_DanhMuc');
    }
}
