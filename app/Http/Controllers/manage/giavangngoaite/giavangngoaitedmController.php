<?php

namespace App\Http\Controllers\manage\giavangngoaite;

use App\Model\manage\dinhgia\giavangngoaite\giavangngoaitedm;
use App\Model\system\dmdvt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class giavangngoaitedmController extends Controller
{
    public function index(Request $request){
        if(Session::has('admin')){
            $model = giavangngoaitedm::all();
            $inputs['url'] = '/giavangngoaite';
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            return view('manage.dinhgia.giavangngoaite.danhmuc.index')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('a_dvt',$a_dvt)
                ->with('pageTitle','Danh mục giá vàng, ngoại tệ');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $chk_dvt = dmdvt::where('dvt', $inputs['dvt'])->get();
            if (count($chk_dvt) == 0) {
                dmdvt::insert(['dvt' => $inputs['dvt']]);
            }
            $check = giavangngoaitedm::where('mahhdv',$inputs['mahhdv'])->first();
            if ($check == null) {
                //$inputs['mahhdv'] = getdate()[0];
                giavangngoaitedm::create($inputs);
            } else {
                $check->update($inputs);
            }
            return redirect('/giavangngoaite/danhmuc');
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
        $model = giavangngoaitedm::where('mahhdv',$inputs['mahhdv'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            giavangngoaitedm::where('mahhdv',$inputs['mahhdv'])->delete();
            return redirect('giavangngoaite/danhmuc');
        }else
            return view('errors.notlogin');
    }
}
