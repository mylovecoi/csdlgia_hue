<?php

namespace App\Http\Controllers\congbo;

use App\Model\system\company\Company;
use App\Model\view\view_binhongia;
use App\Model\view\view_dmnganhnghe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\manage\dinhgia\giavangngoaite\giavangngoaite;

class CongBoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cbgiavangngoaite(Request $request){
        $inputs = $request->all();
        $inputs['url'] = '/cbgiavangngoaite';      
        $inputs['nam'] = $inputs['nam'] ?? date('Y');
        $inputs['thang'] = $inputs['thang'] ?? date('m');
        $model = giavangngoaite::wheremonth('thoidiem', $inputs['thang'])
            ->whereYear('thoidiem', $inputs['nam'])->get();
        //dd($model);
        return view('congbo.GiaVangNgoaiTe.index')
            ->with('model', $model->sortby('thoidiem'))
            ->with('inputs', $inputs)         
            ->with('pageTitle', 'Thông tin giá vàng, ngoại tệ');
    }
}
