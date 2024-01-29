<?php

namespace App\Http\Controllers\congbo\dinhgia;

use App\GiaHhDvK;
use App\Model\view\view_giahhdvk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CongboGiaHhDvKController extends Controller
{
    public function index(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/cbgiahhdvk';
        $a_diaban = getDiaBan_XaHuyen('ADMIN');
        $inputs['nam'] = $inputs['nam'] ?? 'all';

        $model = view_giahhdvk::where('congbo', 'DACONGBO');
        $model_dk = GiaHhDvK::where('congbo', 'DACONGBO');
        if ($inputs['nam'] != 'all'){
            $model = $model->whereYear('thoidiem', $inputs['nam']);
            $model_dk = $model_dk->whereYear('thoidiem', $inputs['nam']);
        }
        $model = $model->get();
        // $model_dk = $model_dk->where('ipf1','<>', '')->get();


        //dd($model->get());
        return view('congbo.DinhGia.GiaHhDvK.index')
            ->with('model',$model)
            ->with('model_dk',$model_dk)
            ->with('a_diaban',$a_diaban)
            ->with('inputs',$inputs)
            ->with('pageTitle','Thông tin giá hàng hóa dịch vụ khác');

    }
}