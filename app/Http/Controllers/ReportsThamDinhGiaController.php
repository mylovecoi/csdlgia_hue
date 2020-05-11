<?php

namespace App\Http\Controllers;

use App\DiaBanHd;
use App\Model\system\dsdiaban;
use App\Model\view\view_thamdinhgia;
use App\ThamDinhGiaCt;
use App\Town;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ReportsThamDinhGiaController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViTimKiem(session('admin')->level, \session('admin')->madiaban);

            return view('manage.thamdinhgia.reports.index')
                ->with('m_diaban',$m_diaban)
                ->with('m_donvi',$m_donvi)
                ->with('pageTitle', 'Báo cáo tổng hợp tài sản thẩm định giá');

        }else
            return view('errors.notlogin');
    }

    public function Bc1(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $m_donvi = getDonViTimKiem(session('admin')->level, \session('admin')->madiaban);
            $model = view_thamdinhgia::wherein('madv',array_column($m_donvi->toarray(),'madv'));
            //dd($model);

            if($inputs['madv'] != 'all'){
                $model = $model->where('madv',$inputs['madv']);
            }

            if(getDayVn($inputs['ngaytu']) != ''){
                $model = $model->where('thoidiem','>=',$inputs['ngaytu']);
            }

            if(getDayVn($inputs['ngayden']) != ''){
                $model = $model->where('thoidiem','<=',$inputs['ngayden']);
            }
            $model = $model->get();
            return view('manage.thamdinhgia.reports.BC1')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('pageTitle', 'Phụ lục 5-TT142/2015/BTC');

        }else
            return view('errors.notlogin');
    }

}
