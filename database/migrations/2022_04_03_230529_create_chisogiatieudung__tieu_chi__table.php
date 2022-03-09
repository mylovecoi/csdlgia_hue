<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChisogiatieudungTieuChiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chisogiatieudung_TieuChi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('masohanghoa_tieuchi')->nullable();
            $table->string('masohanghoa_ketqua')->nullable();
            $table->string('phanloai')->nullable();
            $table->double('tu')->nullable();
            $table->double('den')->nullable();
            $table->double('ketqua')->nullable();
            $table->string('mota')->nullable();
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
        Schema::dropIfExists('chisogiatieudung_TieuChi');
    }
}
