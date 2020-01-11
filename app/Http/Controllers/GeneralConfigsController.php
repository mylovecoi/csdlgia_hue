<?php

namespace App\Http\Controllers;

use App\GeneralConfigs;
use App\Users;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\system\DanhMucChucNang;
use Illuminate\Support\Facades\Session;

class GeneralConfigsController extends Controller
{
    public function index()
    {
        if (Session::has('admin')) {
            if(session('admin')->level == 'SSA' || session('admin')->level == 'SSA'){
                $model = GeneralConfigs::first();
                return view('system.general.index')
                    ->with('model',$model)
                    ->with('pageTitle', 'Cấu hình hệ thống');
            }else{
                return view('errors.perm');
            }

        }else
            return view('errors.notlogin');
    }

    public function create(){
        if (Session::has('admin')) {
            if (session('admin')->level == 'SSA' || session('admin')->level == 'SA') {
                return view('system.general.create')
                    ->with('pageTitle', 'Thêm mới thông tin đơn vị được cấp bản quyền');
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            if(session('admin')->level == 'SSA' || session('admin')->level == 'SA') {
                $inputs = $request->all();
                $model = new GeneralConfigs();
                $model->create($inputs);
                return redirect('general');
            }else{
                return view('errors.noperm');
            }
        }else
            return view('errors.notlogin');
    }

    public function edit($id)
    {
        if (Session::has('admin')) {
            if(session('admin')->level == 'SSA' || session('admin')->level == 'SA') {
                $model = GeneralConfigs::first();
                return view('system.general.edit')
                    ->with('model', $model)
                    ->with('pageTitle', 'Chỉnh sửa cấu hình hệ thống');
            }else{
                return view('errors.noperm');
            }

        }else
            return view('errors.notlogin');
    }
    public function update(Request $request,$id)
    {
        if (Session::has('admin')) {
            if(session('admin')->level == 'SSA' || session('admin')->level == 'SA') {
                $inputs = $request->all();
                $model = GeneralConfigs::findOrFail($id);
                $model->update($inputs);
                return redirect('general');
            }else{
                return view('errors.noperm');
            }

        }else
            return view('errors.notlogin');
    }

    public function setting(){
        if (Session::has('admin')) {
            if (session('admin')->level == 'SSA') {
                $model = GeneralConfigs::first();
                $setting = $model->setting == '' ? json_decode($model->setting) : getGiaoDien();
                $a_chucnang = array_column(DanhMucChucNang::all()->toArray(),'mota','maso');
                //dd($setting);
                foreach($setting as $k_csdl=>$v_csdl){
                    //dd($v_csdl);
                    foreach($v_csdl as $k_gr=>$v_gr){
                        if(is_array($v_gr)){
                            //dd($v_gr);
                        }
                    }
                    //dd(1);
                }
                return view('system.general.setting')
                    ->with('model', $model)
                    ->with('setting', $setting)
                    ->with('a_chucnang', $a_chucnang)
                    ->with('pageTitle', 'Cấu hình chức năng chương trình');
            } else {
                return view('errors.noperm');
            }

        } else
            return view('errors.notlogin');
    }

    public function updatesetting(Request $request){
        if (Session::has('admin')) {
            if(session('admin')->level == 'SSA'){
                $update = $request->all();
                $model = GeneralConfigs::first();
                $update['roles'] = isset($update['roles']) ? $update['roles'] : null;
                $model->setting = json_encode($update['roles']);
                $model->save();

                return redirect('general');
            }else{
                return view('errors.noperm');
            }

        }else
            return view('errors.notlogin');
    }


}
