<?php

namespace App\Http\Controllers\manage\giaspdvci;

use App\Model\manage\dinhgia\giaspdvci\giaspdvcidm;
use App\Model\system\dmdvt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class giaspdvcidmController extends Controller
{
    public function index(){
        if(Session::has('admin')){
            $model = giaspdvcidm::all();
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            $inputs['url'] = '/giaspdvci';
            return view('manage.dinhgia.giaspdvci.danhmuc.index')
                ->with('model',$model)
                ->with('a_dvt',$a_dvt)
                ->with('inputs',$inputs)
                ->with('a_phanloai',getPhanLoaiSPDVCI())
                ->with('pageTitle','Danh mục sản phẩm, dịch vụ công ích');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            //dd($inputs);
            $check = giaspdvcidm::where('maspdv',$inputs['maspdv'])->first();
            if ($check == null) {
                $inputs['maspdv'] = getdate()[0];
                giaspdvcidm::create($inputs);
            } else {
                $check->update($inputs);
            }
            return redirect('/giaspdvci/danhmuc');
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
        $model = giaspdvcidm::where('maspdv',$inputs['maspdv'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            giaspdvcidm::where('maspdv',$inputs['maspdv'])->first()->delete();
            return redirect('giaspdvci/danhmuc');
        }else
            return view('errors.notlogin');
    }
}
