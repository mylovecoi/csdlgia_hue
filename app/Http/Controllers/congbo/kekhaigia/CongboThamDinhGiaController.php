<?php

namespace App\Http\Controllers\congbo\kekhaigia;

use App\Model\view\view_thamdinhgia;
use App\ThamDinhGiaCt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CongboThamDinhGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inputs = $request->all();
        $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
        $inputs['tents'] = isset($inputs['tents']) ? $inputs['tents'] : '';
        $inputs['paginate'] = isset($inputs['paginate']) ? $inputs['paginate'] : 5;
        $model = view_thamdinhgia::where('congbo', 'DACONGBO');

        if($inputs['nam'] != 'all')
            $model = $model->whereYear('thoidiem',$inputs['nam']);
        if($inputs['tents'] != '')
            $model = $model->where('tents','like','%'.$inputs['tents'].'%');
        //$model = $model->paginate($inputs['paginate']);

        return view('congbo.ThamDinhGia.index')
            ->with('inputs',$inputs)
            ->with('model',$model->get())
            ->with('pageTitle','Thông tin thẩm định giá tại địa phương');
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
