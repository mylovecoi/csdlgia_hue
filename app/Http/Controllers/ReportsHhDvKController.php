<?php

namespace App\Http\Controllers;

use App\DiaBanHd;
use App\District;
use App\DmHhDvK;
use App\DmNhomHangHoa;
use App\GiaHhDvK;
use App\GiaHhDvKCt;
use App\Model\system\dsdiaban;
use App\NhomHhDvK;
use App\ThGiaHhDvK;
use App\ThGiaHhDvKCt;
use App\Town;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\PhpWord;

class ReportsHhDvKController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $modelnhomhhdvk = NhomHhDvK::all();
            $a_nhaplieu = array_column(getDonViNhapLieu(session('admin')->level, 'giahhdvk')->toArray(), 'tendv', 'madv');
            $a_tonghop = array_column(getDonViTongHop('giahhdvk', \session('admin')->level, \session('admin')->madiaban)->toArray(), 'tendv', 'madv');
            return view('manage.dinhgia.giahhdvk.reports.index')
                ->with('modelnhomhhdvk', $modelnhomhhdvk)
                ->with('a_nhaplieu', $a_nhaplieu)
                ->with('a_tonghop', $a_tonghop)
                ->with('pageTitle', 'Báo cáo tổng hợp giá hàng hóa dịch vụ khác');
        } else
            return view('errors.notlogin');
    }

    public function bc1(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $a_diaban = getDiaBan_NhapLieu(\session('admin')->level, session('admin')->madiaban);
            //dd($inputs);
            $a_hs = GiaHhDvK::where('matt', $inputs['matt'])
                //->wherein('madiabaniaban', array_keys($a_diaban))
                ->where('madv', $inputs['madv'])
                ->where('thoidiem', '<', getDateToDb($inputs['ngayapdung']))
                ->where('trangthai', 'HT')
                ->select('mahs')
                ->get()->toarray();
            $a_hs_lk = GiaHhDvK::where('matt', $inputs['matt'])
                //->wherein('madiaban', array_keys($a_diaban))
                ->where('madv', $inputs['madv'])
                ->where('thoidiem', '<', getDateToDb($inputs['ngayapdunglk']))
                ->where('trangthai', 'HT')
                ->select('mahs')
                ->get()->toarray();
           // dd($a_hs);
            $ttlk = GiaHhDvKCt::wherein('mahs', $a_hs_lk)
                ->where('gia', '<>', 0)
                ->get();

            $tt = GiaHhDvKCt::wherein('mahs', $a_hs)
                ->where('gia', '<>', 0)
                ->get();

            $modelct = DmHhDvK::where('matt', $inputs['matt'])
                //->where('theodoi','TD')
                ->orderby('mahhdv')
                ->get();
            foreach ($modelct as $ct) {
                $ttgialk = round($ttlk->where('mahhdv', $ct->mahhdv)->avg('gia'));
                $ct->giathlk = $ttgialk;
                $ttgia = round($tt->where('mahhdv', $ct->mahhdv)->avg('gia'));
                $ct->giath = $ttgia;
            }
            $a_gr = a_unique(array_column($modelct->toarray(), 'manhom'));
            $a_nhomhhdv = array_column(DmNhomHangHoa::where('phanloai', 'GIAHHDVK')->get()->toarray(), 'tennhom', 'manhom');
            dd($tt);
            return view('manage.dinhgia.giahhdvk.reports.bc1')
                ->with('a_nhomhhdv', $a_nhomhhdv)
                ->with('a_gr', $a_gr)
                ->with('inputs', $inputs)
                ->with('modelct', $modelct)
                ->with('pageTitle', 'Báo cáo giá hàng hóa, dịch vụ');
        } else
            return view('errors.notlogin');
    }

    public function bc2(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = DmHhDvK::where('matt',$inputs['matt'])
                //->where('theodoi','TD')
                    ->orderby('mahhdv')
                    ->get();
            $mahs = ThGiaHhDvK::where('thang',$inputs['thang'])
                ->where('matt',$inputs['matt'])
                ->where('nam',$inputs['nam'])
                //->wherein('trangthai',['HT','CB'])
                ->first();
            $mahslk = ThGiaHhDvK::where('thang',$inputs['thanglk'])
                ->where('matt',$inputs['matt'])
                ->where('nam',$inputs['namlk'])
                //->wherein('trangthai',['HT','CB'])
                ->first();
            //dd($mahs);
            foreach($model as $ct){
                if(isset($mahs)) {
                    $ttgia = ThGiaHhDvKCt::where('mahs',$mahs->mahs)
                        ->where('mahhdv', $ct->mahhdv)
                        ->first();
                    $ct->gia = $ttgia->gia;
                    $ct->loaigia = $ttgia->loaigia;
                    $ct->nguontt = $ttgia->nguontt;
                    $ct->ghichu = $ttgia->ghichu;
                }
                if(isset($mahslk)) {
                    $ttgialk = ThGiaHhDvKCt::where('mahs',$mahslk->mahs)
                        ->where('mahhdv',$ct->mahhdv)
                        ->first();
                    $ct->gialk = $ttgialk->gia;
                }
            }
            $a_gr = a_unique( array_column($model->toarray(),'manhom'));
            $a_nhomhhdv = array_column(DmNhomHangHoa::where('phanloai','GIAHHDVK')->get()->toarray(),'tennhom','manhom');
            return view('manage.dinhgia.giahhdvk.reports.bc2')
                ->with('a_nhomhhdv',$a_nhomhhdv)
                ->with('a_gr',$a_gr)
                ->with('inputs',$inputs)
                ->with('model',$model)
                ->with('pageTitle','Báo cáo giá hàng hóa, dịch vụ theo tháng');
        }else
            return view('errors.notlogin');
    }
}
