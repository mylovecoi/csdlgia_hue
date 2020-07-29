<?php

namespace App\Http\Controllers\congbo\dinhgia;

use App\Model\system\view_dsdiaban_donvi;
use App\Model\view\view_giahhdvcn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CongboGiaHhDvCnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $inputs = $request->all();
        $inputs['url'] = '/cbgiahhdvcn';
        $a_diaban = getDiaBan_XaHuyen('ADMIN');
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $model = view_giahhdvcn::where('congbo', 'DACONGBO');
        if ($inputs['nam'] != 'all')
            $model = $model->whereYear('thoidiem', $inputs['nam']);
        //$a_ts = array_column(giaspdvcidm::all()->toArray(),'tentaisan','mataisan');
        //$a_ts = array_column(GiaTaiSanCongDm::all()->toArray(),'tentaisan','mataisan');
        $a_donvi = array_column(view_dsdiaban_donvi::all()->toArray(),'tendv','madv');
        return view('congbo.DinhGia.GiaHhDvCn.index')
            ->with('model',$model->get())
            ->with('inputs',$inputs)
            ->with('a_diaban',$a_diaban)
            //->with('a_ts',$a_ts)
            ->with('a_donvi',$a_donvi)
            ->with('pageTitle','Thông tin giá hàng hóa, dịch vụ chuyên ngành');
    }
}
