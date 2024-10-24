<?php

namespace App\Http\Controllers\manage\giaspdvcuthe;

use App\Model\manage\dinhgia\giaspdvcuthe\giaspdvcuthe;
use App\Model\manage\dinhgia\giaspdvcuthe\giaspdvcuthe_ct;
use App\Model\system\dmdvt;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\view\view_giaspdvcuthe;
use App\NhomHhDvK;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\manage\dinhgia\giaspdvcuthe\giaspdvcuthe_dm;
use App\Model\manage\dinhgia\giaspdvcuthe\giaspdvcuthe_nhomdm;
use Illuminate\Support\Facades\Session;

class giaspdvcuthe_dmController extends Controller
{
    //Nhóm danh mục
    public function index()
    {
        if (Session::has('admin')) {
            $model = giaspdvcuthe_nhomdm::all();
            $inputs['url'] = '/giaspdvcuthe';
            return view('manage.dinhgia.giaspdvcuthe.danhmuc.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Danh mục sản phẩm, dịch vụ');
        } else
            return view('errors.notlogin');
    }

    public function store_nhomdm(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $check = giaspdvcuthe_nhomdm::where('manhom', $inputs['manhom'])->first();
            if ($check == null) {
                $inputs['manhom'] = getdate()[0];
                $inputs['theodoi'] = 1;
                giaspdvcuthe_nhomdm::create($inputs);
            } else {
                $check->update($inputs);
            }
            return redirect('/giaspdvcuthe/danhmuc');
        } else
            return view('errors.notlogin');
    }

    public function destroy_nhomdm(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = giaspdvcuthe_nhomdm::where('manhom', $inputs['manhom'])->first();
            giaspdvcuthe_dm::where('manhom', $inputs['manhom'])->delete();
            $model->delete();
            return redirect('giaspdvcuthe/danhmuc');
        } else
            return view('errors.notlogin');
    }

    //Chi tiết danh mục
    public function chitiet(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $modelnhom = giaspdvcuthe_nhomdm::where('manhom', $inputs['manhom'])->first();
            $model = giaspdvcuthe_dm::where('manhom', $inputs['manhom'])->get();
            $a_dvt = array_column(dmdvt::all()->toArray(), 'dvt', 'madvt');
            $inputs['url'] = '/giaspdvcuthe';
            return view('manage.dinhgia.giaspdvcuthe.danhmuc.chitiet')
                ->with('model', $model)
                ->with('modelnhom', $modelnhom)
                ->with('a_dvt', $a_dvt)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Danh mục sản phẩm, dịch vụ');
        } else
            return view('errors.notlogin');
    }

    public function store_chitiet(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $check = giaspdvcuthe_dm::where('maso', $inputs['maso'])->first();
            if ($check == null) {
                $inputs['maso'] = getdate()[0];
                giaspdvcuthe_dm::create($inputs);
            } else {
                $check->update($inputs);
            }
            return redirect('/giaspdvcuthe/chitiet_dm?manhom=' . $inputs['manhom']);
        } else
            return view('errors.notlogin');
    }

    public function delete_dm(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = giaspdvcuthe_dm::where('maso', $inputs['maso'])->first();
            $model->delete();
            return redirect('/giaspdvcuthe/chitiet_dm?manhom=' . $model->manhom);
        } else
            return view('errors.notlogin');
    }
}
