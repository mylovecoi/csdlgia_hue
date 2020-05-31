<?php

namespace App\Http\Controllers\system;

use App\DmQdGiaDat;
use App\GiaDatDiaBanDm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GiaDatDiaBanDmController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $model = GiaDatDiaBanDm::all();
            return view('system.giadatdiaban.index')
                ->with('model',$model)
                ->with('pageTitle','Danh mục loại đất');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = GiaDatDiaBanDm::where('maloaidat',$inputs['maloaidat'])->first();
            if($model == null){
                GiaDatDiaBanDm::create($inputs);
            }else{
                $model->update($inputs);
            }
            return redirect('dmloaidat');
        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $id = $inputs['iddelete'];
            $model = GiaDatDiaBanDm::findOrFail($id);
            $model->delete();
            return redirect('dmloaidat');
        }else
            return view('errors.notlogin');
    }
}
