<?php

namespace App\Http\Controllers\manage\trogiatrocuoc;

use App\Model\manage\dinhgia\trogiatrocuoc\trogiatrocuocdm;
use App\Model\system\dmdvt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class trogiatrocuocdmController extends Controller
{
    public function index(){
        if(Session::has('admin')){
            $model = trogiatrocuocdm::all();
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            $inputs['url'] = '/trogiatrocuoc';
            return view('manage.dinhgia.trogiatrocuoc.danhmuc.index')
                ->with('model',$model)
                ->with('a_dvt',$a_dvt)
                ->with('inputs',$inputs)
                ->with('a_phanloai',getPhanLoaiTroGia())
                ->with('pageTitle','Danh mục hàng hóa trợ giá, trợ cước');
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
            $check = trogiatrocuocdm::where('maspdv',$inputs['maspdv'])->first();
            if ($check == null) {
                $inputs['maspdv'] = getdate()[0];
                trogiatrocuocdm::create($inputs);
            } else {
                $check->update($inputs);
            }
            return redirect('/trogiatrocuoc/danhmuc');
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
        $model = trogiatrocuocdm::where('maspdv',$inputs['maspdv'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            trogiatrocuocdm::where('maspdv',$inputs['maspdv'])->first()->delete();
            return redirect('trogiatrocuoc/danhmuc');
        }else
            return view('errors.notlogin');
    }
}
