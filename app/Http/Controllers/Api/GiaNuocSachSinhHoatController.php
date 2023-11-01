<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources;
use App\Model\Api\GiaNuocSachSinhHoat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class GiaNuocSachSinhHoatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = GiaNuocSachSinhHoat::all();
        return response()->json($model, Response::HTTP_OK);
        //return GiaNuocSachSinhHoat::collection($model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = GiaNuocSachSinhHoat::create($request->all());
        return new GiaNuocSachSinhHoat($model);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\API\GiaNuocSachSinhHoat  $giaNuocSachSinhHoat
     * @return \Illuminate\Http\Response
     */
    public function show(GiaNuocSachSinhHoat $giaNuocSachSinhHoat)
    {
        return $giaNuocSachSinhHoat;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\API\GiaNuocSachSinhHoat  $giaNuocSachSinhHoat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GiaNuocSachSinhHoat $giaNuocSachSinhHoat)
    {
        return $giaNuocSachSinhHoat->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\API\GiaNuocSachSinhHoat  $giaNuocSachSinhHoat
     * @return \Illuminate\Http\Response
     */
    public function destroy(GiaNuocSachSinhHoat $giaNuocSachSinhHoat)
    {
        $giaNuocSachSinhHoat->delete();
    }
}
