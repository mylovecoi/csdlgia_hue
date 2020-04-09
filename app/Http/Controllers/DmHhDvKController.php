<?php

namespace App\Http\Controllers;

use App\DmHhDvK;
use App\Model\system\dmdvt;
use App\NhomHhDvK;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DmHhDvKController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giahhdvk';
            $modelnhom = NhomHhDvK::where('matt',$inputs['matt'])->first();
            $model = DmHhDvK::where('matt',$inputs['matt'])->get();
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            return view('manage.dinhgia.giahhdvk.danhmuc.chitiet.index')
                ->with('model',$model)
                ->with('a_dvt',$a_dvt)
                ->with('inputs',$inputs)
                ->with('modelnhom',$modelnhom)
                ->with('pageTitle','Thông tin chi tiết hàng hóa dịch vụ');

        }else
            return view('errors.notlogin');

    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            //dd($inputs);
            $chk_dvt = dmdvt::where('dvt', $inputs['dvt'])->get();
            if (count($chk_dvt) == 0) {
                dmdvt::insert(['dvt' => $inputs['dvt']]);
            }

            $check = DmHhDvK::where('mahhdv',$inputs['mahhdv'])->first();
            if ($check == null) {
                //$inputs['mahhdv'] = getdate()[0];
                DmHhDvK::create($inputs);
            } else {
                $check->update($inputs);
            }
            return redirect('/giahhdvk/danhmuc/detail?matt='.$inputs['matt']);
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
        $model = DmHhDvK::where('mahhdv',$inputs['mahhdv'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $model = DmHhDvK::where('mahhdv',$inputs['mahhdv'])->first();
            $model->delete();
            return redirect('/giahhdvk/danhmuc/detail?matt='.$model->matt);
        }else
            return view('errors.notlogin');
    }
}
