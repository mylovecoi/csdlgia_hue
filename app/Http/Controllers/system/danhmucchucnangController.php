<?php

namespace App\Http\Controllers\system;

use App\Model\system\danhmucchucnang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class danhmucchucnangController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'chucnang', 'index')) {
                return view('errors.noperm');
            }
            $gui = getGiaoDien();
            $a_chucnang = array_column(danhmucchucnang::all()->toArray(),'menu','maso');
            //dd($model);
            return view('system.chucnang.index')
                ->with('setting', $gui)
                ->with('a_chucnang', $a_chucnang)
                ->with('pageTitle', 'Danh sách chức năng phần mềm');
        } else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $check = danhmucchucnang::where('maso',$inputs['maso'])->first();

            if ($check == null) {
                danhmucchucnang::create($inputs);
            } else {
                $check->update($inputs);
            }
            return redirect('/chucnang/danhsach');
        }else
            return view('errors.notlogin');
    }

    public function edit(Request $request)
    {

        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = danhmucchucnang::where('maso', $inputs['maso'])->first();
        if ($model == null) {
            $model = new danhmucchucnang();
            $model->maso = $inputs['maso'];
            $model->capdo = $inputs['capdo'];
            $model->maso_goc = $inputs['maso_goc'];
            $model->menu = '';
            $model->mota = '';
        }
        $a_chucnang = array_column(danhmucchucnang::all()->toArray(),'menu','maso');
        $model->menu = $a_chucnang[$model->maso] ?? $model->maso;
        die($model);
    }

    public function destroy(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            danhmucchucnang::where('maso', $inputs['maso'])->first()->delete();
            return redirect('/chucnang/danhsach');
        } else
            return view('errors.notlogin');
    }
}
