<?php

namespace App\Http\Controllers\system;

use App\Model\system\dsdiaban;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class dsdiabanController extends Controller
{
    public function index(Request $request)
    {
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'danhsachdiaban', 'index')) {
                return view('errors.noperm');
            }

            $model = dsdiaban::all();
            $inputs = $request->all();
            //dd($model);
            return view('system.diaban.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('a_phanloai', getPhanLoaiDonVi_DiaBan())
                ->with('pageTitle', 'Danh sách địa bàn');
        } else
            return view('errors.notlogin');
    }

    public function modify(Request $request){
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'danhsachdiaban', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = dsdiaban::where('madiaban', $inputs['madiaban'])->first();

            if ($model == null) {
                $inputs['madiaban'] = getdate()[0];
                dsdiaban::create($inputs);
            } else {
                $model->tendiaban = $inputs['tendiaban'];
                $model->level = $inputs['level'];
                $model->save();
            }

            return redirect('/diaban/danhsach');
        } else
            return view('errors.notlogin');
    }

    public function delete(Request $request){
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'danhsachdiaban', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            dsdiaban::findorfail($inputs['iddelete'])->delete();
            return redirect('/diaban/danhsach');
        } else
            return view('errors.notlogin');
    }
}
