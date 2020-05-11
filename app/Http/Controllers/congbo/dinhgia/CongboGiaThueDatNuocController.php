<?php

namespace App\Http\Controllers\congbo\dinhgia;

use App\DiaBanHd;
use App\GiaThueDatNuoc;
use App\Model\system\dsdiaban;
use App\Model\view\view_giathuedatnuoc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CongboGiaThueDatNuocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/cbgiathuedatnuoc';
        $a_diaban = getDiaBan_XaHuyen('ADMIN');
        $inputs['madiaban'] = $inputs['madiaban'] ?? array_key_first($a_diaban);
        $inputs['nam'] = $inputs['nam'] ?? 'all';

        $model = view_giathuedatnuoc::where('congbo', 'DACONGBO');
        if ($inputs['nam'] != 'all')
            $model = $model->whereYear('thoidiem', $inputs['nam']);

        return view('congbo.DinhGia.GiaThueDatNuoc.index')
            ->with('model', $model->get())
            ->with('inputs', $inputs)
            ->with('a_diaban', $a_diaban)
            ->with('pageTitle','Thông tin hồ sơ thuê mặt đất, mặt nước');
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
