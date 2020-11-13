<?php

namespace App\Http\Controllers\manage\giaspdvtoida;

use App\Model\manage\dinhgia\giaspdvtoida\giaspdvtoida_dm;
use App\Model\system\dmdvt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class giaspdvtoidadmController extends Controller
{
    public function index(){
        if(Session::has('admin')){
            $model = giaspdvtoida_dm::all();
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            $inputs['url'] = '/giaspdvtoida';
            return view('manage.dinhgia.giaspdvtoida.danhmuc.index')
                ->with('model',$model)
                ->with('a_dvt',$a_dvt)
                ->with('inputs',$inputs)
                ->with('a_phanloai',getPhanLoaiTroGia())
                ->with('pageTitle','Danh mục sản phẩm, dịch vụ');
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
            $check = giaspdvtoida_dm::where('maspdv',$inputs['maspdv'])->first();
            if ($check == null) {
                $inputs['maspdv'] = getdate()[0];
                giaspdvtoida_dm::create($inputs);
            } else {
                $check->update($inputs);
            }
            return redirect('/giaspdvtoida/danhmuc');
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
        $model = giaspdvtoida_dm::where('maspdv',$inputs['maspdv'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            giaspdvtoida_dm::where('maspdv',$inputs['maspdv'])->first()->delete();
            return redirect('giaspdvtoida/danhmuc');
        }else
            return view('errors.notlogin');
    }
}
