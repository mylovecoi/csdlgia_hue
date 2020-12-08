<?php

namespace App\Http\Controllers\system;

use App\DmHangHoa;
use App\DmNhomHangHoa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;


class DmNhomHangHoaController extends Controller
{
    public function index(){
        if(Session::has('admin')){
            $model = DmNhomHangHoa::where('phanloai','GIAHHDVK')->get();
            $inputs['url'] = '/dmnhomhh';
            return view('system.dmnhomhanghoa.index')
                ->with('model',$model)
                ->with('inputs', $inputs)
                ->with('pageTitle','Danh mục nhóm hàng hóa');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['manhom'] = chuanhoatruong($inputs['manhom']);
            $check = DmNhomHangHoa::where('manhom', $inputs['manhom'])->where('phanloai','GIAHHDVK')->first();
            if ($inputs['trangthai'] == 'ADD') {
                if ($check != null) {
                    return view('errors.duplicate')
                        ->with('message', 'Mã nhóm hàng hóa này đã được sử dụng.')
                        ->with('url', '/dmnhomhh/danhsach');
                } else {
                    $inputs['theodoi'] = 'TD';
                    $inputs['phanloai'] = 'GIAHHDVK';
                    DmNhomHangHoa::create($inputs);
                }
            } else {
                $check->update($inputs);
            }

            return redirect('/dmnhomhh/danhsach');
        } else
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
        $model = DmNhomHangHoa::where('manhom',$inputs['manhom'])->where('phanloai','GIAHHDVK')->first();
        die($model);
    }

    function epExcel(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model_nhom = DmNhomHangHoa::where('manhom', $inputs['manhom'])->first();
            $model = DmHangHoa::where('manhom', $inputs['manhom'])->get();
            //dd($model);
            Excel::create('DMHANGHOA-' . $model_nhom->manhom, function ($excel) use ($model_nhom, $model) {
                $excel->sheet('DMHANGHOA', function ($sheet) use ($model_nhom, $model) {
                    $sheet->loadView('manage.thamdinhgia.danhmuc.excel.danhmuc')
                        ->with('model_nhom', $model_nhom)
                        ->with('model', $model)
                        ->with('pageTitle', 'Danh sách hàng hóa');
                    //$sheet->setPageMargin(0.25);
                    $sheet->setAutoSize(false);
                    $sheet->setFontFamily('Tahoma');
                    $sheet->setFontBold(false);

                });
            })->download('xlsx');

        } else
            return view('errors.notlogin');
    }
}
