<?php

namespace App\Http\Controllers\csdlquocgia;

use App\Model\system\dsdiaban;
use App\Model\system\dmdvt;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\manage\dinhgia\giahhdvcn\giahhdvcn;
use App\Model\manage\dinhgia\giahhdvcn\giahhdvcndm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class qg_giahhdvcnController extends Controller
{
    public function nhandanhmuc(Request $request){
        $model = giahhdvcndm::all();
        $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
        $inputs['url'] = '/qg_giahhdvcn/nhandanhmuc';
        return view('csdlquocgia.qg_giahhdvcn.nhandanhmuc.index')
            ->with('model',$model)
            ->with('a_dvt',$a_dvt)
            ->with('inputs',$inputs)
            ->with('pageTitle','Danh mục hàng hóa, dịch vụ khác');
    }

    public function nhanhoso(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/qg_giahhdvcn/nhanhoso';
        $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
        $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
        $m_donvi = getDonViNhapLieu(session('admin')->level,'giahhdvcn');
        if (count($m_donvi) == null) {
            $message = 'Chưa có đơn vị nào được phân quyền nhập liệu cho chức năng: ' . session('admin')['a_chucnang']['giahhdvcn']
                . '. Bạn cần liên hệ người quản trị để phần quyền nhập liệu cho đơn vị.';
            return  view('errors.403')
                ->with('message', $message);
        }
        $m_donvi_th = getDonViTongHop('giahhdvcn',\session('admin')->level, \session('admin')->madiaban);
        $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
        $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $model = giahhdvcn::where('madv', $inputs['madv']);
        if ($inputs['nam'] != 'all')
            $model = $model->whereYear('thoidiem', $inputs['nam']);
        return view('csdlquocgia.qg_giahhdvcn.nhanhoso.index')
            ->with('model', $model->get())
            ->with('inputs', $inputs)
            ->with('m_diaban', $m_diaban)
            ->with('a_diaban', array_column($m_diaban->where('level', 'H')->toarray(), 'tendiaban', 'madiaban'))
            ->with('m_donvi', $m_donvi)
            ->with('m_donvi_th', $m_donvi_th)
            ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
            ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
            ->with('pageTitle', 'Nhận hồ sơ giá hàng hóa, dịch vụ chuyên ngành');
    }

    public function truyendanhmuc(Request $request)
    {
        $model = giahhdvcndm::all();
        $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
        $inputs['url'] = '/qg_giahhdvcn/danhmuc';
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        if ($inputs['truyendulieu'] != 'all')
            $model = $model->where('truyendulieu', $inputs['truyendulieu']);
        return view('csdlquocgia.qg_giahhdvcn.truyendanhmuc.index')
            ->with('model',$model)
            ->with('a_dvt',$a_dvt)
            ->with('inputs',$inputs)
            ->with('pageTitle','Danh mục hàng hóa, dịch vụ khác');
    }

    public function capnhatdanhmuc(Request $request)
    {
        $inputs = $request->all();
        $model = giahhdvcndm::where('maspdv',$inputs['maspdv'])->first();
        $model->update($inputs);
        return redirect('/qg_giahhdvcn/danhmuc?truyendulieu=' . $inputs['truyendulieu']);
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
        $model = giahhdvcndm::where('maspdv',$inputs['maspdv'])->first();
        die($model);
    }

    //Xây dựng các chức năng truyền hồ sơ kê khai
    public function truyenhoso(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/qg_giahhdvcn/hoso';
        $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
        $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();

        $m_donvi = getDonViXetDuyet(session('admin')->level);
        $m_donvi_th = getDonViTongHop('giahhdvcn',\session('admin')->level, \session('admin')->madiaban);
        $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
        $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $inputs['level'] = $m_donvi_th->where('madv', $inputs['madv'])->first()->level ?? 'H';
        $a_ttdv = array_column(view_dsdiaban_donvi::wherein('madiaban', array_keys($a_diaban))->get()->toarray(),
            'tendv', 'madv');

        switch ($inputs['level']){
            case 'H':{
                $model = giahhdvcn::where('madv_h', $inputs['madv']);
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
                $model = giahhdvcn::where('madv_t', $inputs['madv']);
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
                $model = giahhdvcn::where('madv_ad', $inputs['madv']);
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
        //dd($model);
        return view('csdlquocgia.qg_giahhdvcn.truyenhoso.index')
            ->with('model', $model)
            ->with('inputs', $inputs)
            ->with('m_diaban', $m_diaban)
            ->with('a_diaban', array_column($m_diaban->where('level', 'H')->toarray(), 'tendiaban', 'madiaban'))
            ->with('m_donvi', $m_donvi)
            ->with('m_donvi_th', $m_donvi_th->where('madv','<>',$inputs['madv']))
            ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
            ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
            ->with('pageTitle', 'Thông tin hồ sơ');
    }

    public function capnhathoso(Request $request)
    {
        $inputs = $request->all();
        $model = giahhdvcn::where('mahs',$inputs['mahs'])->first();
        $model->update($inputs);
        return redirect('/qg_giahhdvcn/hoso?truyendulieu=' . $inputs['truyendulieu']);
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
        $model = giahhdvcn::where('mahs',$inputs['mahs'])->first();
        die($model);
    }
}
