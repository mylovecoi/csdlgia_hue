<?php

namespace App\Http\Controllers\congbo\dinhgia;

use App\GiaDatDiaBanDm;
use App\Model\manage\dinhgia\giadatdiaban\TtGiaDatDiaBan;
use App\Model\system\dsxaphuong;
use App\Model\view\view_giadatdiaban;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CongboGiaDatDiaBanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {$inputs = $request->all();
        $inputs['url'] = '/cbgiadatdiaban';
        //lấy địa bàn
        //$a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
        $a_diaban = getDiaBan_XaHuyen('ADMIN');
        //$m_donvi = getDonViNhapLieu('ADMIN');
        //$m_donvi_th = getDonViTongHop('giacldat',\session('admin')->level, \session('admin')->madiaban);
        //$m_donvi_th = getDonViTongHop('giacldat',\session('admin')->level, \session('admin')->madiaban);
        $inputs['madiaban'] = $inputs['madiaban'] ?? array_key_first($a_diaban);

        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $inputs['maxp'] = $inputs['maxp'] ?? 'all';
        $inputs['maloaidat'] = $inputs['maloaidat'] ?? 'all';
        $a_loaidat = array_column(GiaDatDiaBanDm::all()->toArray(),'loaidat','maloaidat');
        $a_xp = array_column(dsxaphuong::where('madiaban',$inputs['madiaban'])->get()->toarray(),'tenxp', 'maxp');
        $a_qd = array_column(TtGiaDatDiaBan::all()->toarray(),'mota', 'soqd');
        //lấy thông tin đơn vị
        $model = view_giadatdiaban::where('madiaban', $inputs['madiaban'])->where('congbo', 'DACONGBO');
        if ($inputs['nam'] != 'all')
            $model = $model->whereyear('thoidiem', $inputs['nam']);
        if ($inputs['maxp'] != 'all')
            $model = $model->where('maxp', $inputs['maxp']);
        if ($inputs['maloaidat'] != 'all')
            $model = $model->where('maloaidat', $inputs['maloaidat']);
        //dd($inputs);

        return view('congbo.DinhGia.GiaDatDiaBan.index')
            ->with('model', $model->orderby('thoidiem','desc')->get())
            ->with('inputs', $inputs)
            //->with('m_diaban', $m_diaban)
            ->with('a_diaban', $a_diaban)
            ->with('a_loaidat', $a_loaidat)
            ->with('a_xp', $a_xp)
            ->with('a_qd', $a_qd)
            //->with('m_donvi', $m_donvi)
            //->with('m_donvi_th', $m_donvi_th)
            //->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
            //->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
            ->with('pageTitle', 'Thông tin hồ sơ giá đất');

        return view('congbo.DinhGia.GiaDatDiaBan.index')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('diabans',$diabans)
                ->with('loaidats',$loaidats)
                ->with('pageTitle','Thông tin gia đất theo địa bàn');

        //} else
        //      return view('errors.notlogin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
