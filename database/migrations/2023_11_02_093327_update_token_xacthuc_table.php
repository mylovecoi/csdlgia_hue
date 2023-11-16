<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTokenXacthucTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_configs', function (Blueprint $table) {            
            $table->string('token_xacthuc')->nullable();//        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('general_configs', function (Blueprint $table) {            
            $table->dropColumn('token_xacthuc');
        });
    }
}
