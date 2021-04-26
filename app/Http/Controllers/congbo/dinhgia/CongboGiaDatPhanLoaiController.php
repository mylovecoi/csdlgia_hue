<?php

namespace App\Http\Controllers\congbo\dinhgia;

use App\DiaBanHd;
use App\GiaDatDiaBanDm;
use App\GiaThueDatNuoc;
use App\Model\manage\dinhgia\giadatphanloai\GiaDatPhanLoai;
use App\Model\system\dsdiaban;
use App\Model\view\view_giadatphanloai;
use App\Model\view\view_giathuedatnuoc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CongboGiaDatPhanLoaiController extends Controller
{
    public function index(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/cbgiadatpl';
        $a_diaban = getDiaBan_XaHuyen('ADMIN');
        $inputs['madiaban'] = $inputs['madiaban'] ?? array_key_first($a_diaban);
        $inputs['nam'] = $inputs['nam'] ?? 'all';

        $model = view_giadatphanloai::where('congbo', 'DACONGBO');
        $model_dk = GiaDatPhanLoai::where('congbo', 'DACONGBO');
        if ($inputs['nam'] != 'all'){
            $model = $model->whereYear('thoidiem', $inputs['nam']);
            $model_dk = $model_dk->whereYear('thoidiem', $inputs['nam']);
        }
        $model = $model->get();
        $model_dk = $model_dk->where('ipf1','<>', '')->get();

        return view('congbo.DinhGia.GiaDatPhanLoai.index')
            ->with('model', $model)
            ->with('model_dk', $model_dk)
            ->with('inputs', $inputs)
            ->with('a_diaban', $a_diaban)
            ->with('a_loaidat',array_column(GiaDatDiaBanDm::all()->toArray(),'loaidat','maloaidat'))
            ->with('pageTitle','Thông tin hồ sơ giá đất phân loại');
    }

}
