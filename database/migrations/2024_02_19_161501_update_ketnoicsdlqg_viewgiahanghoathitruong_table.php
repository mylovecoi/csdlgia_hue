<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateKetnoicsdlqgViewgiahanghoathitruongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR ALTER VIEW [dbo].[view_thgiahhdvk]
AS
SELECT        dbo.thgiahhdvk.ngaybc, dbo.thgiahhdvk.ngaychotbc, dbo.thgiahhdvk.sobc, dbo.thgiahhdvk.ttbc, dbo.thgiahhdvk.matt, dbo.thgiahhdvk.mahs, dbo.thgiahhdvk.phanloai, dbo.thgiahhdvk.thang, dbo.thgiahhdvk.nam, 
                         dbo.thgiahhdvk.ghichu, dbo.thgiahhdvk.congbo, dbo.thgiahhdvk.trangthai, dbo.thgiahhdvkct.gialk, dbo.thgiahhdvkct.gia, dbo.thgiahhdvkct.loaigia, dbo.thgiahhdvkct.nguontt, dbo.dmhhdvk.tenhhdv, dbo.dmhhdvk.dacdiemkt, 
                         dbo.dmhhdvk.xuatxu, dbo.dmhhdvk.dvt, dbo.thgiahhdvkct.mahhdv
FROM            dbo.thgiahhdvk INNER JOIN
                         dbo.thgiahhdvkct ON dbo.thgiahhdvk.mahs = dbo.thgiahhdvkct.mahs INNER JOIN
                         dbo.dmhhdvk ON dbo.thgiahhdvkct.mahhdv = dbo.dmhhdvk.mahhdv
      ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
