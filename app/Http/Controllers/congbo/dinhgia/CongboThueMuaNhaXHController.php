<?php

namespace App\Http\Controllers\congbo\dinhgia;

use App\Model\manage\dinhgia\giathuemuanhaxh\dmnhaxh;
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
        if ($inputs['nam'] != 'all')
            $model = $model->whereYear('thoidiem', $inputs['nam']);
        $a_nhaxh = array_column(dmnhaxh::all()->toArray(),'tennha','maso');
        return view('congbo.DinhGia.ThueMuaNhaXH.index')
            ->with('model',$model->get())
            ->with('inputs',$inputs)
            ->with('a_diaban',$a_diaban)
            ->with('a_nhaxh',$a_nhaxh)
            ->with('pageTitle','Thông tin giá thuê, thuê mua nhà ở xã hội');
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
