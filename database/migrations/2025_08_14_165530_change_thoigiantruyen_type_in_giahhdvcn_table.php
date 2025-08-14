<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeThoigiantruyenTypeInGiahhdvcnTable extends Migration
{
    public function up()
    {
        // DB::statement("ALTER TABLE `giahhdvcn` MODIFY `thoigiantruyen` DATE");
        DB::statement("ALTER TABLE giahhdvcn ALTER COLUMN thoigiantruyen DATE");
    }

    public function down()
    {
        // DB::statement("ALTER TABLE `giahhdvcn` MODIFY `thoigiantruyen` VARCHAR(255)");
        DB::statement("ALTER TABLE giahhdvcn ALTER COLUMN thoigiantruyen VARCHAR(255)");

    }
}
