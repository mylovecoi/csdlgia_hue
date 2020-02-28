<?php

namespace App\Http\Controllers\manage\giahhdvcn;

use App\Model\manage\dinhgia\giahhdvcn\giahhdvcndm;
use App\Model\system\dmdvt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class giahhdvcndmController extends Controller
{
    public function index(){
        if(Session::has('admin')){
            $model = giahhdvcndm::all();
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            $inputs['url'] = '/giahhdvcn';
            return view('manage.dinhgia.giahhdvcn.danhmuc.index')
                ->with('model',$model)
                ->with('a_dvt',$a_dvt)
                ->with('inputs',$inputs)
                ->with('pageTitle','Danh mục hàng hóa, dịch vụ khác');
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
            $check = giahhdvcndm::where('maspdv',$inputs['maspdv'])->first();
            if ($check == null) {
                $inputs['maspdv'] = getdate()[0];
                giahhdvcndm::create($inputs);
            } else {
                $check->update($inputs);
            }
            return redirect('/giahhdvcn/danhmuc');
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
        $model = giahhdvcndm::where('maspdv',$inputs['maspdv'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            giahhdvcndm::where('maspdv',$inputs['maspdv'])->first()->delete();
            return redirect('giahhdvcn/danhmuc');
        }else
            return view('errors.notlogin');
    }
}
