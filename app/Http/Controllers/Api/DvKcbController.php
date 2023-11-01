<?php

namespace App\Http\Controllers\Api;

use App\Model\Api\DvKcb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class DvKcbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = DvKcb::all();
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
        $model = DvKcb::create($request->all());
        return new DvKcb($model);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\API\DvKcb  $dvKcb
     * @return \Illuminate\Http\Response
     */
    public function show(DvKcb $dvKcb)
    {
        return $dvKcb;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\API\DvKcb  $dvKcb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DvKcb $dvKcb)
    {
        return $dvKcb->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\API\DvKcb  $dvKcb
     * @return \Illuminate\Http\Response
     */
    public function destroy(DvKcb $dvKcb)
    {
        $dvKcb->delete();
    }
}
