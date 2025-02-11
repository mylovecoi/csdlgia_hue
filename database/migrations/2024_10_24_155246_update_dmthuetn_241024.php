<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDmthuetn241024 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dmthuetn', function (Blueprint $table) {
            $table->string('cap6')->nullable();
            $table->string('maso')->nullable();
            $table->string('maso_goc')->nullable();
            $table->string('truyendulieu')->nullable();
            $table->date('thoigiantruyen')->nullable();
        });
        Schema::table('thuetainguyen', function (Blueprint $table) {          
            $table->string('truyendulieu')->nullable();
            $table->date('thoigiantruyen')->nullable();
        });
        Schema::table('thuetainguyenct', function (Blueprint $table) {          
            $table->string('maso')->nullable();
            $table->string('maso_goc')->nullable();
            $table->string('sapxep')->nullable();
        });
        Schema::table('giaspdvcuthe', function (Blueprint $table) {          
            $table->string('truyendulieu')->nullable();
            $table->date('thoigiantruyen')->nullable();
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dmthuetn', function (Blueprint $table) {      
            $table->dropColumn('cap6');       
            $table->dropColumn('maso'); 
            $table->dropColumn('maso_goc'); 
            $table->dropColumn('truyendulieu');
            $table->dropColumn('thoigiantruyen');
        });
        Schema::table('thuetainguyen', function (Blueprint $table) {
            $table->dropColumn('truyendulieu');
            $table->dropColumn('thoigiantruyen');
        });
        Schema::table('thuetainguyenct', function (Blueprint $table) {
            $table->dropColumn('maso');
            $table->dropColumn('maso_goc');
            $table->dropColumn('sapxep');
        });
        Schema::table('giaspdvcuthe', function (Blueprint $table) {
            $table->dropColumn('truyendulieu');
            $table->dropColumn('thoigiantruyen');
        });
    }
}
