<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGeneralConfigs1209Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_configs', function (Blueprint $table) {
            $table->boolean('hienthongbao')->default(0);
            $table->string('noidungthongbao')->nullable();
            $table->boolean('hienchungchimang')->default(0);
            $table->string('noidungchungchimang')->nullable();
            $table->boolean('hienanhdau')->default(0);
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
            $table->dropColumn('hienthongbao');
            $table->dropColumn('noidungthongbao');
            $table->dropColumn('hienchungchimang');
            $table->dropColumn('noidungchungchimang');
            $table->dropColumn('hienanhdau');
        });
    }
}
