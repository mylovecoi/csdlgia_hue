<?php

namespace App\Http\Controllers\congbo\dinhgia;

use App\DiaBanHd;
use App\DmGiaDvGdDt;
use App\Model\manage\dinhgia\GiaDvGdDt;
use App\Model\view\view_giadvgddt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CongboGiaDvGiaoDucDaoTaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/cbgiadvgiaoducdaotao';
        $a_diaban = getDiaBan_XaHuyen('ADMIN');
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $inputs['madiaban'] = $inputs['madiaban'] ?? array_key_first($a_diaban);
        $model = view_giadvgddt::where('congbo', 'DACONGBO');
        $model_dk = GiaDvGdDt::where('congbo', 'DACONGBO')->where('ipf1','<>', '');
        if ($inputs['nam'] != 'all'){
            $model = $model->where('nam', $inputs['nam']);
            $model_dk = $model_dk->where('nam', $inputs['nam']);
        }


        //dd($model->get());
        return view('congbo.DinhGia.GiaDvGDDT.index')
            ->with('model',$model->get())
            ->with('model_dk',$model_dk->get())
            ->with('a_diaban',$a_diaban)
            ->with('inputs',$inputs)
            ->with('pageTitle', 'Giá dịch vụ giáo dục đào tạo');
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
