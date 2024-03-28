<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateKetnoicsdlqg20240217Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //update đơn vị tính
        Schema::table('dmdvt', function (Blueprint $table) {            
            $table->string('madvt')->nullable();            
        });
        //thêm các trường trong hệ thống chung
        Schema::table('general_configs', function (Blueprint $table) {            
            $table->string('madiaban')->nullable();
            $table->string('madonvithuthap')->nullable();          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dmdvt', function (Blueprint $table) {            
            $table->dropColumn('madvt');           
        });

        
        Schema::table('general_configs', function (Blueprint $table) {            
            $table->dropColumn('madiaban');           
            $table->dropColumn('madonvithuthap');           
        });
    }
}
