<?php

namespace App\Http\Controllers\manage\thuetn;

use App\Model\manage\dinhgia\thuetn\DmThueTn;
use App\Model\manage\dinhgia\thuetn\NhomThueTn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class NhomThueTnController extends Controller
{
    public function index(){
        if(Session::has('admin')){
            $model = NhomThueTn::all();
            $inputs['url'] = '/giathuetn';
            return view('manage.dinhgia.thuetn.danhmuc.nhom.index')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('pageTitle','Nhóm tài nguyên tính thuế tài nguyên');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = NhomThueTn::where('manhom',$inputs['manhom'])->first();
            if($model == null){
                //$inputs['manhom'] = getdate()[0];
                NhomThueTn::create($inputs);
            }else{
                $model->update($inputs);
            }
            return redirect('/giathuetn/danhmuc');
        }else
            return view('errors.notlogin');
    }

    public function show_nhomdm(Request $request){
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = NhomThueTn::where('manhom',$inputs['manhom'])->first();
        die($model);
    }


    public function destroy(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            NhomThueTn::where('manhom', $inputs['manhom'])->first()->delete();
            DmThueTn::where('manhom', $inputs['manhom'])->delete();
            return redirect('giathuetn/danhmuc');
        } else
            return view('errors.notlogin');
    }
}
