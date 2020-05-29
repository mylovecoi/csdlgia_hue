<?php

namespace App\Model\manage\dinhgia\gianuocsachsh;

use Illuminate\Database\Eloquent\Model;

class GiaNuocShCt extends Model
{
    protected $table = 'gianuocshct';
    protected $fillable = [
        'id',
        'madoituong',
        'doituongsd',

        'thuevat',
        'giacothue',
        'phibvmttyle',
        'phibvmt',
        'thanhtien',
        'mahs',
        'trangthai',

        'giachuathue',
        'namchuathue',
        'giachuathue1',
        'namchuathue1',
        'giachuathue2',
        'namchuathue2',
        'giachuathue3',
        'namchuathue3',
        'giachuathue4',
        'namchuathue4',
    ];
}
