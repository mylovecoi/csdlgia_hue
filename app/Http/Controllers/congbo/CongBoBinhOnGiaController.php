<?php

namespace App\Http\Controllers\congbo;

use App\Model\system\company\Company;
use App\Model\view\view_binhongia;
use App\Model\view\view_dmnganhnghe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CongBoBinhOnGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $inputs = $request->all();
        $inputs['url'] = '/cbbinhongia';
        $a_diaban = getDiaBan_XaHuyen('ADMIN');
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $inputs['manghe'] = $inputs['manghe'] ?? 'all';
        $model = view_binhongia::where('congbo', 'DACONGBO');
        if ($inputs['nam'] != 'all')
            $model = $model->whereYear('thoidiem', $inputs['nam']);
        if ($inputs['manghe'] != 'all')
            $model = $model->where('manghe', $inputs['manghe']);
        $a_donvi = array_column(Company::all()->toArray(),'tendn','madv');
        $a_bog = array_column(view_dmnganhnghe::where('manganh', 'BOG')->get()->toarray(),'tennghe','manghe');
        //dd($model->get());
        return view('congbo.BinhOnGia.index')
            ->with('model',$model->get())
            ->with('inputs',$inputs)
            ->with('a_diaban',$a_diaban)
            ->with('a_bog',$a_bog)
            ->with('a_donvi',$a_donvi)
            ->with('pageTitle','Thông tin mặt hàng bình ổn giá');
    }
}
