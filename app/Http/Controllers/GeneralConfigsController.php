<?php

namespace App\Http\Controllers;

use App\GeneralConfigs;
use App\Users;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\system\danhmucchucnang;
use Illuminate\Support\Facades\Session;

class GeneralConfigsController extends Controller
{
    public function index()
    {
        if (Session::has('admin')) {
            if(chkPer('hethong', 'hethong_pq', 'thongtin','danhmuc', 'modify')){
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
            if(chkPer('hethong', 'hethong_pq', 'thongtin','danhmuc', 'modify')){
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
            if(chkPer('hethong', 'hethong_pq', 'thongtin','danhmuc', 'modify')){
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
            if(chkPer('hethong', 'hethong_pq', 'thongtin','danhmuc', 'modify')){
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
            if(chkPer('hethong', 'hethong_pq', 'thongtin','danhmuc', 'modify')){
                $inputs = $request->all();
                if(isset($inputs['ipf1'])){
                    $ipf1 = $request->file('ipf1');
                    $inputs['ipf1'] = '&1.'.$ipf1->getClientOriginalName();
                    $ipf1->move(public_path() . '/data/huongdan/', $inputs['ipf1']);
                    session('admin')->ipf1 = $inputs['ipf1'];
                }
                if(isset($inputs['ipf2'])){
                    $ipf2 = $request->file('ipf2');
                    $inputs['ipf2'] = '&2.'.$ipf2->getClientOriginalName();
                    $ipf2->move(public_path() . '/data/huongdan/', $inputs['ipf2']);
                    session('admin')->ipf2 = $inputs['ipf2'];
                }
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
                //dd($gui);
                foreach($gui as $k_csdl=>$v_csdl) {
                    if(isset($setting[$k_csdl])){
                        $gui[$k_csdl]['index'] = $setting[$k_csdl]['index'] ?? $gui[$k_csdl]['index'];
                        $gui[$k_csdl]['congbo'] = $setting[$k_csdl]['congbo'] ?? $gui[$k_csdl]['congbo'];
                        if (!is_array($v_csdl)) {
                            continue;
                        }
                        foreach ($v_csdl as $k_gr => $v_gr) {
                            if(isset($setting[$k_csdl][$k_gr])){
                                $gui[$k_csdl]['index'] = $setting[$k_csdl]['index'] ?? $gui[$k_csdl]['index'];
                                $gui[$k_csdl]['congbo'] = $setting[$k_csdl]['congbo']?? $gui[$k_csdl]['congbo'];
                                if (!is_array($v_gr)) {
                                    continue;
                                }
                                foreach ($v_gr as $k => $v) {
                                    $gui[$k_csdl][$k_gr][$k] = $setting[$k_csdl][$k_gr][$k]?? $gui[$k_csdl][$k_gr][$k];
                                }
                            }
                        }
                    }
                }
                //dd($gui);
                $a_chucnang = array_column(danhmucchucnang::all()->toArray(),'menu','maso');
                //$a_chucnang = array();
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

    public function updatesetting_gr(Request $request){
        if (Session::has('admin')) {
            if(session('admin')->level == 'SSA'){
                $inputs = $request->all();
                $role = explode(';',$inputs['roles']);
                $a_group[$role[0]][$role[1]] = getGiaoDien()[$role[0]][$role[1]];
                $model = GeneralConfigs::first();
                $setting = json_decode($model->setting,true);
                //$setting[$role[0]][$role[1]] = $setting[$role[0]][$role[1]] ?? getGiaoDien()[$role[0]][$role[1]];
                $index = isset($inputs['gr_index']) ? '1' : '0';
                $congbo = isset($inputs['gr_congbo']) ? '1' : '0';
                foreach (getGiaoDien()[$role[0]][$role[1]] as $key=>$val){
                    if(!is_array($val)){
                        continue;
                    }
                    $setting[$role[0]][$role[1]][$key] = $setting[$role[0]][$role[1]][$key] ?? getGiaoDien()[$role[0]][$role[1]][$key];
                    $setting[$role[0]][$role[1]][$key]['index'] = $index;
                    $setting[$role[0]][$role[1]][$key]['congbo'] = $congbo;
                }

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
