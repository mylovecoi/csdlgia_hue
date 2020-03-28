<?php

namespace App\Http\Controllers\manage\binhongia;

use App\Model\system\dmnganhnghekd\DmNgheKd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class MatHangBogController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $inputs['url'] = '/binhongia';
            $model = DmNgheKd::where('manganh','BOG')->get();
            $a_phanloai = array('DK'=>'Đăng ký giá','KK'=>'Kê khai giá');
            return view('manage.bog.danhmuc.index')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('a_phanloai',$a_phanloai)
                ->with('pageTitle','Thông tin mặt hàng bình ổn giá');
        }else
            return view('errors.notlogin');
    }

    public function update(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            //dd($inputs);
            DmNgheKd::where('manghe',$inputs['manghe'])->first()->update($inputs);
            return redirect('/binhongia/mathang');
        }else
            return view('errors.notlogin');
    }
}
