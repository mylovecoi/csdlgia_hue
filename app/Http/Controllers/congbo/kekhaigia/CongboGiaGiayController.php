<?php

namespace App\Http\Controllers\congbo\kekhaigia;

use App\Model\manage\kekhaigia\kkgiatacn\KkGiaTaCn;
use App\Model\manage\kekhaigia\kkgiay\KkGiaGiay;
use App\Model\system\dsdiaban;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CongboGiaGiayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $m_donvi = getDoanhNghiepNhapLieu('SSA', 'THAN');
        $m_diaban = dsdiaban::wherein('madiaban', array_column($m_donvi->toarray(),'madiaban'))->get();
        $inputs = $request->all();
        $inputs['url'] = '/cbgiay';
        $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
        if(count($m_donvi) == 0){
            $inputs['madv'] = isset($inputs['madv']) ? $inputs['madv'] : null;
        }else{
            $inputs['madv'] = isset($inputs['madv']) ? $inputs['madv'] : $m_donvi->first()->madv;
        }


        //$inputs['paginate'] = isset($inputs['paginate']) ? $inputs['paginate'] : 5;
        $model = KkGiaGiay::join('kkgiagiayct','kkgiagiay.mahs','=','kkgiagiayct.mahs')
            ->where('kkgiagiay.trangthai','CB')->where('kkgiagiay.madv',$inputs['madv']);

        if ($inputs['nam'] != 'all')
            $model = $model->whereYear('ngayhieuluc', $inputs['nam']);

        return view('congbo.KeKhaiGia.GiaGiay.index')
            ->with('model',$model->get())
            ->with('m_donvi',$m_donvi)
            ->with('m_diaban',$m_diaban)
            ->with('inputs',$inputs)
            ->with('pageTitle','Thông tin kê khai giá TACN');

    }

}
