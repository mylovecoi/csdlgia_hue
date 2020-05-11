<?php

namespace App\Http\Controllers\manage\giathan;

use App\Model\system\dmnganhnghekd\DmNgheKd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GiaThanController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $inputs['url'] = '/giathan';
            $model = DmNgheKd::where('manghe','THAN')->get();
            $a_phanloai = array('DK'=>'Đăng ký giá','KK'=>'Kê khai giá');
            return view('manage.giathan.danhmuc.index')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('a_phanloai',$a_phanloai)
                ->with('pageTitle','Thông tin mặt hàng than');
        }else
            return view('errors.notlogin');
    }

    public function update(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            //dd($inputs);
            DmNgheKd::where('manghe',$inputs['manghe'])->first()->update($inputs);
            return redirect('/giathan/mathang');
        }else
            return view('errors.notlogin');
    }
}
