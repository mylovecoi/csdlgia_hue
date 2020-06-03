<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('/giadatphanloai', 'Api\GiaDatPhanLoaiController');
Route::apiResource('/giathuedatnuoc', 'Api\GiaThueDatNuocController');
Route::apiResource('/thuemuanhaxahoi', 'Api\ThueMuaNhaXaHoiController');
Route::apiResource('/gianuocsachsinhhoat', 'Api\GiaNuocSachSinhHoatController');
Route::apiResource('/giaspdvci', 'Api\GiaSpdvciController');
Route::apiResource('/giarung', 'Api\GiaRungController');
Route::apiResource('/giathuetscong', 'Api\GiaThueTSCongController');
Route::apiResource('/giadvgddt', 'Api\GiaDvGdDtController');
Route::apiResource('/giadvkcb', 'Api\DvKcbController');

