<?php

namespace App\Http\Controllers\congbo\kekhaigia;

use App\Model\manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdCt;
use App\Model\system\dsdiaban;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CongboGiaXMTXDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $m_donvi = getDoanhNghiepNhapLieu('SSA', 'XMTXD');
        $m_diaban = dsdiaban::wherein('madiaban', array_column($m_donvi->toarray(),'madiaban'))->get();
        $inputs = $request->all();
        $inputs['url'] = '/cbkkgiaxmtxd';
        $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
        if(count($m_donvi) == 0){
            $inputs['madv'] = isset($inputs['madv']) ? $inputs['madv'] : null;
        }else{
            $inputs['madv'] = isset($inputs['madv']) ? $inputs['madv'] : $m_donvi->first()->madv;
        }

        //$inputs['paginate'] = isset($inputs['paginate']) ? $inputs['paginate'] : 5;
        $model = KkGiaXmTxdCt::join('kkgiaxmtxd','kkgiaxmtxd.mahs','=','kkgiaxmtxdct.mahs')
            ->where('kkgiaxmtxd.trangthai','CB')->where('kkgiaxmtxd.madv',$inputs['madv']);

        if ($inputs['nam'] != 'all')
            $model = $model->whereYear('ngayhieuluc', $inputs['nam']);

        return view('congbo.KeKhaiGia.XiMangTXD.index')
            ->with('model',$model->get())
            ->with('m_donvi',$m_donvi)
            ->with('m_diaban',$m_diaban)
            ->with('inputs',$inputs)
            ->with('pageTitle','Thông tin kê khai giá xi măng, thép xây dựng');
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
