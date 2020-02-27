<?php

namespace App\Http\Controllers\manage\giadvkcb;

use App\Model\manage\dinhgia\giadvkcb\dvkcbdm;
use App\Model\manage\dinhgia\giaspdvci\giaspdvcidm;
use App\Model\system\dmdvt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class dvkcbdmController extends Controller
{
    public function index(){
        if(Session::has('admin')){
            $model = dvkcbdm::all();
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            $inputs['url'] = '/giadvkcb';
            return view('manage.dinhgia.giadvkcb.danhmuc.index')
                ->with('model',$model)
                ->with('a_dvt',$a_dvt)
                ->with('inputs',$inputs)
                ->with('pageTitle','Danh mục dịch vụ khám chữa bệnh');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            //dd($inputs);
            $chk_dvt = dmdvt::where('dvt', $inputs['dvt'])->get();
            if (count($chk_dvt) == 0) {
                dmdvt::insert(['dvt' => $inputs['dvt']]);
            }

            $check = dvkcbdm::where('maspdv',$inputs['maspdv'])->first();
            if ($check == null) {
                $inputs['maspdv'] = getdate()[0];
                dvkcbdm::create($inputs);
            } else {
                $check->update($inputs);
            }
            return redirect('/giadvkcb/danhmuc');
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
        $model = dvkcbdm::where('maspdv',$inputs['maspdv'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            dvkcbdm::where('maspdv',$inputs['maspdv'])->first()->delete();
            return redirect('giadvkcb/danhmuc');
        }else
            return view('errors.notlogin');
    }
}
