<?php

namespace App\Http\Controllers\manage\giathuetscong;

use App\District;
use App\Model\manage\dinhgia\gianuocsachsh\GiaNuocSachShDm;
use App\Model\manage\dinhgia\gianuocsachsh\GiaNuocSh;
use App\Model\manage\dinhgia\gianuocsachsh\GiaNuocShCt;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Model\view\view_giathuetscong;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GiaThueTsCongBcController extends Controller
{
    public function index(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['url'] = '/giathuetscong';
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level);
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            //dd($inputs);
            return view('manage.dinhgia.giathuetscong.reports.index')
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('m_donvi', $m_donvi)
                ->with('pageTitle','Báo cáo giá thuê tài sản công');
        }else
            return view('errors.notlogin');
    }

    public function tonghop(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = view_giathuetscong::where('madv',$inputs['madv'])
                ->wherebetween('thoidiem',[$inputs['tungay'], $inputs['denngay']])
                ->get();
            $m_donvi = dsdonvi::where('madv', $inputs['madv'])->first();
//            dd($inputs);
            return view('manage.dinhgia.giathuetscong.reports.BcTongHop')
                ->with('model',$model)
                ->with('m_donvi',$m_donvi)
                ->with('inputs',$inputs)
                ->with('pageTitle','Báo cáo giá thuê tài sản công');
        }else
            return view('errors.notlogin');
    }
}
