<?php

namespace App\Http\Controllers\manage\thuemuanhaxh;

use App\Model\manage\dinhgia\giathuemuanhaxh\dmnhaxh;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DmNhaXhController extends Controller
{
    public function index(){
        if(Session::has('admin')){
            $model = dmnhaxh::all();
            $a_hientrang = getHienTrang_NhaXH();
            $a_phanloai = getPhanLoai_NhaXH();
            return view('manage.dinhgia.giathuemuanhaxh.danhmuc.index')
                ->with('url','/thuemuanhaxahoi')
                ->with('model',$model)
                ->with('a_hientrang',$a_hientrang)
                ->with('a_phanloai',$a_phanloai)
                ->with('pageTitle','Danh mục nhà xã hội');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['thoigian'] = getDateToDb($inputs['thoigian']);
            $inputs['dientich'] = getDoubleToDb($inputs['dientich']);
            //dd($inputs);
            $check = dmnhaxh::where('maso',$inputs['maso'])->first();
            //dd($check);
            if ($check == null) {
                $inputs['maso'] = getdate()[0];
                dmnhaxh::create($inputs);
            } else {
                $check->update($inputs);
            }

            return redirect('/thuemuanhaxahoi/danhmuc');
        }else
            return view('errors.notlogin');
    }

    public function show(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = dmnhaxh::where('maso', $inputs['maso'])->first();
        die($model);
    }

    public function update(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['thoigian'] = getDateToDb($inputs['thoigian']);
            $inputs['dientich'] = getDoubleToDb($inputs['dientich']);
            $model = where('maso', $inputs['maso'])->first();
            $model->update($inputs);
            return redirect('thuemuanhaxahoi/danhmuc');
        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            dmnhaxh::where('maso',$inputs['maso'])->first()->delete();
            return redirect('thuemuanhaxahoi/danhmuc');
        }else
            return view('errors.notlogin');
    }
}
