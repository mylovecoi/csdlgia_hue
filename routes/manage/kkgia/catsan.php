<?php
Route::get('kekhaigiacatsan','manage\kekhaigia\kkcatsan\KkGiaCatSanController@index');
Route::get('kekhaigiacatsan/create','manage\kekhaigia\kkcatsan\KkGiaCatSanController@create');
Route::post('kekhaigiacatsan/store','manage\kekhaigia\kkcatsan\KkGiaCatSanController@store');
Route::get('kekhaigiacatsan/edit','manage\kekhaigia\kkcatsan\KkGiaCatSanController@edit');
Route::get('kekhaigiacatsan/prints','manage\kekhaigia\kkcatsan\KkGiaCatSanController@show');

Route::get('kekhaigiacatsan/kiemtra','manage\kekhaigia\kkcatsan\KkGiaCatSanController@kiemtra');
Route::post('kekhaigiacatsan/chuyen','manage\kekhaigia\kkcatsan\KkGiaCatSanController@chuyen');
Route::get('kekhaigiacatsan/get_sohs','manage\kekhaigia\kkcatsan\KkGiaCatSanController@showlydo');
Route::post('kekhaigiacatsan/delete','manage\kekhaigia\kkcatsan\KkGiaCatSanController@delete');

Route::get('/kkcatsan/showlydo','manage\kekhaigia\kkcatsan\KkGiaCatSanController@showlydo');

Route::get('/giacatsanct/storett','manage\kekhaigia\kkcatsan\KkGiaCatSanCtController@store');
Route::get('/giacatsanct/edittt','manage\kekhaigia\kkcatsan\KkGiaCatSanCtController@edit');
Route::get('/giacatsanct/updatett','manage\kekhaigia\kkcatsan\KkGiaCatSanCtController@update');
Route::get('/giacatsanct/deletett','manage\kekhaigia\kkcatsan\KkGiaCatSanCtController@delete');

Route::get('xetduyetkkgiacatsan','manage\kekhaigia\kkcatsan\KkGiaCatSanXdController@index');
Route::post('xetduyetkkgiacatsan/tralai','manage\kekhaigia\kkcatsan\KkGiaCatSanXdController@tralai');
Route::get('xetduyetkkgiacatsan/ttnhanhs','manage\kekhaigia\kkcatsan\KkGiaCatSanXdController@ttnhanhs');
Route::post('xetduyetkkgiacatsan/nhanhs','manage\kekhaigia\kkcatsan\KkGiaCatSanXdController@nhanhs');
Route::post('xetduyetkkgiacatsan/chuyenxd','manage\kekhaigia\kkcatsan\KkGiaCatSanXdController@chuyenxd');
Route::post('xetduyetkkgiacatsan/congbo','manage\kekhaigia\kkcatsan\KkGiaCatSanXdController@congbo');
//Ajax xd
Route::get('/ttdnkkcatsan','manage\kekhaigia\kkcatsan\KkGiaCatSanXdController@ttdnkkcatsan');

Route::get('timkiemkkgiacatsan','manage\kekhaigia\kkcatsan\KkGiaCatSanXdController@search');

Route::get('baocaokekhaicatsan','manage\kekhaigia\kkcatsan\KkGiaCatSanBcController@index');
Route::post('baocaokekhaicatsan/bc1','manage\kekhaigia\kkcatsan\KkGiaCatSanBcController@bc1');
Route::post('baocaokekhaicatsan/bc2','manage\kekhaigia\kkcatsan\KkGiaCatSanBcController@bc2');