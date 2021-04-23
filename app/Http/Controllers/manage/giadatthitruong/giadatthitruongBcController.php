<?php

namespace App\Http\Controllers\manage\giadatthitruong;

use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Model\view\view_giadatthitruong;
use App\Model\view\view_giathuemuanhaxh;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class giadatthitruongBcController extends Controller
{
    public function index(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['url'] = '/giadatthitruong';
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level,'giadatthitruong');
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            //dd($inputs);
            return view('manage.dinhgia.giadatthitruong.reports.index')
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('m_donvi', $m_donvi)
                ->with('pageTitle','Báo cáo giá giao dịch bất động sản');
        }else
            return view('errors.notlogin');
    }

    public function tonghop(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = view_giadatthitruong::where('madv',$inputs['madv'])
                ->wherebetween('thoidiem',[$inputs['tungay'], $inputs['denngay']])
                ->get();
            $m_donvi = dsdonvi::where('madv', $inputs['madv'])->first();
//            dd($inputs);
            return view('manage.dinhgia.giadatthitruong.reports.BcTongHop')
                ->with('model',$model)
                ->with('m_donvi',$m_donvi)
                ->with('inputs',$inputs)
                ->with('pageTitle','Báo cáo giá giao dịch bất động sản');
        }else
            return view('errors.notlogin');
    }
}
