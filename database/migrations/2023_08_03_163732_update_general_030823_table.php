<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGeneral030823Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_configs', function (Blueprint $table) {            
            $table->string('phanloaiketnoi')->nullable();
            $table->string('matkhauketnoi')->nullable();
            $table->string('taikhoanketnoi')->nullable();
            $table->string('linkAPIXacthuc')->nullable();
            
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
            $table->dropColumn('phanloaiketnoi');
            $table->dropColumn('matkhauketnoi');
            $table->dropColumn('taikhoanketnoi');
            $table->dropColumn('linkAPIXacthuc');
        });
    }
}
