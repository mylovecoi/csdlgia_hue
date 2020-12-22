<?php

namespace App\Http\Controllers\congbo\dinhgia;

use App\Model\manage\dinhgia\giadvkcb\DvKcb;
use App\Model\view\view_giadvkcb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CongboGiaDvKhamChuaBenhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/cbdichvukcb';
        $a_diaban = getDiaBan_XaHuyen('ADMIN');
        $inputs['nam'] = $inputs['nam'] ?? 'all';

        $model = view_giadvkcb::where('congbo', 'DACONGBO');
        $model_dk = DvKcb::where('congbo', 'DACONGBO');
        if ($inputs['nam'] != 'all'){
            $model = $model->whereYear('thoidiem', $inputs['nam']);
            $model_dk = $model_dk->whereYear('thoidiem', $inputs['nam']);
        }
        $model = $model->get();
        $model_dk = $model_dk->where('ipf1','<>', '')->get();


        //dd($model->get());
        return view('congbo.DinhGia.GiaDvKhamChuaBenh.index')
            ->with('model',$model)
            ->with('model_dk',$model_dk)
            ->with('a_diaban',$a_diaban)
            ->with('inputs',$inputs)
            ->with('pageTitle','Thông tin giá dịch vụ khám chữa bệnh');

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
