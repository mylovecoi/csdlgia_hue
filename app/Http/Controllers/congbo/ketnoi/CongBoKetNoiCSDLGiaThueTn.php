<?php

namespace App\Http\Controllers\congbo\ketnoi;

use App\Model\manage\dinhgia\thuetn\NhomThueTn;
use App\Model\manage\dinhgia\thuetn\ThueTaiNguyen;
use App\Model\system\dsdiaban;
use App\Model\system\view_dsdiaban_donvi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CongBoKetNoiCSDLGiaThueTn extends Controller
{
    // //Xây dựng các chức năng nhận hồ sơ từ pm csdl quốc gia
    // public function nhanhoso(Request $request)
    // {
    //     $inputs = $request->all();
    //     $inputs['url'] = '/cbketnoigiathuetn/nhanhoso';
    //     $inputs['nam'] = $inputs['nam'] ?? 'all';
    //     $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
    //     $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
    //     $m_donvi_th = getDonViTongHop('giathuetn', \session('admin')->level, \session('admin')->madiaban);
    //     $m_donvi = getDonViNhapLieu(session('admin')->level, 'giathuetn');
    //     if (count($m_donvi) == null) {
    //         $message = 'Chưa có đơn vị nào được phân quyền nhập liệu cho chức năng: ' . session('admin')['a_chucnang']['giathuetn']
    //             . '. Bạn cần liên hệ người quản trị để phần quyền nhập liệu cho đơn vị.';
    //         return  view('errors.403')
    //             ->with('message', $message);
    //     }
    //     $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
    //     $a_nhom = array_column(NhomThueTn::where('theodoi', 'TD')->get()->toarray(), 'tennhom', 'manhom');
    //     //lấy thông tin đơn vị
    //     $model = ThueTaiNguyen::where('madv', $inputs['madv']);
    //     if ($inputs['nam'] != 'all')
    //         $model = $model->whereYear('thoidiem', $inputs['nam']);
    //     return view('manage.dinhgia.thuetn.api.nhanhoso.index')
    //         ->with('model', $model->get())
    //         ->with('inputs', $inputs)
    //         ->with('m_diaban', $m_diaban)
    //         ->with('m_donvi', $m_donvi)
    //         ->with('a_nhom', $a_nhom)
    //         ->with('a_diaban', $a_diaban)
    //         ->with('a_dv', array_column($m_donvi->toarray(), 'tendv', 'madv'))
    //         ->with('m_donvi_th', $m_donvi_th)
    //         ->with('a_donvi_th', array_column($m_donvi_th->toarray(), 'tendv', 'madv'))
    //         ->with('a_diaban_th', array_column($m_donvi_th->toarray(), 'tendiaban', 'madiaban'))
    //         ->with('pageTitle', 'Thông tin giá thuế tài nguyên');
    // }

    // public function innhanhosocsdlqg(Request $request)
    // {
    //     $inputs = $request->all();
    //     $inputs['nam'] = $inputs['nam'] ?? 'all';
    //     $m_donvi = getDonViNhapLieu(session('admin')->level, 'giathuetn');
    //     if (count($m_donvi) == null) {
    //         $message = 'Chưa có đơn vị nào được phân quyền nhập liệu cho chức năng: ' . session('admin')['a_chucnang']['giathuetn']
    //             . '. Bạn cần liên hệ người quản trị để phần quyền nhập liệu cho đơn vị.';
    //         return  view('errors.403')
    //             ->with('message', $message);
    //     }
    //     $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
    //     $model = ThueTaiNguyen::where('madv', $inputs['madv']);
    //     if ($inputs['nam'] != 'all')
    //         $model = $model->whereYear('thoidiem', $inputs['nam']);
    //     return view('manage.dinhgia.thuetn.nhanhoso.BC1')
    //         ->with('model', $model->get())
    //         ->with('m_donvi', $m_donvi)
    //         ->with('pageTitle', 'Thông tin giá thuế tài nguyên');
    // }

    //Xây dựng các chức năng truyền danh mục
    public function truyendanhmuc(Request $request)
    {
        $inputs = $request->all();
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $inputs['url'] = '/cbketnoigiathuetn/danhmuc';
        $model = NhomThueTn::all();
        if ($inputs['truyendulieu'] != 'all')
            $model = $model->where('truyendulieu', $inputs['truyendulieu']);
        return view('manage.dinhgia.thuetn.api.truyendanhmuc.congbo')
            ->with('model', $model)
            ->with('inputs', $inputs)
            ->with('pageTitle', 'Truyền danh mục giá thuế tài nguyên');
    }

    // public function capnhatdanhmuc(Request $request)
    // {
    //     $inputs = $request->all();
    //     $model = NhomThueTn::where('manhom',$inputs['manhom'])->first();
    //     $model->update($inputs);
    //     return redirect('/cbketnoigiathuetn/danhmuc?truyendulieu=' . $inputs['truyendulieu']);
    // }

    // public function show_nhomdm(Request $request)
    // {
    //     if (!Session::has('admin')) {
    //         $result = array(
    //             'status' => 'fail',
    //             'message' => 'permission denied',
    //         );
    //         die(json_encode($result));
    //     }

    //     $inputs = $request->all();
    //     $model = NhomThueTn::where('manhom',$inputs['manhom'])->first();
    //     die($model);
    // }

    //Xây dựng các chức năng truyền hồ sơ kê khai
    public function truyenhoso(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/cbketnoigiathuetn/hoso';
        $m_donvi = getDonViNhapLieu('ADMIN', 'giathuetn');
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $a_nhom = array_column(NhomThueTn::where('theodoi', 'TD')->get()->toarray(), 'tennhom', 'manhom');
        $model = ThueTaiNguyen::where('madv', $inputs['madv']);
        if ($inputs['nam'] != 'all')
            $model = $model->whereYear('thoidiem', $inputs['nam']);
        if ($inputs['truyendulieu'] != 'all')
            $model = $model->where('truyendulieu', $inputs['truyendulieu']);

        return view('manage.dinhgia.thuetn.api.truyenhoso.congbo')
            ->with('model', $model->get())
            ->with('inputs', $inputs)
            ->with('a_nhom', $a_nhom)
            ->with('m_donvi', $m_donvi)
            ->with('pageTitle', 'Truyền hồ sơ kê khai giá thuế tài nguyên');
    }

    // public function capnhathoso(Request $request)
    // {
    //     $inputs = $request->all();
    //     $model = ThueTaiNguyen::where('mahs',$inputs['mahs'])->first();
    //     $model->update($inputs);
    //     return redirect('/cbketnoigiathuetn/hoso?truyendulieu=' . $inputs['truyendulieu']);
    // }

    // public function show_hoso(Request $request)
    // {
    //     if (!Session::has('admin')) {
    //         $result = array(
    //             'status' => 'fail',
    //             'message' => 'permission denied',
    //         );
    //         die(json_encode($result));
    //     }

    //     $inputs = $request->all();
    //     $model = ThueTaiNguyen::where('mahs',$inputs['mahs'])->first();
    //     die($model);
    // }
}
