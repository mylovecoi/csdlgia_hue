<?php

namespace App\Model\manage\kekhaigia\kkdvvt\vtxb;

use Illuminate\Database\Eloquent\Model;

class KkGiaVtXbCt extends Model
{
    protected $table = 'kkgiavtxbct';
    protected $fillable = [
        'id',

        'mahs',
        'maxa',
        'madv',
        'tendvcu',
        'qccl',
        'dvt',
        'gialk',
        'giakk',
        'ghichu',
        'trangthai',

        'dvcu',

        'sltgdvt',
        'sltgtt',
        'sltggc',

        'chiphinldvt',
        'chiphinltt',
        'chiphinlgc',

        'chiphincdvt',
        'chiphinctt',
        'chiphincgc',

        'chiphikhdvt',
        'chiphikhtt',
        /*'chiphikhdv',*/
        'chiphikhgc',

        'chiphisxkddtdvt',
        'chiphisxkddttt',
        'chiphisxkddtgc',

        'chiphisxcdvt',
        'chiphisxctt',
        'chiphisxcgc',

        'chiphitcdvt',
        'chiphitctt',
        'chiphitcgc',

        'chiphibhdvt',
        'chiphibhtt',
        'chiphibhgc',

        'chiphiqldvt',
        'chiphiqltt',
        'chiphiqlgc',

        'chiphidvkdvt',
        'chiphidvktt',
        'chiphidvkgc',

        'giaitrinhctcp',
    ];
}
