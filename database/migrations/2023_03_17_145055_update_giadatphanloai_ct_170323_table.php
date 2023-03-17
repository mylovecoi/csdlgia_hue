<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGiadatphanloaiCt170323Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('giadatphanloai_ct', function (Blueprint $table) {            
            $table->string('diagioitu')->nullable();
            $table->string('diagioiden')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('giadatphanloai_ct', function (Blueprint $table) {
            $table->dropColumn('diagioitu');
            $table->dropColumn('diagioiden');
        });
    }
}
