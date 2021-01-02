<?php

namespace App\Http\Controllers\congbo\dinhgia;

use App\Model\manage\dinhgia\giathuemuanhaxh\dmnhaxh;
use App\Model\manage\dinhgia\giathuemuanhaxh\GiaThueMuaNhaXh;
use App\Model\view\view_giathuemuanhaxh;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CongboThueMuaNhaXHController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/cbthuemuanhaxh';
        $a_diaban = getDiaBan_XaHuyen('ADMIN');
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $model = view_giathuemuanhaxh::where('congbo', 'DACONGBO');
        $model_dk = GiaThueMuaNhaXh::where('congbo', 'DACONGBO')->where('ipf1','<>', '');
        if ($inputs['nam'] != 'all'){
            $model = $model->whereYear('thoidiem', $inputs['nam']);
            $model_dk = $model_dk->whereYear('thoidiem', $inputs['nam']);
        }
        $a_nhaxh = array_column(dmnhaxh::all()->toArray(),'tennha','maso');
        return view('congbo.DinhGia.ThueMuaNhaXH.index')
            ->with('model',$model->get())
            ->with('model_dk',$model_dk->get())
            ->with('inputs',$inputs)
            ->with('a_diaban',$a_diaban)
            ->with('a_nhaxh',$a_nhaxh)
            ->with('pageTitle','Thông tin giá thuê, thuê mua nhà ở xã hội');
    }
}
