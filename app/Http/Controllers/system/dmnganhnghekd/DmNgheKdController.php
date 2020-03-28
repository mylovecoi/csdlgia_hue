<?php

namespace App\Http\Controllers\system\dmnganhnghekd;

use App\District;
use App\Model\system\dmnganhnghekd\DmNganhKd;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DmNgheKdController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $a_nganh = array_column(DmNganhKd::where('manganh',$inputs['manganh'])->get()->toarray(),
                'tennganh','manganh');
            $model = DmNgheKd::where('manganh',$inputs['manganh'])->get();
            $inputs['url'] = '/dmnganhnghe';
            return view('system.dmnganhnghekd.nghe')
                ->with('model',$model)
                ->with('a_nganh',$a_nganh)
                ->with('inputs',$inputs)
                ->with('pageTitle', 'Danh mục ngành kinh doanh');
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
        $model = DmNgheKd::where('manghe',$inputs['manghe'])->first();
        die($model);
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = DmNgheKd::where('manghe',$inputs['manghe'])->first();
            if ($model == null) {
                //$inputs['manghe'] = getdate()[0];
                DmNgheKd::create($inputs);
            } else {
                $model->update($inputs);
            }
            return redirect('dmnganhnghe/chitiet?manganh='.$inputs['manganh']);
        }else
            return view('errors.notlogin');
    }
}
