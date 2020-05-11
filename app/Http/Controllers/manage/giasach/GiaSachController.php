<?php

namespace App\Http\Controllers\manage\giasach;

use App\Model\system\dmnganhnghekd\DmNgheKd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GiaSachController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $inputs['url'] = '/giasach';
            $model = DmNgheKd::where('manghe','SACH')->get();
            $a_phanloai = array('DK'=>'Đăng ký giá','KK'=>'Kê khai giá');
            return view('manage.giasach.danhmuc.index')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('a_phanloai',$a_phanloai)
                ->with('pageTitle','Thông tin mặt hàng sách');
        }else
            return view('errors.notlogin');
    }

    public function update(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            //dd($inputs);
            DmNgheKd::where('manghe',$inputs['manghe'])->first()->update($inputs);
            return redirect('/giasach/mathang');
        }else
            return view('errors.notlogin');
    }
}
