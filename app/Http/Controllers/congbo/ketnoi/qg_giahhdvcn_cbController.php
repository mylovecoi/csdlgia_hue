<?php

namespace App\Http\Controllers\congbo\ketnoi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\manage\dinhgia\giahhdvcn\giahhdvcn;
use App\Model\manage\dinhgia\giahhdvcn\giahhdvcndm;

class qg_giahhdvcn_cbController extends Controller
{
    public function truyendanhmuc(Request $request)
    {
        $inputs = $request->all();
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $inputs['url'] = '/qg_giahhdvcn_cb/danhmuc';
        $model = giahhdvcndm::all();
        if ($inputs['truyendulieu'] != 'all')
            $model = $model->where('truyendulieu', $inputs['truyendulieu']);
        return view('csdlquocgia.qg_giahhdvcn.truyendanhmuc.congbo')
            ->with('model', $model)
            ->with('inputs', $inputs)
            ->with('pageTitle', 'Truyền danh mục giá hàng hóa dịch vụ chuyên ngành');
    }

    public function truyenhoso(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/qg_giahhdvcn_cb/hoso';
        $m_donvi = getDonViNhapLieu('ADMIN', 'giahhdvcn');
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $model = giahhdvcn::where('madv', $inputs['madv']);
        if ($inputs['nam'] != 'all')
            $model = $model->whereYear('thoidiem', $inputs['nam']);
        if ($inputs['truyendulieu'] != 'all')
            $model = $model->where('truyendulieu', $inputs['truyendulieu']);

        return view('csdlquocgia.qg_giahhdvcn.truyenhoso.congbo')
            ->with('model', $model->get())
            ->with('inputs', $inputs)
            ->with('m_donvi', $m_donvi)
            ->with('pageTitle', 'Truyền hồ sơ kê khai giá hàng hóa dịch vụ chuyên ngành');
    }
}
