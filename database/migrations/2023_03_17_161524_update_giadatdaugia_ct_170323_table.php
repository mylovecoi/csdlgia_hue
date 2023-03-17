<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGiadatdaugiaCt170323Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daugiadatct', function (Blueprint $table) {            
            $table->string('vitri')->nullable();
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
        Schema::table('daugiadatct', function (Blueprint $table) {
            $table->dropColumn('vitri');
            $table->dropColumn('diagioitu');
            $table->dropColumn('diagioiden');
        });
    }
}
