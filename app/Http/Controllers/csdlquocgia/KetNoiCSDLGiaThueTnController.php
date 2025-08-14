<?php

namespace App\Http\Controllers\csdlquocgia;

use App\Model\manage\dinhgia\thuetn\NhomThueTn;
use App\Model\manage\dinhgia\thuetn\ThueTaiNguyen;
use App\Model\system\dsdiaban;
use App\Model\system\view_dsdiaban_donvi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class KetNoiCSDLGiaThueTnController extends Controller
{
    //Xây dựng các chức năng nhận hồ sơ từ pm csdl quốc gia
    public function nhanhoso(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/ketnoigiathuetn/nhanhoso';
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
        $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
        $m_donvi_th = getDonViTongHop('giathuetn', \session('admin')->level, \session('admin')->madiaban);
        $m_donvi = getDonViNhapLieu(session('admin')->level, 'giathuetn');
        if (count($m_donvi) == null) {
            $message = 'Chưa có đơn vị nào được phân quyền nhập liệu cho chức năng: ' . session('admin')['a_chucnang']['giathuetn']
                . '. Bạn cần liên hệ người quản trị để phần quyền nhập liệu cho đơn vị.';
            return  view('errors.403')
                ->with('message', $message);
        }
        $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
        $a_nhom = array_column(NhomThueTn::where('theodoi', 'TD')->get()->toarray(), 'tennhom', 'manhom');
        //lấy thông tin đơn vị
        $model = ThueTaiNguyen::where('madv', $inputs['madv']);
        if ($inputs['nam'] != 'all')
            $model = $model->whereYear('thoidiem', $inputs['nam']);
        return view('manage.dinhgia.thuetn.api.nhanhoso.index')
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
            ->with('pageTitle', 'Nhận hồ sơ giá thuế tài nguyên');
    }

    public function innhanhosocsdlqg(Request $request)
    {
        $inputs = $request->all();
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $m_donvi = getDonViNhapLieu(session('admin')->level, 'giathuetn');
        if (count($m_donvi) == null) {
            $message = 'Chưa có đơn vị nào được phân quyền nhập liệu cho chức năng: ' . session('admin')['a_chucnang']['giathuetn']
                . '. Bạn cần liên hệ người quản trị để phần quyền nhập liệu cho đơn vị.';
            return  view('errors.403')
                ->with('message', $message);
        }
        $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
        $model = ThueTaiNguyen::where('madv', $inputs['madv']);
        if ($inputs['nam'] != 'all')
            $model = $model->whereYear('thoidiem', $inputs['nam']);
        return view('manage.dinhgia.thuetn.nhanhoso.BC1')
            ->with('model', $model->get())
            ->with('m_donvi', $m_donvi)
            ->with('pageTitle', 'Nhận hồ sơ giá thuế tài nguyên');
    }

    //Xây dựng các chức năng truyền danh mục
    public function truyendanhmuc(Request $request)
    {
        $inputs = $request->all();
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $inputs['url'] = '/ketnoigiathuetn/danhmuc';
        $model = NhomThueTn::all();
        if ($inputs['truyendulieu'] != 'all')
            $model = $model->where('truyendulieu', $inputs['truyendulieu']);
        return view('manage.dinhgia.thuetn.api.truyendanhmuc.index')
            ->with('model', $model)
            ->with('inputs', $inputs)
            ->with('pageTitle', 'Truyền danh mục giá thuế tài nguyên');
    }

    public function capnhatdanhmuc(Request $request)
    {
        $inputs = $request->all();
        $model = NhomThueTn::where('manhom',$inputs['manhom'])->first();
        $model->update($inputs);
        return redirect('/ketnoigiathuetn/danhmuc?truyendulieu=' . $inputs['truyendulieu']);
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
        $model = NhomThueTn::where('manhom',$inputs['manhom'])->first();
        die($model);
    }

    //Xây dựng các chức năng truyền hồ sơ kê khai
    public function truyenhoso(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/ketnoigiathuetn/hoso';
        $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
        $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
        $m_donvi = getDonViXetDuyet(session('admin')->level);
        $m_donvi_th = getDonViTongHop('giathuetn', \session('admin')->level, \session('admin')->madiaban);
        $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
        $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $inputs['level'] = $m_donvi_th->where('madv', $inputs['madv'])->first()->level ?? 'H';
        $a_ttdv = array_column(
            view_dsdiaban_donvi::wherein('madiaban', array_keys($a_diaban))->get()->toarray(),
            'tendv',
            'madv'
        );

        switch ($inputs['level']) {
            case 'H': {
                    $model = ThueTaiNguyen::where('madv_h', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('thoidiem_h', $inputs['nam']);
                    if ($inputs['truyendulieu'] != 'all')
                        $model = $model->where('truyendulieu', $inputs['truyendulieu']);
                    $model = $model->get();
                    foreach ($model as $ct) {
                        $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct);
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
            case 'T': {
                    $model = ThueTaiNguyen::where('madv_t', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('thoidiem_t', $inputs['nam']);
                    if ($inputs['truyendulieu'] != 'all')
                        $model = $model->where('truyendulieu', $inputs['truyendulieu']);
                    $model = $model->get();
                    foreach ($model as $ct) {
                        $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct);
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
            case 'ADMIN': {
                    $model = ThueTaiNguyen::where('madv_ad', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('thoidiem_ad', $inputs['nam']);
                    if ($inputs['truyendulieu'] != 'all')
                        $model = $model->where('truyendulieu', $inputs['truyendulieu']);
                    $model = $model->get();
                    foreach ($model as $ct) {
                        $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct);
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
        $a_tt = array_column(NhomThueTn::all()->toArray(), 'tennhom', 'manhom');
        return view('manage.dinhgia.thuetn.api.truyenhoso.index')
            ->with('model', $model)
            ->with('inputs', $inputs)
            ->with('m_diaban', $m_diaban)
            ->with('a_tt', $a_tt)
            ->with('a_diaban', array_column($m_diaban->where('level', 'H')->toarray(), 'tendiaban', 'madiaban'))
            ->with('m_donvi', $m_donvi)
            ->with('m_donvi_th', $m_donvi_th->where('madv', '<>', $inputs['madv']))
            ->with('a_donvi_th', array_column($m_donvi_th->toarray(), 'tendv', 'madv'))
            ->with('a_diaban_th', array_column($m_donvi_th->toarray(), 'tendiaban', 'madiaban'))
            ->with('pageTitle', 'Truyền hồ sơ kê khai giá thuế tài nguyên');
    }

    public function capnhathoso(Request $request)
    {
        $inputs = $request->all();
        $model = ThueTaiNguyen::where('mahs',$inputs['mahs'])->first();
        $model->update($inputs);
        return redirect('/ketnoigiathuetn/hoso?truyendulieu=' . $inputs['truyendulieu']);
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
        $model = ThueTaiNguyen::where('mahs',$inputs['mahs'])->first();
        die($model);
    }
}
