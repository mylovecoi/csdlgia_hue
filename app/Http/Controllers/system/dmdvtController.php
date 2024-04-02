<?php

namespace App\Http\Controllers\system;

use App\Model\system\dsdiaban;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\system\dmdvt;
use Illuminate\Support\Facades\Session;

class dmdvtController extends Controller
{
    public function index(Request $request)
    {
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'danhmucdvt', 'index')) {
                return view('errors.noperm');
            }

            $model = dmdvt::all();
            $inputs = $request->all();
            //dd($model);
            return view('system.dmdvt.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('a_phanloai', getPhanLoaiDonVi_DiaBan())
                ->with('pageTitle', 'Danh mục đơn vị tính');
        } else
            return view('errors.notlogin');
    }

    public function update(Request $request){
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'danhmucdvt', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = dmdvt::where('madvt', $inputs['madvt'])->first();

            if ($model == null) {
                $inputs['madvt'] = getdate()[0];
                dmdvt::create($inputs);
            } else {
                $model->dvt = $inputs['dvt'];                
                $model->save();
            }

            return redirect('/dmdvt/danhsach');
        } else
            return view('errors.notlogin');
    }

    public function delete(Request $request){
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'danhmucdvt', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            dmdvt::findorfail($inputs['iddelete'])->delete();
            return redirect('/dmdvt/danhsach');
        } else
            return view('errors.notlogin');
    }
}
