<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateThgiahhdvFiledinhkemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thgiahhdvk', function (Blueprint $table) {            
            $table->string('ipf_word')->nullable();
            $table->text('ipf_word_base64')->nullable();
            $table->string('ipf_pdf')->nullable();
            $table->text('ipf_pdf_base64')->nullable(); 
            $table->string('ipf_excel')->nullable();
            $table->text('ipf_excel_base64')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thgiahhdvk', function (Blueprint $table) {            
            $table->dropColumn('ipf_word');
            $table->dropColumn('ipf_word_base64');
            $table->dropColumn('ipf_pdf');
            $table->dropColumn('ipf_pdf_base64');
            $table->dropColumn('ipf_excel');
            $table->dropColumn('ipf_excel_base64');
        });
    }
}
