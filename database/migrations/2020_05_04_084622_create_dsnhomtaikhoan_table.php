<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDsnhomtaikhoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsnhomtaikhoan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('maso')->unique();
            $table->string('mota')->nullable();
            $table->text('permission')->nullable();
            $table->boolean('macdinh')->default(0);
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
        Schema::dropIfExists('dsnhomtaikhoan');
    }
}
