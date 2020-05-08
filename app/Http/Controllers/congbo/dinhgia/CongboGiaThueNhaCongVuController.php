<?php

namespace App\Http\Controllers\congbo\dinhgia;

use App\DiaBanHd;
use App\Model\manage\dinhgia\GiaTaiSanCongDm;
use App\Model\manage\dinhgia\GiaThueNhaCongVu;
use App\Model\view\view_giathuetscong;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CongboGiaThueNhaCongVuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/cbgiathuenhacongvu';
        $a_diaban = getDiaBan_XaHuyen('ADMIN');
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $model = view_giathuetscong::where('congbo', 'DACONGBO');
        if ($inputs['nam'] != 'all')
            $model = $model->whereYear('thoidiem', $inputs['nam']);
        $a_ts = array_column(GiaTaiSanCongDm::all()->toArray(),'tentaisan','mataisan');
        return view('congbo.DinhGia.ThueNhaCongVu.index')
            ->with('model',$model->get())
            ->with('inputs',$inputs)
            ->with('a_diaban',$a_diaban)
            ->with('a_ts',$a_ts)
            ->with('pageTitle','Thông tin giá thuê nhà ở công vụ');
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
