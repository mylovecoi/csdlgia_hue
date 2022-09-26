<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateChisogiatieudungDanhMucChiTiet1709Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chisogiatieudung_DanhMuc_ChiTiet', function (Blueprint $table) {
            $table->double('quyensogoc_thanhthi')->default(0);
            $table->double('quyensogoc_nongthon')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chisogiatieudung_DanhMuc_ChiTiet', function (Blueprint $table) {            
            $table->dropColumn('quyensogoc_thanhthi');
            $table->dropColumn('quyensogoc_nongthon');
        });
    }
}
