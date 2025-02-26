<?php

namespace App\Http\Controllers\csdlquocgia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\manage\dinhgia\thuetn\NhomThueTn;
use App\Model\manage\dinhgia\thuetn\ThueTaiNguyen;
use Illuminate\Support\Facades\Session;

class qg_thuetainguyenController extends Controller
{
    public function danhmuc(Request $request){       
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['maso'] = 'dmgiahhdvk';
            $model = NhomThueTn::all();
            return view('csdlquocgia.qg_thuetainguyen.danhmuc')                
                ->with('model', $model)
                ->with('inputs',$inputs)
                ->with('pageTitle', 'Danh mục thuế tài nguyên');
        }else
            return view('errors.notlogin');
    }

    public function hoso(Request $request){
        if (Session::has('admin')) {
            //giahhdvk;
            //$HoSo = ThGiaHhDvK::where('mahs', $mahs)->get();
            $inputs = $request->all();
            $inputs['maso'] = 'giahhdvk';
            $model = ThueTaiNguyen::all();
            return view('csdlquocgia.qg_thuetainguyen.hoso')
            ->with('inputs',$inputs)
            ->with('model', $model)
                ->with('pageTitle', 'Hồ sơ giá thuế tài nguyên');
        }else
            return view('errors.notlogin');
    }
    
    
}
