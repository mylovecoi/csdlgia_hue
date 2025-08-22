<?php

namespace App\Http\Controllers\csdlquocgia;

use App\Model\system\dsdiaban;
use App\Model\system\view_dsdiaban_donvi;
use App\NhomHhDvK;
use App\GiaHhDvK;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class qg_giahhdvkController extends Controller
{
    public function nhandanhmuc(Request $request){
        $model = NhomHhDvK::all();
        $inputs['url'] = '/csdlquocgia/qg_giahhdvk/nhandanhmuc';
        return view('csdlquocgia.qg_giahhdvk.nhandanhmuc.index')
            ->with('model',$model)
            ->with('inputs',$inputs)
            ->with('pageTitle','Danh mục Giá hàng hóa, dịch vụ thị trường');
    }

    public function nhanhoso(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/csdlquocgia/qg_giahhdvk/nhanhoso';
        $a_diaban = getDiaBan_NhapLieu(session('admin')->level, session('admin')->madiaban);
        $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
        $m_donvi_th = getDonViTongHop('giahhdvk', \session('admin')->level, \session('admin')->madiaban);
        $inputs['madiaban'] = $inputs['madiaban'] ?? array_key_first($a_diaban);
        $m_donvi = getDonViNhapLieu(session('admin')->level, 'giahhdvk');
        if (count($m_donvi) == null) {
            $message = 'Chưa có đơn vị nào được phân quyền nhập liệu cho chức năng: ' . session('admin')['a_chucnang']['giahhdvk']
                . '. Bạn cần liên hệ người quản trị để phần quyền nhập liệu cho đơn vị.';
            return  view('errors.403')
                ->with('message', $message);
        }

        foreach ($m_donvi as $key => $donvi) {
            $chkDiaBan = $m_diaban->where('madiaban', $donvi->madiaban);
            if ($chkDiaBan->count() == 0) {
                $m_donvi->forget($key);
            }
        }

        $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
        $a_nhom = array_column(NhomHhDvK::where('theodoi', 'TD')->get()->toarray(), 'tentt', 'matt');
        
        $inputs['thang'] = isset($inputs['thang']) ? $inputs['thang'] : date('m');
        $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
        
        $model = GiaHhDvK::where('madv', $inputs['madv']);
        if ($inputs['thang'] != 'all')
            $model = $model->where('thang', $inputs['thang']);
        if ($inputs['nam'] != 'all')
            $model = $model->where('nam', $inputs['nam']);
        return view('csdlquocgia.qg_giahhdvk.nhanhoso.index')
            ->with('model', $model->get())
            ->with('inputs', $inputs)
            ->with('m_diaban', $m_diaban)
            ->with('m_donvi', $m_donvi)
            ->with('a_nhom', $a_nhom)
            ->with('a_diaban', $a_diaban)
            ->with('a_dv', array_column($m_donvi->toarray(), 'tendv', 'madv'))
            ->with('m_donvi_th', $m_donvi_th)
            ->with('a_donvi_th', array_column($m_donvi_th->toarray(), 'tendv', 'madv'))
            ->with('a_diaban_th', array_column($m_donvi_th->toarray(), 'tendiaban', 'madiaban'))
            ->with('pageTitle', 'Nhận hồ sơ Giá hàng hóa, dịch vụ thị trường');
    }

    public function chuyenhs(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = GiaHhDvK::where('mahs', $inputs['mahs'])->first();
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
            //kiểm tra đơn vị tiếp nhận
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
            return redirect('/csdlquocgia/qg_giahhdvk/nhanhoso?madv=' . $model->madv);
        } else
            return view('errors.notlogin');
    }

    public function innhanhosocsdlqg(Request $request)
    {
        $inputs = $request->all();
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $m_donvi = getDonViNhapLieu(session('admin')->level, 'giahhdvk');
        if (count($m_donvi) == null) {
            $message = 'Chưa có đơn vị nào được phân quyền nhập liệu cho chức năng: ' . session('admin')['a_chucnang']['giahhdvk']
                . '. Bạn cần liên hệ người quản trị để phần quyền nhập liệu cho đơn vị.';
            return  view('errors.403')
                ->with('message', $message);
        }
        $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
        $model = GiaHhDvK::where('madv', $inputs['madv']);
        if ($inputs['nam'] != 'all')
            $model = $model->whereYear('thoidiem', $inputs['nam']);
        return view('csdlquocgia.qg_giahhdvk.nhanhoso.BC1')
            ->with('model', $model->get())
            ->with('m_donvi', $m_donvi)
            ->with('pageTitle', 'Nhận hồ sơ Giá hàng hóa, dịch vụ thị trường');
    }

    public function truyendanhmuc(Request $request)
    {
        $inputs = $request->all();
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $inputs['url'] = '/csdlquocgia/qg_giahhdvk/danhmuc';
        $model = NhomHhDvK::all();
        if ($inputs['truyendulieu'] != 'all')
            $model = $model->where('truyendulieu', $inputs['truyendulieu']);
        return view('csdlquocgia.qg_giahhdvk.truyendanhmuc.index')
            ->with('model', $model)
            ->with('inputs', $inputs)
            ->with('pageTitle', 'Truyền danh mục Giá hàng hóa, dịch vụ thị trường');
    }

    public function capnhatdanhmuc(Request $request)
    {
        $inputs = $request->all();
        $model = NhomHhDvK::where('matt',$inputs['matt'])->first();
        $model->update($inputs);
        return redirect('/csdlquocgia/qg_giahhdvk/danhmuc?truyendulieu=' . $inputs['truyendulieu']);
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
        $model = NhomHhDvK::where('matt',$inputs['matt'])->first();
        die($model);
    }

    public function truyenhoso(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/csdlquocgia/qg_giahhdvk/hoso';
        $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
        $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();

        $m_donvi = getDonViXetDuyet(session('admin')->level);
        $m_donvi_th = getDonViTongHop('giahhdvk', \session('admin')->level, \session('admin')->madiaban);

        $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
        $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
        $inputs['thang'] = isset($inputs['thang']) ? $inputs['thang'] : date('m');
        $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $inputs['level'] = view_dsdiaban_donvi::where('madv', $inputs['madv'])->first()->level ?? 'H';
        $a_ttdv = array_column(
            view_dsdiaban_donvi::wherein('madiaban', array_keys($a_diaban))->get()->toarray(),
            'tendv',
            'madv'
        );
        switch ($inputs['level']) {
            case 'H': {
                $model = GiaHhDvK::where('madv_h', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->where('nam', $inputs['nam']);
                if ($inputs['thang'] != 'all')
                    $model = $model->where('thang', $inputs['thang']);
                if ($inputs['truyendulieu'] != 'all')
                        $model = $model->where('truyendulieu', $inputs['truyendulieu']);

                $model = $model->orderby('nam')->orderby('thang')->get();
                foreach ($model as $ct) {
                    $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct);
                    $ct->tendv_ch = $a_ttdv[$ct->madv_ch] ?? '';
                    $ct->madv = $ct->madv_h;
                    $ct->macqcq = $ct->macqcq_h;
                    $ct->tencqcq = $a_ttdv[$ct->madv] ?? '';
                    $ct->thoidiem = $ct->thoidiem_h;
                    $ct->trangthai = $ct->trangthai_h;
                    $ct->level = $inputs['level'];
                }
                break;
            }
            case 'T': {
                $model = GiaHhDvK::where('madv_t', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->where('nam', $inputs['nam']);
                if ($inputs['thang'] != 'all')
                    $model = $model->where('thang', $inputs['thang']);
                if ($inputs['truyendulieu'] != 'all')
                        $model = $model->where('truyendulieu', $inputs['truyendulieu']);

                $model = $model->orderby('nam')->orderby('thang')->get();
                foreach ($model as $ct) {
                    $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct);
                    $ct->tendv_ch = $a_ttdv[$ct->madv_ch] ?? '';
                    $ct->madv = $ct->madv_t;
                    $ct->macqcq = $ct->macqcq_t;
                    $ct->tencqcq = $a_ttdv[$ct->madv] ?? '';
                    $ct->thoidiem = $ct->thoidiem_t;
                    $ct->trangthai = $ct->trangthai_t;
                    $ct->level = $inputs['level'];
                }
                break;
            }
            case 'ADMIN': {
                $model = GiaHhDvK::where('madv_ad', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->where('nam', $inputs['nam']);
                if ($inputs['thang'] != 'all')
                    $model = $model->where('thang', $inputs['thang']);
                if ($inputs['truyendulieu'] != 'all')
                        $model = $model->where('truyendulieu', $inputs['truyendulieu']);
                $model = $model->orderby('nam')->orderby('thang')->get();
                foreach ($model as $ct) {
                    $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct);
                    $ct->tendv_ch = $a_ttdv[$ct->madv_ch] ?? '';
                    $ct->madv = $ct->madv_ad;
                    $ct->macqcq = $ct->macqcq_ad;
                    $ct->tencqcq = $a_ttdv[$ct->madv] ?? '';
                    $ct->thoidiem = $ct->thoidiem_ad;
                    $ct->trangthai = $ct->trangthai_ad;
                    $ct->level = $inputs['level'];
                }
                break;
            }
        }
        $a_tt = array_column(NhomHhDvK::all()->toArray(), 'tentt', 'matt');
        return view('csdlquocgia.qg_giahhdvk.truyenhoso.index')
            ->with('model', $model)
            ->with('inputs', $inputs)
            ->with('m_diaban', $m_diaban)
            ->with('a_tt', $a_tt)
            ->with('a_diaban', array_column($m_diaban->where('level', 'H')->toarray(), 'tendiaban', 'madiaban'))
            ->with('m_donvi', $m_donvi)
            ->with('m_donvi_th', $m_donvi_th->where('madv', '<>', $inputs['madv']))
            ->with('a_donvi_th', array_column($m_donvi_th->toarray(), 'tendv', 'madv'))
            ->with('a_diaban_th', array_column($m_donvi_th->toarray(), 'tendiaban', 'madiaban'))
            ->with('pageTitle', 'Truyền hồ sơ kê khai Giá hàng hóa, dịch vụ thị trường');
    }

    public function capnhathoso(Request $request)
    {
        $inputs = $request->all();
        $model = GiaHhDvK::where('mahs',$inputs['mahs'])->first();
        $model->update($inputs);
        return redirect('/csdlquocgia/qg_giahhdvk/hoso?truyendulieu=' . $inputs['truyendulieu']);
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
        $model = GiaHhDvK::where('mahs',$inputs['mahs'])->first();
        die($model);
    }

    public function congbo_danhmuc(Request $request)
    {
        $inputs = $request->all();
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $inputs['url'] = '/csdlquocgia/qg_giahhdvk/congbo_danhmuc';
        $model = NhomHhDvK::all();
        if ($inputs['truyendulieu'] != 'all')
            $model = $model->where('truyendulieu', $inputs['truyendulieu']);
        return view('csdlquocgia.qg_giahhdvk.truyendanhmuc.congbo')
            ->with('model', $model)
            ->with('inputs', $inputs)
            ->with('pageTitle', 'Công bố danh mục Giá hàng hóa, dịch vụ thị trường');
    }

    public function congbo_hoso(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/csdlquocgia/qg_giahhdvk/congbo_hoso';
        $m_donvi = getDonViNhapLieu('ADMIN', 'giahhdvk');
        $inputs['thang'] = isset($inputs['thang']) ? $inputs['thang'] : date('m');
        $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
        $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $a_nhom = array_column(NhomHhDvK::where('theodoi', 'TD')->get()->toarray(), 'tentt', 'matt');
        $model = GiaHhDvK::where('madv', $inputs['madv']);
        if ($inputs['nam'] != 'all')
            $model = $model->where('nam', $inputs['nam']);
        if ($inputs['thang'] != 'all')
            $model = $model->where('thang', $inputs['thang']);
        if ($inputs['truyendulieu'] != 'all')
            $model = $model->where('truyendulieu', $inputs['truyendulieu']);

        return view('csdlquocgia.qg_giahhdvk.truyenhoso.congbo')
            ->with('model', $model->get())
            ->with('inputs', $inputs)
            ->with('a_nhom', $a_nhom)
            ->with('m_donvi', $m_donvi)
            ->with('pageTitle', 'Công bố hồ sơ kê khai Giá hàng hóa, dịch vụ thị trường');
    }
}
