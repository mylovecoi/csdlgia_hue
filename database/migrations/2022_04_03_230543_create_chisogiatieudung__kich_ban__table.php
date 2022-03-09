<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChisogiatieudungKichBanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chisogiatieudung_KichBan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('masokichban')->unique();
            $table->date('ngaybaocao')->nullable();
            $table->string('mahs_goc')->nullable();
            $table->string('masodubao')->nullable();
            $table->string('noidung')->nullable();
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
        Schema::dropIfExists('chisogiatieudung_KichBan');
    }
}
