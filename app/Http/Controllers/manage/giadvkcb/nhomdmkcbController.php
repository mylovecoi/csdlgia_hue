<?php

namespace App\Http\Controllers\manage\giadvkcb;

use App\DmDvKcb;
use App\Model\manage\dinhgia\thuetn\DmThueTn;
use App\Model\manage\dinhgia\thuetn\NhomThueTn;
use App\NhomDvKcb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class nhomdmkcbController extends Controller
{
    public function index(){
        if(Session::has('admin')){
            $model = NhomDvKcb::all();
            $inputs['url'] = '/giadvkcb';
            return view('manage.dinhgia.giadvkcb.danhmuc.nhom')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('pageTitle','Nhóm danh mục dịch vụ y tế');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = NhomDvKcb::where('manhom',$inputs['manhom'])->first();
            if($model == null){
                $inputs['manhom'] = getdate()[0];
                NhomDvKcb::create($inputs);
            }else{
                $model->update($inputs);
            }
            return redirect('/giadvkcb/danhmuc');
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
        $model = NhomDvKcb::where('manhom',$inputs['manhom'])->first();
        die($model);
    }


    public function destroy(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            NhomDvKcb::where('manhom', $inputs['manhom'])->first()->delete();
            DmDvKcb::where('manhom', $inputs['manhom'])->delete();
            return redirect('giadvkcb/danhmuc');
        } else
            return view('errors.notlogin');
    }
}
