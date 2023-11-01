<?php

namespace App\Http\Controllers\Api;

use App\Model\Api\giadatphanloai;
use App\Model\Api\GiaRung;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class GiaRungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = GiaRung::all();
        return response()->json($model, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model =  giadatphanloai::create($request->all());
        return new GiaDatPhanLoai($model);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\API\GiaRung  $giaRung
     * @return \Illuminate\Http\Response
     */
    public function show(GiaRung $giaRung)
    {
        return $giaRung;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\API\GiaRung  $giaRung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GiaRung $giaRung)
    {
        return $giaRung->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\API\GiaRung  $giaRung
     * @return \Illuminate\Http\Response
     */
    public function destroy(GiaRung $giaRung)
    {
        $giaRung->delete();
    }
}
