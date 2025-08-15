<?php

namespace App\Http\Controllers\congbo\ketnoi;

use App\Model\manage\dinhgia\thuetn\NhomThueTn;
use App\Model\manage\dinhgia\thuetn\ThueTaiNguyen;
use App\Model\system\dsdiaban;
use App\Model\system\view_dsdiaban_donvi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class qg_giathuetn_cbController extends Controller
{
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

    public function truyendanhmuc(Request $request)
    {
        $inputs = $request->all();
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $inputs['url'] = '/qg_giathuetn_cb/danhmuc';
        $model = NhomThueTn::all();
        if ($inputs['truyendulieu'] != 'all')
            $model = $model->where('truyendulieu', $inputs['truyendulieu']);
        return view('csdlquocgia.qg_giathuetn.truyendanhmuc.congbo')
            ->with('model', $model)
            ->with('inputs', $inputs)
            ->with('pageTitle', 'Truyền danh mục giá thuế tài nguyên');
    }

    public function truyenhoso(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/qg_giathuetn_cb/hoso';
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

        return view('csdlquocgia.qg_giathuetn.truyenhoso.congbo')
            ->with('model', $model->get())
            ->with('inputs', $inputs)
            ->with('a_nhom', $a_nhom)
            ->with('m_donvi', $m_donvi)
            ->with('pageTitle', 'Truyền hồ sơ kê khai giá thuế tài nguyên');
    }
}
