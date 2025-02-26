<?php

namespace App\Http\Controllers\csdlquocgia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NhomHhDvK;
use App\ThGiaHhDvK;
use Illuminate\Support\Facades\Session;

class qg_giathitruongController extends Controller
{
    public function danhmuc(Request $request){       
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['maso'] = 'dmgiahhdvk';
            $model = NhomHhDvK::all();
            return view('csdlquocgia.qg_giathitruong.danhmuc')                
                ->with('model', $model)
                ->with('inputs',$inputs)
                ->with('pageTitle', 'Danh mục hàng hoá thị trường');
        }else
            return view('errors.notlogin');
    }

    public function hoso(Request $request){
        if (Session::has('admin')) {
            //giahhdvk;
            //$HoSo = ThGiaHhDvK::where('mahs', $mahs)->get();
            $inputs = $request->all();
            $inputs['maso'] = 'giahhdvk';
            $model = ThGiaHhDvK::all();
            return view('csdlquocgia.qg_giathitruong.hoso')
            ->with('inputs',$inputs)
            ->with('model', $model)
                ->with('pageTitle', 'Hồ sơ giá hàng hoá thị trường');
        }else
            return view('errors.notlogin');
    }
    
    
}
