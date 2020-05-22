<?php

namespace App\Http\Controllers\manage\giagiay;

use App\Model\system\dmnganhnghekd\DmNgheKd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GiaGiayController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $inputs['url'] = '/giagiay';
            $model = DmNgheKd::where('manghe','GIAY')->get();
            $a_phanloai = array('DK'=>'Đăng ký giá','KK'=>'Kê khai giá');
            return view('manage.giagiay.danhmuc.index')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('a_phanloai',$a_phanloai)
                ->with('pageTitle','Thông tin mặt hàng giấy');
        }else
            return view('errors.notlogin');
    }

    public function update(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            DmNgheKd::where('manghe',$inputs['manghe'])->first()->update($inputs);
            return redirect('/giagiay/mathang');
        }else
            return view('errors.notlogin');
    }
}
