<?php

namespace App\Http\Controllers\manage\thuemuanhaxh;

use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Model\view\view_giathuemuanhaxh;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GiaThueMuaNhaXhBcController extends Controller
{
    public function index(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['url'] = '/thuemuanhaxahoi';
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level);
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            //dd($inputs);
            return view('manage.dinhgia.giathuemuanhaxh.reports.index')
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('m_donvi', $m_donvi)
                ->with('pageTitle','Báo cáo giá thuê, mua nhà xã hội');
        }else
            return view('errors.notlogin');
    }

    public function tonghop(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = view_giathuemuanhaxh::where('madv',$inputs['madv'])
                ->wherebetween('thoidiem',[$inputs['tungay'], $inputs['denngay']])
                ->get();
            $m_donvi = dsdonvi::where('madv', $inputs['madv'])->first();
//            dd($inputs);
            return view('manage.dinhgia.giathuemuanhaxh.reports.BcTongHop')
                ->with('model',$model)
                ->with('m_donvi',$m_donvi)
                ->with('inputs',$inputs)
                ->with('pageTitle','Báo cáo giá thuê, mua nhà xã hội');
        }else
            return view('errors.notlogin');
    }
}
