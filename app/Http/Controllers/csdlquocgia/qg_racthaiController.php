<?php

namespace App\Http\Controllers\csdlquocgia;

use App\DkgDoanhnghiep;
use App\DmMhBinhOnGia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class qg_racthaiController extends Controller
{
    public function danhmuc(Request $request){       
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
            $m_dv = DkgDoanhnghiep::where('phanloai',$inputs['ma'])->get();
            $tenhh = DmMhBinhOnGia::where('phanloai',$inputs['ma'])->first()->hienthi;
            return view('manage.bog.dangky.reports.index')
                ->with('m_dv',$m_dv)
                ->with('nam', $inputs['nam'])
                ->with('tenhh',$tenhh)
                ->with('phanloai',$inputs['ma'])
                ->with('pageTitle', 'Danh mục dịch vụ thu gom rác thải');
        }else
            return view('errors.notlogin');
    }

    public function hoso(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
            $m_dv = DkgDoanhnghiep::where('phanloai',$inputs['ma'])->get();
            $tenhh = DmMhBinhOnGia::where('phanloai',$inputs['ma'])->first()->hienthi;
            return view('manage.bog.dangky.reports.index')
                ->with('m_dv',$m_dv)
                ->with('nam', $inputs['nam'])
                ->with('tenhh',$tenhh)
                ->with('phanloai',$inputs['ma'])
                ->with('pageTitle', 'Hồ sơ giá dịch vụ thu gom rác thải');
        }else
            return view('errors.notlogin');
    }
    
    
}
