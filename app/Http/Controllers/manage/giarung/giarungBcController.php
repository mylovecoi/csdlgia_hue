<?php

namespace App\Http\Controllers\manage\giarung;

use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Model\view\view_giadatthitruong;
use App\Model\view\view_giarung;
use App\Model\view\view_giathuemuanhaxh;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class giarungBcController extends Controller
{
    public function index(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['url'] = '/giarung';
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level);
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            //dd($inputs);
            return view('manage.dinhgia.giarung.reports.index')
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('m_donvi', $m_donvi)
                ->with('pageTitle','Báo cáo giá rừng');
        }else
            return view('errors.notlogin');
    }

    public function tonghop(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
//            dd($inputs);
            $m_donvi = dsdonvi::where('madv', $inputs['madv'])->first();
            if ($inputs['phanloai'] == 'Thuê môi trường') {
                $model = view_giarung::where('madv', $inputs['madv'])
                    ->where('phanloai', 'Thuê môi trường')
                    ->wherebetween('thoidiem', [$inputs['tungay'], $inputs['denngay']])
                    ->get();
                return view('manage.dinhgia.giarung.reports.BcTongHopThue')
                    ->with('model', $model)
                    ->with('m_donvi', $m_donvi)
                    ->with('inputs', $inputs)
                    ->with('pageTitle', 'Báo cáo giá rừng');
            } else {
                $model = view_giarung::where('madv', $inputs['madv'])
                    ->wherein('phanloai', ['Khai thác', 'Thanh lý'])
                    ->wherebetween('thoidiem', [$inputs['tungay'], $inputs['denngay']])
                    ->get();
                return view('manage.dinhgia.giarung.reports.BcTongHopKhaiThac')
                    ->with('model', $model)
                    ->with('m_donvi', $m_donvi)
                    ->with('inputs', $inputs)
                    ->with('pageTitle', 'Báo cáo giá rừng');
            }
        } else
            return view('errors.notlogin');
    }
}
