<?php

namespace App\Http\Controllers\manage\gianuocsachsh;

use App\Model\manage\dinhgia\gianuocsachsh\GiaNuocSachShDm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DmGiaNuocSachShController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $model = GiaNuocSachShDm::all();
            //dd($model);
            return view('manage.dinhgia.gianuocsh.danhmuc.index')
                ->with('url', '/gianuocsachsinhhoat')
                ->with('model', $model)
                ->with('pageTitle', 'Thông tin hồ sơ danh mục giá nước sạch sinh hoạt');
        } else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            //dd($inputs);
            $check = GiaNuocSachShDm::where('madoituong',$inputs['madoituong'])->first();
            if ($check == null) {
                $inputs['madoituong'] = getdate()[0];
                GiaNuocSachShDm::create($inputs);
            } else {
                $check->update($inputs);
            }
            return redirect('/gianuocsachsinhhoat/danhmuc');
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
        $model = GiaNuocSachShDm::where('madoituong',$inputs['madoituong'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            GiaNuocSachShDm::where('madoituong',$inputs['madoituong'])->delete();
            return redirect('/gianuocsachsinhhoat/danhmuc');
        }else
            return view('errors.notlogin');
    }
}
