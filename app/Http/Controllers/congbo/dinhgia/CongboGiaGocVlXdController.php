<?php

namespace App\Http\Controllers\congbo\dinhgia;

use App\GiaGocVlXd;
use App\Model\view\view_giagocvlxd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ThGiaGocVlXd;

class CongboGiaGocVlXdController extends Controller
{
    public function index(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/cbgiagocvlxd';
        $a_diaban = getDiaBan_XaHuyen('ADMIN');
        $inputs['nam'] = $inputs['nam'] ?? 'all';

        $model = view_giagocvlxd::where('trangthai', 'CB');
        $model_dk = ThGiaGocVlXd::where('trangthai', 'CB');
        if ($inputs['nam'] != 'all'){
            $model = $model->where('nam', $inputs['nam']);
            $model_dk = $model_dk->where('nam', $inputs['nam']);
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