<?php

namespace App\Http\Controllers\system\dmnganhnghekd;

use App\Model\system\dmnganhnghekd\DmNganhKd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DmNganhKdController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $model = DmNganhKd::all();
            $inputs = array('url'=>'/dmnganhnghe');
            return view('system.dmnganhnghekd.nganh')
                ->with('model',$model)
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
        $model = DmNganhKd::where('manganh',$inputs['manganh'])->first();
        die($model);
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = DmNganhKd::where('manganh', $inputs['manganh'])->first();

            if ($model == null) {
                //$inputs['maspdv'] = getdate()[0];
                DmNganhKd::create($inputs);
            } else {
                $model->update($inputs);
            }
            return redirect('/dmnganhnghe/danhsach');
        } else
            return view('errors.notlogin');
    }
}
