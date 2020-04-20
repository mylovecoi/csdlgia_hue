<?php

namespace App\Http\Controllers\manage\giadatdiaban;

use App\Model\manage\dinhgia\giadatdiaban\TtGiaDatDiaBan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;


class TtGiaDatDiaBanController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            if(can('dmgiacldat','index')) {
                $model = TtGiaDatDiaBan::all();
                $inputs['url'] = '/giacldat';
                return view('manage.dinhgia.giadatdiaban.thongtuquyetdinh.index')
                    ->with('model',$model)
                    ->with('inputs',$inputs)
                    ->with('pageTitle','Thông tư giá đất theo địa bàn');
            }else
                return view('errors.noperm');

        } else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['soqd'] = chuanhoachuoi($inputs['soqd']);
            $inputs['ngayqd_banhanh'] = getDateToDb($inputs['ngayqd_banhanh']);
            $inputs['ngayqd_apdung'] = getDateToDb($inputs['ngayqd_apdung']);
            if(isset($inputs['ipf1'])){
                $ipf1 = $request->file('ipf1');
                $name = $inputs['soqd'] .'&1.'.$ipf1->getClientOriginalName();
                $ipf1->move(public_path() . '/data/giadatdiaban/', $name);
                $inputs['ipf1']= $name;
            }

            $model = TtGiaDatDiaBan::where('soqd',$inputs['soqd'])->first();
            if($model == null){
                $inputs['trangthai'] = 'CHT';
                TtGiaDatDiaBan::create($inputs);
            }else{
                $model->update($inputs);
            }
            return redirect('/giacldat/danhmuc/');
        } else
            return view('errors.notlogin');
    }

    public function show(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );

        $inputs = $request->all();
        $model = TtGiaDatDiaBan::where('soqd',$inputs['soqd'])->first();
        die($model);
    }
    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            TtGiaDatDiaBan::where('soqd',$inputs['soqd'])->delete();
            return redirect('/giacldat/danhmuc/');
        } else
            return view('errors.notlogin');
    }
}
