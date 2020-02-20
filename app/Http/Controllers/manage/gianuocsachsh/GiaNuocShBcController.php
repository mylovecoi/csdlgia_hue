<?php

namespace App\Http\Controllers\manage\gianuocsachsh;

use App\District;
use App\Model\manage\dinhgia\gianuocsachsh\GiaNuocSachShDm;
use App\Model\manage\dinhgia\gianuocsachsh\GiaNuocSh;
use App\Model\manage\dinhgia\gianuocsachsh\GiaNuocShCt;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GiaNuocShBcController extends Controller
{
    public function index(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level);
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $modelhs = GiaNuocSh::where('madv',$inputs['madv'])->get();
            return view('manage.dinhgia.gianuocsh.reports.index')
                ->with('inputs', $inputs)
                ->with('modelhs',$modelhs)
                ->with('m_diaban', $m_diaban)
                ->with('m_donvi', $m_donvi)
                ->with('pageTitle','Báo cáo giá nước sạch sinh hoạt');
        }else
            return view('errors.notlogin');
    }

    public function Bc1(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = GiaNuocSachShDm::all();
            foreach($model as $ct){
                $modellk = GiaNuocShCt::where('mahs',$inputs['mahslk'])
                    ->where('doituongsd',$ct->doituongsd)
                    ->first();
                $modelbc = GiaNuocShCt::where('mahs',$inputs['mahsbc'])
                    ->where('doituongsd',$ct->doituongsd)
                    ->first();
                $ct->gialk = $modellk->giachuathue;
                $ct->giabc = $modelbc->giachuathue;
            }
            $ttlk = GiaNuocSh::where('mahs',$inputs['mahslk'])->first();
            $ttbc = GiaNuocSh::where('mahs',$inputs['mahsbc'])->first();
            $m_donvi = dsdonvi::where('madv', $inputs['madv'])->first();

            return view('manage.dinhgia.gianuocsh.reports.BcGiaNuocSh1')
                ->with('model',$model)
                ->with('ttlk',$ttlk)
                ->with('ttbc',$ttbc)
                ->with('m_donvi',$m_donvi)
                ->with('inputs',$inputs)
                ->with('pageTitle','Báo cáo giá nước sạch sinh hoạt');
        }else
            return view('errors.notlogin');
    }
}
