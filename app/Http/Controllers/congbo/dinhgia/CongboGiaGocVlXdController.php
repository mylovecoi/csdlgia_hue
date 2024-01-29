<?php

namespace App\Http\Controllers\congbo\dinhgia;

use App\GiaGocVlXd;
use App\Model\view\view_giagocvlxd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CongboGiaGocVlXdController extends Controller
{
    public function index(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/cbgiagocvlxd';
        $a_diaban = getDiaBan_XaHuyen('ADMIN');
        $inputs['nam'] = $inputs['nam'] ?? 'all';

        $model = view_giagocvlxd::where('congbo', 'DACONGBO');
        $model_dk = GiaGocVlXd::where('congbo', 'DACONGBO');
        if ($inputs['nam'] != 'all'){
            $model = $model->whereYear('thoidiem', $inputs['nam']);
            $model_dk = $model_dk->whereYear('thoidiem', $inputs['nam']);
        }
        $model = $model->get();
        // $model_dk = $model_dk->where('ipf1','<>', '')->get();


        //dd($model->get());
        return view('congbo.DinhGia.GiaGocVlXd.index')
            ->with('model',$model)
            ->with('model_dk',$model_dk)
            ->with('a_diaban',$a_diaban)
            ->with('inputs',$inputs)
            ->with('pageTitle','Thông tin giá gốc vật liệu xây dựng');

    }
}