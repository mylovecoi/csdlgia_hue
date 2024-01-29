<?php

namespace App\Http\Controllers;

use App\DmHangHoa;
use App\DmNhomHangHoa;
use App\Model\system\dmdvt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DmHangHoaController extends Controller
{
    public function index(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = DmHangHoa::where('manhom',$inputs['manhom'])->get();
            $modelnhom = DmNhomHangHoa::where('manhom',$inputs['manhom'])->first();
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            $inputs['url'] = '/thamdinhgia';
            return view('manage.thamdinhgia.danhmuc.chitiet.index')
                ->with('model',$model)
                ->with('modelnhom',$modelnhom)
                ->with('a_dvt',$a_dvt)
                ->with('inputs',$inputs)
                ->with('pageTitle','Danh mục hàng hóa');
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
            //dd($inputs);
            $inputs['mahanghoa'] = chuanhoatruong($inputs['mahanghoa']);
            $model = DmHangHoa::where('mahanghoa',$inputs['mahanghoa'])->first();
            if($inputs['trangthai'] == 'ADD'){
                if($model == null){
                    $inputs['theodoi'] = 'TD';
                    DmHangHoa::create($inputs);
                }else{
                    return view('errors.duplicate')
                        ->with('message', 'Mã hàng hóa này đã được sử dụng.')
                        ->with('url', 'thamdinhgia/danhmuc/detail?manhom='.$inputs['manhom']);
                }
            }else {
                $model->update($inputs);
            }

            return redirect('thamdinhgia/danhmuc/detail?manhom='.$inputs['manhom']);
        }else
            return view('errors.notlogin');
    }

    public function show(Request $request){
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        $inputs = $request->all();
        $model = DmHangHoa::where('mahanghoa',$inputs['mahanghoa'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            //dd($inputs);
            $model = DmHangHoa::where('manhom',$inputs['manhom'])->where('mahanghoa',$inputs['mahanghoa'])->first();
            //dd($model);
            $model->delete();
            return redirect('/thamdinhgia/danhmuc/detail?&manhom='.$inputs['manhom']);
        }else
            return view('errors.notlogin');
    }
}
