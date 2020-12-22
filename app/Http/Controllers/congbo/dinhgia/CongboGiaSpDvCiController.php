<?php

namespace App\Http\Controllers\congbo\dinhgia;

use App\GiaThueTsCong;
use App\Model\manage\dinhgia\giaspdvci\GiaSpDvCi;
use App\Model\manage\dinhgia\giaspdvci\giaspdvcidm;
use App\Model\manage\dinhgia\GiaTaiSanCongDm;
use App\Model\manage\dinhgia\giathuemuanhaxh\dmnhaxh;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\view\view_giaspdvci;
use App\Model\view\view_giathuetscong;
use App\Town;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CongboGiaSpDvCiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $inputs = $request->all();
        $inputs['url'] = '/cbgiaspdvci';
        $a_diaban = getDiaBan_XaHuyen('ADMIN');
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $model = view_giaspdvci::where('congbo', 'DACONGBO');
        $model_dk = GiaSpDvCi::where('congbo', 'DACONGBO');
        if ($inputs['nam'] != 'all'){
            $model = $model->whereYear('thoidiem', $inputs['nam']);
            $model_dk = $model_dk->whereYear('thoidiem', $inputs['nam']);
        }
        $model = $model->get();
        $model_dk = $model_dk->where('ipf1','<>', '')->get();
        $a_ts = array_column(giaspdvcidm::all()->toArray(),'tenspdv','maspdv');
        //$a_ts = array_column(GiaTaiSanCongDm::all()->toArray(),'tentaisan','mataisan');
        $a_donvi = array_column(view_dsdiaban_donvi::all()->toArray(),'tendv','madv');
        //dd($a_ts);
        return view('congbo.DinhGia.GiaSpDvCi.index')
            ->with('model',$model)
            ->with('model_dk',$model_dk)
            ->with('inputs',$inputs)
            ->with('a_diaban',$a_diaban)
            ->with('a_ts',$a_ts)
            ->with('a_donvi',$a_donvi)
            ->with('pageTitle','Thông tin giá sản phẩm dịch vụ công ích');
    }
}
