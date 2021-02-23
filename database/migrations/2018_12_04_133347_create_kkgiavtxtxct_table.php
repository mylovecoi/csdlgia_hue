<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKkgiavtxtxctTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkgiavtxtxct', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mahs')->nullable();
            $table->string('madv')->nullable();
            $table->string('madichvu')->nullable();
            $table->string('loaixe')->nullable();
            $table->text('tendvcu')->nullable();
            $table->text('mota')->nullable();
            $table->string('qccl')->nullable();
            $table->string('sl')->nullable();
            $table->string('dvt')->nullable();
            $table->string('sllk')->nullable();
            $table->string('dvtlk')->nullable();

            $table->double('gialk')->default(0);
            $table->double('giakk')->default(0);
            $table->string('sokm')->nullable();
            $table->double('gialk1')->default(0);
            $table->double('giakk1')->default(0);
            $table->string('sokm1')->nullable();
            $table->double('gialk2')->default(0);
            $table->double('giakk2')->default(0);
            $table->string('sokm2')->nullable();
            $table->double('gialk3')->default(0);
            $table->double('giakk3')->default(0);
            $table->string('sokm3')->nullable();

            $table->string('ghichu')->nullable();
            $table->string('thuevat')->nullable();
            $table->string('trangthai')->nullable();

            $table->string('dvcu')->nullable();
            $table->double('sltgdvt')->default(0);
            $table->double('sltgtt')->default(0);
            $table->double('sltggc')->default(0);

            $table->double('chiphinldvt')->default(0);
            $table->double('chiphinltt')->default(0);
            $table->double('chiphinlgc')->default(0);

            $table->double('chiphincdvt')->default(0);
            $table->double('chiphinctt')->default(0);
            $table->double('chiphincgc')->default(0);

            $table->double('chiphikhdvt')->default(0);
            $table->double('chiphikhtt')->default(0);
            $table->double('chiphikhdv')->default(0);

            $table->double('chiphisxkddtdvt')->default(0);
            $table->double('chiphisxkddttt')->default(0);
            $table->double('chiphisxkddtgc')->default(0);

            $table->double('chiphisxcdvt')->default(0);
            $table->double('chiphisxctt')->default(0);
            $table->double('chiphisxcgc')->default(0);

            $table->double('chiphitcdvt')->default(0);
            $table->double('chiphitctt')->default(0);
            $table->double('chiphitcgc')->default(0);

            $table->double('chiphibhdvt')->default(0);
            $table->double('chiphibhtt')->default(0);
            $table->double('chiphibhgc')->default(0);

            $table->double('chiphiqldvt')->default(0);
            $table->double('chiphiqltt')->default(0);
            $table->double('chiphiqlgc')->default(0);

            $table->double('chiphidvkdvt')->default(0);
            $table->double('chiphidvktt')->default(0);
            $table->double('chiphidvkgc')->default(0);

            $table->text('giaitrinhctcp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kkgiavtxtxct');
    }
}
