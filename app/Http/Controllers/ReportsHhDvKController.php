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
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giahhdvk';
            $a_nhomhhdv = array_column(NhomHhDvK::all()->toArray(), 'tentt', 'matt');
            $inputs['matt'] = $inputs['matt'] ?? array_key_first($a_nhomhhdv);
            $a_nhaplieu = array_column(getDonViNhapLieu(session('admin')->level, 'giahhdvk')->toArray(), 'tendv', 'madv');
            $a_tonghop = array_column(getDonViTongHop('giahhdvk', \session('admin')->level, \session('admin')->madiaban)->toArray(), 'tendv', 'madv');
//            dd($a_tonghop);
            $m_hoso = ThGiaHhDvK::where('matt', $inputs['matt'])->get();
            $a_hoso = array_column($m_hoso->toArray(), 'ttbc', 'mahs');
            return view('manage.dinhgia.giahhdvk.reports.index')
                ->with('a_nhomhhdv', $a_nhomhhdv)
                ->with('a_nhaplieu', $a_nhaplieu)
                ->with('a_tonghop', $a_tonghop)
                ->with('a_hoso', a_merge([''=>'-- Chọn hồ sơ báo cáo --'],$a_hoso))
                ->with('m_hoso', $m_hoso)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Báo cáo tổng hợp giá hàng hóa dịch vụ khác');
        } else
            return view('errors.notlogin');
    }

    public function bc1(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
//            $a_diaban = getDiaBan_NhapLieu(\session('admin')->level, session('admin')->madiaban);
//            dd($inputs);
            $a_hs = GiaHhDvK::where('matt', $inputs['matt'])
                //->wherein('madiabaniaban', array_keys($a_diaban))
                ->where('madv', $inputs['madv'])
                ->where('thoidiem', '<', $inputs['tungay'])
                ->where('trangthai', 'HT')
                ->select('mahs')
                ->get()->toarray();
            $a_hs_lk = GiaHhDvK::where('matt', $inputs['matt'])
                //->wherein('madiaban', array_keys($a_diaban))
                ->where('madv', $inputs['madv'])
                ->wherebetween('thoidiem', [$inputs['tungay'], $inputs['denngay']])
                ->where('trangthai', 'HT')
                ->select('mahs')
                ->get()->toarray();
            $ttlk = GiaHhDvKCt::wherein('mahs', $a_hs_lk)
                ->where('gia', '<>', 0)
                ->get();

            $tt = GiaHhDvKCt::wherein('mahs', $a_hs)
                ->where('gia', '<>', 0)
                ->get();

            $a_nhom = DmHhDvK::where('matt', $inputs['matt'])->get()->keyby('mahhdv')->toarray();
            //gộp 2 chi tiết thành 1 mang các mahhdv
            $a_hhdv = a_unique(array_merge(array_column($ttlk->toarray(), 'mahhdv'),
                array_column($tt->toarray(), 'mahhdv')));
            $a_chitiet = $a_gr = [];
            foreach ($a_hhdv as $hh){
                $a_chitiet[] = ['mahhdv'=>$hh];
            }

            for ($i=0;$i<count($a_chitiet);$i++) {
                if (isset($a_nhom[$a_chitiet[$i]['mahhdv']])) {
                    $dm = $a_nhom[$a_chitiet[$i]['mahhdv']];
                    $a_chitiet[$i]['tenhhdv'] = $dm['tenhhdv'];
                    $a_chitiet[$i]['dacdiemkt'] = $dm['dacdiemkt'];
                    $a_chitiet[$i]['dvt'] = $dm['dvt'];
                    $a_chitiet[$i]['manhom'] = $dm['manhom'];
//                    dd($dm['tenhhdv']);
                } else {
                    $a_chitiet[$i]['tenhhdv'] = $a_chitiet[$i]['dacdiemkt'] = $a_chitiet[$i]['dvt'] = $a_chitiet[$i]['manhom'] = '';
                }

                $a_gr[] = $a_chitiet[$i]['manhom'];
                $a_chitiet[$i]['giathlk'] = round($ttlk->where('mahhdv', $a_chitiet[$i]['mahhdv'])->avg('gia'));
                $a_chitiet[$i]['giath'] = round($tt->where('mahhdv', $a_chitiet[$i]['mahhdv'])->avg('gia'));
                $a_chitiet[$i]['chenhlech'] = $a_chitiet[$i]['giath'] - $a_chitiet[$i]['giathlk'];
                $a_chitiet[$i]['phantram'] = $a_chitiet[$i]['giathlk'] == 0 ? 100 : round(100 * ($a_chitiet[$i]['chenhlech'] / $a_chitiet[$i]['giathlk']), 5);

            }

            $a_gr = a_unique($a_gr);
            $a_nhomhhdv = array_column(DmNhomHangHoa::where('phanloai', 'GIAHHDVK')->get()->toarray(), 'tennhom', 'manhom');
            //dd($a_chitiet);
            return view('manage.dinhgia.giahhdvk.reports.bc1')
                ->with('a_nhomhhdv', $a_nhomhhdv)
                ->with('a_gr', $a_gr)
                ->with('inputs', $inputs)
                ->with('a_chitiet', $a_chitiet)
                ->with('pageTitle', 'Báo cáo giá hàng hóa, dịch vụ');
        } else
            return view('errors.notlogin');
    }

    public function bc2(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = DmHhDvK::where('matt', $inputs['matt'])
                ->where('theodoi', 'TD')
                ->orderby('mahhdv')
                ->get();
            $m_hoso = ThGiaHhDvK::where('mahs', $inputs['mahs'])->first();
//            dd($m_hoso);
            $a_chitiet = ThGiaHhDvKCt::where('mahs', $inputs['mahs'])->get()->keyby('mahhdv')->toarray();
            $a_chitiet_lk = ThGiaHhDvKCt::where('mahs', $inputs['mahslk'])->get()->keyby('mahhdv')->toarray();

            foreach ($model as $ct) {
                $ct->gia = $ct->gialk = 0;
                if (isset($a_chitiet[$ct->mahhdv])) {
                    $ttgia = $a_chitiet[$ct->mahhdv];
                    $ct->gia = $ttgia['gia'];
                    $ct->loaigia = $ttgia['loaigia'];
                    $ct->nguontt = $ttgia['nguontt'];
                    $ct->ghichu = $ttgia['ghichu'];
                }
                if (isset($a_chitiet_lk[$ct->mahhdv])) {
                    $ttgialk = $a_chitiet_lk[$ct->mahhdv];
                    $ct->gialk = $ttgialk['gia'];
                }
                $ct->chenhlech = $ct->gia - $ct->gialk;
                $ct->phantram = $ct->gialk == 0 ? 100 : round(100 * ($ct->chenhlech / $ct->gialk), 5);
            }
            $a_gr = a_unique(array_column($model->toarray(), 'manhom'));
            $a_nhomhhdv = array_column(DmNhomHangHoa::where('phanloai', 'GIAHHDVK')->get()->toarray(), 'tennhom', 'manhom');
            return view('manage.dinhgia.giahhdvk.reports.bc2')
                ->with('a_nhomhhdv', $a_nhomhhdv)
                ->with('a_gr', $a_gr)
                ->with('inputs', $inputs)
                ->with('model', $model)
                ->with('m_hoso', $m_hoso)
                ->with('pageTitle', 'Báo cáo giá hàng hóa, dịch vụ theo tháng');
        } else
            return view('errors.notlogin');
    }
}
