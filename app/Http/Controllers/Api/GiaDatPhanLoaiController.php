<?php

namespace App\Http\Controllers\Api;

use App\Model\Api\giadatphanloai;
use App\Http\Resources;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Collection;

class GiaDatPhanLoaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = giadatphanloai::all();
        //return (new \App\Http\Resources\GiaDatPhanLoai(giadatphanloai::find(1)))->response()->header('X-Value', 'True');
        //return GiaDatPhanLoai::collection($model);
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
        $model = giadatphanloai::create($request->all());
        return new GiaDatPhanLoai($model);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Api\giadatphanloai  $giadatphanloai
     * @return \Illuminate\Http\Response
     */
    public function show(giadatphanloai $giadatphanloai)
    {
        return $giadatphanloai;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Api\giadatphanloai  $giadatphanloai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, giadatphanloai $giadatphanloai)
    {
        return $giadatphanloai->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Api\giadatphanloai  $giadatphanloai
     * @return \Illuminate\Http\Response
     */
    public function destroy(giadatphanloai $giadatphanloai)
    {
        $giadatphanloai->delete();
    }
}
