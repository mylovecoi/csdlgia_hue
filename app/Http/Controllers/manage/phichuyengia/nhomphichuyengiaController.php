<?php

namespace App\Http\Controllers\manage\phichuyengia;

use App\Model\manage\dinhgia\phichuyengia\dmphichuyengia;
use App\Model\manage\dinhgia\phichuyengia\nhomphichuyengia;
use App\NhomDvKcb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class nhomphichuyengiaController extends Controller
{
    public function index(){
        if(Session::has('admin')){
            $model = nhomphichuyengia::all();
            $inputs['url'] = '/phichuyengia';
            return view('manage.phichuyengia.danhmuc.nhom')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('pageTitle','Nhóm phí chuyển giá');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = nhomphichuyengia::where('manhom',$inputs['manhom'])->first();
            if($model == null){
                $inputs['manhom'] = getdate()[0];
                nhomphichuyengia::create($inputs);
            }else{
                $model->update($inputs);
            }
            return redirect('/phichuyengia/danhmuc');
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
        $model = nhomphichuyengia::where('manhom',$inputs['manhom'])->first();
        die($model);
    }


    public function destroy(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            nhomphichuyengia::where('manhom', $inputs['manhom'])->first()->delete();
            dmphichuyengia::where('manhom', $inputs['manhom'])->delete();
            return redirect('phichuyengia/danhmuc');
        } else
            return view('errors.notlogin');
    }
}
