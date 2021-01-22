<?php

namespace App\Http\Controllers\manage\giaspdvkhunggia;

use App\Model\manage\dinhgia\giaspdvkhunggia\giaspdvkhunggia_dm;
use App\Model\system\dmdvt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class giaspdvkhunggiadmController extends Controller
{
    public function index(){
        if(Session::has('admin')){
            $model = giaspdvkhunggia_dm::all();
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            $inputs['url'] = '/giaspdvkhunggia';
            $a_phanloai = array_column(giaspdvkhunggia_dm::get('phanloai')->toArray(),'phanloai','phanloai');
            return view('manage.dinhgia.giaspdvkhunggia.danhmuc.index')
                ->with('model',$model)
                ->with('a_dvt',$a_dvt)
                ->with('inputs',$inputs)
                ->with('a_phanloai',$a_phanloai)
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
            $check = giaspdvkhunggia_dm::where('maspdv',$inputs['maspdv'])->first();
            if ($check == null) {
                $inputs['maspdv'] = getdate()[0];
                giaspdvkhunggia_dm::create($inputs);
            } else {
                $check->update($inputs);
            }
            return redirect('/giaspdvkhunggia/danhmuc');
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
        $model = giaspdvkhunggia_dm::where('maspdv',$inputs['maspdv'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            giaspdvkhunggia_dm::where('maspdv',$inputs['maspdv'])->first()->delete();
            return redirect('giaspdvkhunggia/danhmuc');
        }else
            return view('errors.notlogin');
    }
}
