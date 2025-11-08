<?php

namespace App\Http\Controllers\manage\kekhaigia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\system\dmnganhnghekd\DmNganhKd;
use App\Model\system\dmnganhnghekd\DmNgheKd;

class KkGiaNd85Controller extends Controller
{
    function index(Request $request)
    {
        $inputs = $request->all();
        return view('manage.kkgia.index')
            ->with('inputs', $inputs)
            ->with('pageTitle', 'Danh sách hồ sơ xét duyệt');
    }
}
