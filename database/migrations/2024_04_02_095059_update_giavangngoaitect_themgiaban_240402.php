<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGiavangngoaitectThemgiaban240402 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('giavangngoaitect', function (Blueprint $table) {            
            $table->double('giabanlk')->default(0);            
            $table->double('giaban')->default(0);           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('giavangngoaitect', function (Blueprint $table) {            
            $table->dropColumn('giabanlk'); 
            $table->dropColumn('giaban'); 
        });
    }
}
