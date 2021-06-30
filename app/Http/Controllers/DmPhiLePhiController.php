<?php

namespace App\Http\Controllers;

use App\DmPhiLePhi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DmPhiLePhiController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $inputs['url'] = '/giaphilephi';
            $model = DmPhiLePhi::all();
            $inputs['stt'] = count($model) + 1;
            $a_phanloai = array_column($model->toArray(),'phanloai','phanloai');
            return view('manage.dinhgia.philephi.danhmuc.index')
                ->with('model',$model)
                ->with('a_phanloai',$a_phanloai)
                ->with('inputs',$inputs)
                ->with('pageTitle','Danh mục phí, lệ phí');

        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $check = DmPhiLePhi::where('manhom',$inputs['manhom'])->first();
            if ($check == null) {
                $inputs['manhom'] = getdate()[0];
                DmPhiLePhi::create($inputs);
            } else {
                $check->update($inputs);
            }
            return redirect('/giaphilephi/danhmuc');
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
        $model = DmPhiLePhi::where('manhom', $inputs['manhom'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            DmPhiLePhi::where('manhom',$inputs['manhom'])->first()->delete();
            return redirect('giaphilephi/danhmuc');
        }else
            return view('errors.notlogin');
    }
}
