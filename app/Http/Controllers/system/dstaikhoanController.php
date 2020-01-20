<?php

namespace App\Http\Controllers\system;

use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class dstaikhoanController extends Controller
{
    public function index(Request $request)
    {
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong', 'danhsachtaikhoan', 'index')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            if(session('admin')->level == 'SSA' || session('admin')->level == 'ADMIN'){
                $m_diaban = dsdiaban::all();
            }else{
                $m_diaban = dsdiaban::where('madiaban',session('admin')->madiaban)->get();
            }
            $m_donvi = dsdonvi::wherein('madiaban',array_column($m_diaban->toarray(),'madiaban'))->get();
            $inputs['madv'] = $inputs['madv'] ??  $m_donvi->first()->madv;
            $model = Users::where('madv', $inputs['madv'])->get();
            //lấy phân loại tài khoản từ bảng dsdonvi để hiển thị
            foreach($model as $ct){
                $dv = $m_donvi->where('madv',$ct->madv)->first();
                $ct->chucnang = $dv->chucnang;
            }
            //dd($model);
            return view('system.taikhoan.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('a_phanloai', getPhanLoaiDonVi())
                ->with('m_diaban', $m_diaban)
                ->with('m_donvi', $m_donvi)
                ->with('pageTitle', 'Danh sách tài khoản đơn vị');

        } else
            return view('errors.notlogin');
    }

    public function create(Request $request){
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong', 'danhsachtaikhoan', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $m_donvi = dsdonvi::where('madv',$inputs['madv'])->get();
            //dd(array_column($m_donvi->toArray(),'tendv','madv'));
            return view('system.taikhoan.create')
                ->with('inputs', $inputs)
                ->with('a_phanloai', getPhanLoaiDonVi())
                ->with('a_donvi',array_column($m_donvi->toArray(),'tendv','madv'))
                ->with('pageTitle','Thêm mới thông tin tài khoản');

        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong', 'danhsachtaikhoan', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            //$user->username = chuanhoachuoi($inputs['username']);
            //$user->password = md5($inputs['password']);
            $user = new Users();
            $user->madv = $inputs['madv'];
            $user->name = $inputs['name'];
            $user->username = chuanhoachuoi($inputs['username']);
            $user->password = md5($inputs['password']);
            $user->status = 'Kích hoạt';
            $user->save();

            return redirect('/taikhoan/danhsach?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function copy(Request $request){
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong', 'danhsachtaikhoan', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = Users::where('username',$inputs['username'])->first();
            return view('system.taikhoan.copy')
                ->with('model',$model)
                ->with('pageTitle','Sao chép thông tin tài khoản');
        } else
            return view('errors.notlogin');
    }

    public function store_copy(Request $request){
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong', 'danhsachtaikhoan', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = Users::where('username',$inputs['username_goc'])->first();
            $user = new Users();
            $user->madv = $model->madv;
            $user->name = $inputs['name'];
            $user->username = chuanhoachuoi($inputs['username']);
            $user->password = md5($inputs['password']);
            $user->status = 'Kích hoạt';
            $user->permission = $model->permission;
            $user->save();

            return redirect('/taikhoan/danhsach?madv=' . $model->madv);
        } else
            return view('errors.notlogin');
    }

    public function modify(Request $request){
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong', 'danhsachtaikhoan', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = Users::where('username', $inputs['username'])->first();
            $m_donvi = dsdonvi::where('madv',$model->madv)->get();

            return view('system.taikhoan.edit')
                ->with('model', $model)
                ->with('a_donvi',array_column($m_donvi->toArray(),'tendv','madv'))
                ->with('pageTitle','Thông tin tài khoản');

        }else
            return view('errors.notlogin');
    }

    public function update(Request $request){
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong', 'danhsachtaikhoan', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = Users::where('username', $inputs['username'])->first();
            $model->name = $inputs['name'];
            $model->status = $inputs['status'];
            if($inputs['password'] != ''){
                $model->password = md5($inputs['password']);
            }
            $model->update($inputs);

            return redirect('/taikhoan/danhsach?madv='. $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function delete(Request $request){
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong', 'danhsachtaikhoan', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = Users::findorfail($inputs['iddelete']);
            $model->delete();
            return redirect('/taikhoan/danhsach?madv='. $model->madv);
        } else
            return view('errors.notlogin');
    }

    public function permission(Request $request)
    {
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong', 'danhsachtaikhoan', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = Users::where('username',$inputs['username'])->first();
            $permission = json_decode($model->permission,true);
            $setting = getPhanQuyen();
            foreach($setting as $k_csdl => $v_csdl){

            }
            dd($setting);
            return view('system.taikhoan.perms')
                ->with('permission', json_decode($permission))
                ->with('setting', $setting)
                ->with('model', $model)
                ->with('pageTitle', 'Phân quyền cho tài khoản');

        } else
            return view('errors.notlogin');
    }
}
