<?php
Route::get('kekhaigiadatsanlap','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapController@index');
Route::get('kekhaigiadatsanlap/create','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapController@create');
Route::post('kekhaigiadatsanlap/store','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapController@store');
Route::get('kekhaigiadatsanlap/edit','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapController@edit');
Route::get('kekhaigiadatsanlap/prints','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapController@show');

Route::get('kekhaigiadatsanlap/kiemtra','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapController@kiemtra');
Route::post('kekhaigiadatsanlap/chuyen','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapController@chuyen');
Route::get('kekhaigiadatsanlap/get_sohs','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapController@showlydo');
Route::post('kekhaigiadatsanlap/delete','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapController@delete');

Route::get('/kkdatsanlap/showlydo','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapController@showlydo');

Route::get('/giadatsanlapct/storett','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapCtController@store');
Route::get('/giadatsanlapct/edittt','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapCtController@edit');
Route::get('/giadatsanlapct/updatett','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapCtController@update');
Route::get('/giadatsanlapct/deletett','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapCtController@delete');

Route::get('xetduyetkkgiadatsanlap','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapXdController@index');
Route::post('xetduyetkkgiadatsanlap/tralai','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapXdController@tralai');
Route::get('xetduyetkkgiadatsanlap/ttnhanhs','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapXdController@ttnhanhs');
Route::post('xetduyetkkgiadatsanlap/nhanhs','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapXdController@nhanhs');
Route::post('xetduyetkkgiadatsanlap/chuyenxd','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapXdController@chuyenxd');
Route::post('xetduyetkkgiadatsanlap/congbo','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapXdController@congbo');
//Ajax xd
Route::get('/ttdnkkdatsanlap','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapXdController@ttdnkkdatsanlap');

Route::get('timkiemkkgiadatsanlap','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapXdController@search');
Route::get('timkiemkkgiadatsanlap/printf','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapXdController@printf');

Route::get('baocaokekhaidatsanlap','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapBcController@index');
Route::post('baocaokekhaidatsanlap/bc1','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapBcController@bc1');
Route::post('baocaokekhaidatsanlap/bc2','manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapBcController@bc2');