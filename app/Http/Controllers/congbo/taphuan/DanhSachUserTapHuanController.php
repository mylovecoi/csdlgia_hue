<?php

namespace App\Http\Controllers\congbo\taphuan;

use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

class DanhSachUserTapHuanController extends Controller
{
    public function index(Request $request){
        $inputs = $request->all();
//        $inputs['level'] = isset($inputs['level']) ? $inputs['level'] : 'H';
        $inputs['level'] = 'DN';
//        $model = Users::where('status','Kích hoạt')
//            ->where('level',$inputs['level'])
//            ->get();
        $model = new Collection();
        return view('congbo.taphuan.index')
            ->with('model',$model)
            ->with('inputs',$inputs)
            ->with('pageTitle','Danh sách User Tập Huấn');
    }
}
