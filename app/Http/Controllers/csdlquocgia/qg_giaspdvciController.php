<?php

namespace App\Http\Controllers\csdlquocgia;

use App\Model\system\dsdiaban;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\manage\dinhgia\giaspdvci\GiaSpDvCi;
use App\Model\manage\dinhgia\giaspdvci\giaspdvcidm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class qg_giaspdvciController extends Controller
{
    public function nhandanhmuc(Request $request){
        $model = giaspdvcidm::all();
        $inputs['url'] = '/csdlquocgia/qg_giaspdvci/nhandanhmuc';
        return view('csdlquocgia.qg_giaspdvci.nhandanhmuc.index')
            ->with('model',$model)
            ->with('inputs',$inputs)
            ->with('pageTitle','Danh mục Giá dịch vụ thu gom, vận chuyển rác thải sinh hoạt');
    }

    public function nhanhoso(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/csdlquocgia/qg_giaspdvci/nhanhoso';
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level,'giaspdvci');
            if (count($m_donvi) == null) {
                $message = 'Chưa có đơn vị nào được phân quyền nhập liệu cho chức năng: ' . session('admin')['a_chucnang']['giaspdvci']
                    . '. Bạn cần liên hệ người quản trị để phần quyền nhập liệu cho đơn vị.';
                return  view('errors.403')
                    ->with('message', $message);
            }
            $m_donvi_th = getDonViTongHop('giaspdvci',\session('admin')->level, \session('admin')->madiaban);
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? 'all';
            $model = giaspdvci::where('madv', $inputs['madv']);
            if($inputs['nam'] != 'all')
                $model = $model->whereYear('thoidiem', $inputs['nam']);
            $a_dm = array_column(giaspdvcidm::all()->toArray(), 'maspdv', 'tenspdv');
            return view('csdlquocgia.qg_giaspdvci.nhanhoso.index')
                ->with('model', $model->get())
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_diaban', array_column($m_diaban->wherein('level', ['H','T'])->toarray(), 'tendiaban', 'madiaban'))
                ->with('a_dm', $a_dm)
                ->with('a_dv', array_column($m_donvi->toarray(), 'tendv', 'madv'))
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Nhận hồ sơ Giá dịch vụ thu gom, vận chuyển rác thải sinh hoạt');    
        } else
            return view('errors.notlogin');
    }

    public function chuyenhs(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = giaspdvci::where('mahs', $inputs['mahs'])->first();
            $a_lichsu = json_decode($model->lichsu, true);
            $a_lichsu[getdate()[0]] = array(
                'hanhdong' => 'HT',
                'username' => session('admin')->username,
                'mota' => 'Chuyển hồ sơ',
                'thoigian' => date('Y-m-d H:i:s'),
                'macqcq' => $inputs['macqcq'],
                'madv' => $model->madv
            );

            $model->lichsu = json_encode($a_lichsu);
            $model->macqcq = $inputs['macqcq'];
            $model->trangthai = 'HT';
            $chk_dvcq = view_dsdiaban_donvi::where('madv', $inputs['macqcq'])->first();
            if ($chk_dvcq->count() && $chk_dvcq->level == 'T') {
                $model->madv_t = $inputs['macqcq'];
                $model->thoidiem_t = date('Y-m-d');
                $model->trangthai_t = 'CHT';
            } else if ($chk_dvcq->count() && $chk_dvcq->level == 'ADMIN') {
                $model->madv_ad = $inputs['macqcq'];
                $model->thoidiem_ad = date('Y-m-d');
                $model->trangthai_ad = 'CHT';
            } else {
                $model->madv_h = $inputs['macqcq'];
                $model->thoidiem_h = date('Y-m-d');
                $model->trangthai_h = 'CHT';
            }
            $model->save();
            return redirect('/csdlquocgia/qg_giaspdvci/nhanhoso?madv=' . $model->madv);
        } else
            return view('errors.notlogin');
    }

    public function truyendanhmuc(Request $request)
    {
        $model = giaspdvcidm::all();
        $inputs['url'] = '/csdlquocgia/qg_giaspdvci/danhmuc';
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        if ($inputs['truyendulieu'] != 'all')
            $model = $model->where('truyendulieu', $inputs['truyendulieu']);
        return view('csdlquocgia.qg_giaspdvci.truyendanhmuc.index')
            ->with('model',$model)
            ->with('inputs',$inputs)
            ->with('pageTitle','Truyền danh mục Giá dịch vụ thu gom, vận chuyển rác thải sinh hoạt');
    }

    public function capnhatdanhmuc(Request $request)
    {
        $inputs = $request->all();
        $model = giaspdvcidm::where('maspdv',$inputs['maspdv'])->first();
        $model->update($inputs);
        return redirect('/csdlquocgia/qg_giaspdvci/danhmuc?truyendulieu=' . $inputs['truyendulieu']);
    }

    public function show_nhomdm(Request $request)
    {
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = giaspdvcidm::where('maspdv',$inputs['maspdv'])->first();
        die($model);
    }

    public function truyenhoso(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/csdlquocgia/qg_giaspdvci/hoso';
        $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
        $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();

        $m_donvi = getDonViXetDuyet(session('admin')->level);
        $m_donvi_th = getDonViTongHop('giaspdvci',\session('admin')->level, \session('admin')->madiaban);
        $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
        $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $inputs['level'] = $m_donvi_th->where('madv', $inputs['madv'])->first()->level ?? 'H';
        $a_ttdv = array_column(view_dsdiaban_donvi::wherein('madiaban', array_keys($a_diaban))->get()->toarray(),
            'tendv', 'madv');

        switch ($inputs['level']){
            case 'H':{
                $model = giaspdvci::where('madv_h', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem_h', $inputs['nam']);
                if ($inputs['truyendulieu'] != 'all')
                        $model = $model->where('truyendulieu', $inputs['truyendulieu']);
                $model = $model->get();
                foreach ($model as $ct){
                    $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct );
                    $ct->tendv_ch = $a_ttdv[$ct->madv_ch] ?? '';
                    $ct->madv = $ct->madv_h;
                    $ct->macqcq = $ct->macqcq_h;
                    $ct->tencqcq = $a_ttdv[$ct->macqcq] ?? '';
                    $ct->thoidiem = $ct->thoidiem_h;
                    $ct->trangthai = $ct->trangthai_h;
                    $ct->level = $inputs['level'];
                }
                break;
            }
            case 'T':{
                $model = giaspdvci::where('madv_t', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem_t', $inputs['nam']);
                if ($inputs['truyendulieu'] != 'all')
                        $model = $model->where('truyendulieu', $inputs['truyendulieu']);
                $model = $model->get();
                foreach ($model as $ct){
                    $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct );
                    $ct->tendv_ch = $a_ttdv[$ct->madv_ch] ?? '';
                    $ct->madv = $ct->madv_t;
                    $ct->macqcq = $ct->macqcq_t;
                    $ct->tencqcq = $a_ttdv[$ct->macqcq] ?? '';
                    $ct->thoidiem = $ct->thoidiem_t;
                    $ct->trangthai = $ct->trangthai_t;
                    $ct->level = $inputs['level'];
                }
                break;
            }
            case 'ADMIN':{
                $model = giaspdvci::where('madv_ad', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem_ad', $inputs['nam']);
                if ($inputs['truyendulieu'] != 'all')
                        $model = $model->where('truyendulieu', $inputs['truyendulieu']);
                $model = $model->get();
                foreach ($model as $ct){
                    $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct );
                    $ct->tendv_ch = $a_ttdv[$ct->madv_ch] ?? '';
                    $ct->madv = $ct->madv_ad;
                    $ct->macqcq = $ct->macqcq_ad;
                    $ct->tencqcq = $a_ttdv[$ct->macqcq] ?? '';
                    $ct->thoidiem = $ct->thoidiem_ad;
                    $ct->trangthai = $ct->trangthai_ad;
                    $ct->level = $inputs['level'];
                }
                break;
            }
        }

        return view('csdlquocgia.qg_giaspdvci.truyenhoso.index')
            ->with('model', $model)
            ->with('inputs', $inputs)
            ->with('m_diaban', $m_diaban)
            ->with('a_diaban', array_column($m_diaban->where('level', 'H')->toarray(), 'tendiaban', 'madiaban'))
            ->with('m_donvi', $m_donvi)
            ->with('m_donvi_th', $m_donvi_th->where('madv','<>',$inputs['madv']))
            ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
            ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
            ->with('pageTitle', 'Truyền hồ sơ Giá dịch vụ thu gom, vận chuyển rác thải sinh hoạt');
    }

    public function capnhathoso(Request $request)
    {
        $inputs = $request->all();
        $model = giaspdvci::where('mahs',$inputs['mahs'])->first();
        $model->update($inputs);
        return redirect('/csdlquocgia/qg_giaspdvci/hoso?truyendulieu=' . $inputs['truyendulieu']);
    }

    public function show_hoso(Request $request)
    {
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = giaspdvci::where('mahs',$inputs['mahs'])->first();
        die($model);
    }

    public function congbo_danhmuc(Request $request)
    {
        $inputs = $request->all();
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $inputs['url'] = '/csdlquocgia/qg_giaspdvci/congbo_danhmuc';
        $model = giaspdvcidm::all();
        if ($inputs['truyendulieu'] != 'all')
            $model = $model->where('truyendulieu', $inputs['truyendulieu']);
        return view('csdlquocgia.qg_giaspdvci.truyendanhmuc.congbo')
            ->with('model', $model)
            ->with('inputs', $inputs)
            ->with('pageTitle', 'Công bố danh mục Giá dịch vụ thu gom, vận chuyển rác thải sinh hoạt');
    }

    public function congbo_hoso(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/csdlquocgia/qg_giaspdvci/congbo_hoso';
        $m_donvi = getDonViNhapLieu('ADMIN', 'giaspdvci');
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $model = giaspdvci::where('madv', $inputs['madv']);
        if ($inputs['nam'] != 'all')
            $model = $model->whereYear('thoidiem', $inputs['nam']);
        if ($inputs['truyendulieu'] != 'all')
            $model = $model->where('truyendulieu', $inputs['truyendulieu']);

        return view('csdlquocgia.qg_giaspdvci.truyenhoso.congbo')
            ->with('model', $model->get())
            ->with('inputs', $inputs)
            ->with('m_donvi', $m_donvi)
            ->with('pageTitle', 'Công bố hồ sơ kê khai Giá dịch vụ thu gom, vận chuyển rác thải sinh hoạt');
    }
}
