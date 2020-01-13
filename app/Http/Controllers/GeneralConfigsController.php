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
                $gui = getGiaoDien();
                $setting = json_decode($model->setting, true);
                //dd($setting);
                foreach($gui as $k_csdl=>$v_csdl) {
                    if(isset($setting[$k_csdl])){
                        $gui[$k_csdl]['index'] = $setting[$k_csdl]['index'];
                        $gui[$k_csdl]['congbo'] = $setting[$k_csdl]['congbo'];
                        if (!is_array($v_csdl)) {
                            continue;
                        }
                        foreach ($v_csdl as $k_gr => $v_gr) {
                            if(isset($setting[$k_csdl][$k_gr])){
                                $gui[$k_csdl]['index'] = $setting[$k_csdl]['index'];
                                $gui[$k_csdl]['congbo'] = $setting[$k_csdl]['congbo'];
                                if (!is_array($v_gr)) {
                                    continue;
                                }
                                foreach ($v_gr as $k => $v) {
                                    $gui[$k_csdl][$k_gr][$k] = $setting[$k_csdl][$k_gr][$k];
                                }
                            }
                        }
                    }
                }

                $a_chucnang = array_column(DanhMucChucNang::all()->toArray(),'mota','maso');
                //dd($gui);

                return view('system.general.setting')
                    ->with('model', $model)
                    ->with('setting', $gui)
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
                $inputs = $request->all();
                $roles = $inputs['roles'];
                $model = GeneralConfigs::first();
                $setting = json_decode($model->setting,true);
                $setting_df = getGiaoDien();
                foreach($roles as $k_csdl=>$v_csdl) {
                    if (!isset($setting[$k_csdl])) {
                        $setting[$k_csdl] = $setting_df[$k_csdl];
                    }

                    if(!is_array($v_csdl)){
                        $setting[$k_csdl] = $roles[$k_csdl];
                    }else{
                        foreach ($v_csdl as $k_gr => $v_gr) {
                            if (!isset($setting[$k_csdl][$k_gr])) {
                                $setting[$k_csdl][$k_gr] = $setting_df[$k_csdl][$k_gr];
                            }
                            if (!is_array($v_gr)) {
                                $setting[$k_csdl][$k_gr] = $roles[$k_csdl][$k_gr];
                            }else{
                                foreach ($v_gr as $k => $v) {
                                    $setting[$k_csdl][$k_gr][$k] = $roles[$k_csdl][$k_gr][$k];
                                }
                            }
                        }
                    }
                }
                //dd(json_encode($setting));
                //$update['roles'] = isset($inputs['roles']) ? $inputs['roles'] : null;
                $model->setting = json_encode($setting);
                $model->save();
                //dd($model);
                return redirect('/setting');
            }else{
                return view('errors.noperm');
            }

        }else
            return view('errors.notlogin');
    }

}
