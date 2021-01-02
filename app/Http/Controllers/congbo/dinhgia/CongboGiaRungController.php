<?php

namespace App\Http\Controllers\congbo\dinhgia;

use App\DiaBanHd;
use App\DmGiaRung;
use App\Model\manage\dinhgia\GiaRung;
use App\Model\view\view_giarung;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CongboGiaRungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/cbgiarung';

        $a_diaban = getDiaBan_XaHuyen('ADMIN');
        $inputs['nam'] = $inputs['nam'] ?? 'all';

        //lấy thông tin đơn vị
        $model = view_giarung::where('congbo', 'DACONGBO');
        $model_dk = GiaRung::where('congbo', 'DACONGBO')->where('ipf1','<>', '');
        if ($inputs['nam'] != 'all'){
            $model = $model->whereYear('thoidiem', $inputs['nam']);
            $model_dk = $model_dk->whereYear('thoidiem', $inputs['nam']);
        }

        $a_loairung = array_column(DmGiaRung::all()->toArray(),'tennhom','manhom');

        //dd($inputs);
        return view('congbo.DinhGia.GiaRung.index')
            ->with('model', $model->get())
            ->with('model_dk', $model_dk->get())
            ->with('inputs', $inputs)
            ->with('a_loairung', $a_loairung)
            ->with('a_diaban', $a_diaban)
            ->with('pageTitle', 'Thông tin hồ sơ giá rừng');
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
