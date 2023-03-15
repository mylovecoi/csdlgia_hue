<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGiathuedatmatnuoc1503Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('giathuedatnuoc', function (Blueprint $table) {
            $table->string('mota')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('giathuedatnuoc', function (Blueprint $table) {            
            $table->dropColumn('mota');
        });
    }
}
