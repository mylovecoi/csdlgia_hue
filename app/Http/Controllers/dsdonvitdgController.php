<?php

namespace App\Http\Controllers;

use App\dsdonvitdg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class dsdonvitdgController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $model = dsdonvitdg::all();
            $inputs['url'] = '/thamdinhgia';
            return view('manage.thamdinhgia.donvi.index')
                ->with('inputs', $inputs)
                ->with('model', $model)
                ->with('pageTitle', 'Thông tin đơn vị thẩm định giá');
        } else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $check = dsdonvitdg::where('maso',$inputs['maso'])->first();
            if ($check == null) {
                $inputs['maso'] = getdate()[0];
                dsdonvitdg::create($inputs);
            } else {
                $check->update($inputs);
            }
            return redirect('/thamdinhgia/donvi');
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
        $model = dsdonvitdg::where('maso',$inputs['maso'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            dsdonvitdg::where('maso',$inputs['maso'])->delete();
            return redirect('/thamdinhgia/donvi');
        }else
            return view('errors.notlogin');
    }
}
