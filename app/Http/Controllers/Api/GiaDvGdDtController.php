<?php

namespace App\Http\Controllers\Api;

use App\Model\API\GiaDvGdDt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class GiaDvGdDtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = GiaDvGdDt::all();
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
        $model = GiaDvGdDt::create($request->all());
        return new GiaDvGdDt($model);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\API\GiaDvGdDt  $giaDvGdDt
     * @return \Illuminate\Http\Response
     */
    public function show(GiaDvGdDt $giaDvGdDt)
    {
        return $giaDvGdDt;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\API\GiaDvGdDt  $giaDvGdDt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GiaDvGdDt $giaDvGdDt)
    {
        return $giaDvGdDt->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\API\GiaDvGdDt  $giaDvGdDt
     * @return \Illuminate\Http\Response
     */
    public function destroy(GiaDvGdDt $giaDvGdDt)
    {
        $giaDvGdDt->delete();
    }
}
