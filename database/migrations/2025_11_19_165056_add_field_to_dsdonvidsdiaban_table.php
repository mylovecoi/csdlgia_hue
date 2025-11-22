<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToDsdonvidsdiabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dsdonvi', function (Blueprint $table) {
            $table->string('madv_cu')->nullable();
        });

        Schema::table('dsdiaban', function (Blueprint $table) {
            $table->string('madiaban_cu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dsdonvi', function (Blueprint $table) {
            $table->dropColumn('madv_cu');
        });

        Schema::table('dsdiaban', function (Blueprint $table) {
            $table->dropColumn('madiaban_cu');
        });
    }
}
