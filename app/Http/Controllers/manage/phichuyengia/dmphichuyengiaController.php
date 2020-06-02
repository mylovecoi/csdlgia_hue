<?php

namespace App\Http\Controllers\manage\phichuyengia;

use App\Model\manage\dinhgia\phichuyengia\dmphichuyengia;
use App\Model\manage\dinhgia\phichuyengia\nhomphichuyengia;
use App\Model\system\dmdvt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class dmphichuyengiaController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = dmphichuyengia::all();
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            $inputs['url'] = '/phichuyengia';
            $nhom = nhomphichuyengia::where('manhom',$inputs['manhom'])->first();
            return view('manage.phichuyengia.danhmuc.index')
                ->with('inputs', $inputs)
                ->with('model', $model)
                ->with('nhom', $nhom)
                ->with('a_dvt', $a_dvt)
                ->with('pageTitle', 'Thông tin hồ sơ danh mục hàng hóa chuyển từ phí sang giá');
        } else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $chk_dvt = dmdvt::where('dvt', $inputs['dvt'])->get();
            if (count($chk_dvt) == 0) {
                dmdvt::insert(['dvt' => $inputs['dvt']]);
            }
            $check = dmphichuyengia::where('maso',$inputs['maso'])->first();
            if ($check == null) {
                $inputs['maso'] = getdate()[0];
                dmphichuyengia::create($inputs);
            } else {
                $check->update($inputs);
            }
            return redirect('/phichuyengia/danhmuc/detail?manhom='.$inputs['manhom']);
        }else
            return view('errors.notlogin');
    }

    public function edit(Request $request){
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = dmphichuyengia::where('maso',$inputs['maso'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            dmphichuyengia::where('maso',$inputs['maso'])->delete();
            return redirect('/phichuyengia/danhmuc/detail?manhom='.$inputs['manhom']);
        }else
            return view('errors.notlogin');
    }
}
