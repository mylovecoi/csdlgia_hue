<?php

namespace App\Http\Controllers;

use App\DmHhDvK;
use App\NhomHhDvK;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class NhomHhDvKController extends Controller
{
    public function index(){
        if(Session::has('admin')){
            $inputs['url'] = '/giahhdvk';
            $model = NhomHhDvK::all();
            return view('manage.dinhgia.giahhdvk.danhmuc.nhom.index')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('pageTitle','Thông tin nhóm hàng hóa dịch vụ');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = NhomHhDvK::where('matt',$inputs['matt'])->first();
            if($model == null){
                $inputs['matt'] = getdate()[0];
                NhomHhDvK::create($inputs);
            }else{
                $model->update($inputs);
            }
            return redirect('/giahhdvk/danhmuc');
        }else
            return view('errors.notlogin');
    }

    public function show_nhomdm(Request $request){
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = NhomHhDvK::where('matt',$inputs['matt'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            NhomHhDvK::where('matt',$inputs['matt'])->first()->delete();
            DmHhDvK::where('matt',$inputs['matt'])->get()->delete();
            return redirect('giahhdvk/danhmuc');
        }else
            return view('errors.notlogin');
    }

}
