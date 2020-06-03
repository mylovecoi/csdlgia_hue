<?php
Route::get('kekhaigiadvcahue','manage\kekhaigia\kkdvch\KkGiaDvChController@index');
Route::get('kekhaigiadvcahue/create','manage\kekhaigia\kkdvch\KkGiaDvChController@create');
Route::post('kekhaigiadvcahue/store','manage\kekhaigia\kkdvch\KkGiaDvChController@store');
Route::get('kekhaigiadvcahue/edit','manage\kekhaigia\kkdvch\KkGiaDvChController@edit');
Route::get('kekhaigiadvcahue/prints','manage\kekhaigia\kkdvch\KkGiaDvChController@show');

Route::get('kekhaigiadvcahue/kiemtra','manage\kekhaigia\kkdvch\KkGiaDvChController@kiemtra');
Route::post('kekhaigiadvcahue/chuyen','manage\kekhaigia\kkdvch\KkGiaDvChController@chuyen');
Route::get('kekhaigiadvcahue/get_sohs','manage\kekhaigia\kkdvch\KkGiaDvChController@showlydo');
Route::post('kekhaigiadvcahue/delete','manage\kekhaigia\kkdvch\KkGiaDvChController@delete');

Route::get('/kkdvch/showlydo','manage\kekhaigia\kkdvch\KkGiaDvChController@showlydo');

Route::get('/giadvchct/storett','manage\kekhaigia\kkdvch\KkGiaDvChCtController@store');
Route::get('/giadvchct/edittt','manage\kekhaigia\kkdvch\KkGiaDvChCtController@edit');
Route::get('/giadvchct/updatett','manage\kekhaigia\kkdvch\KkGiaDvChCtController@update');
Route::get('/giadvchct/deletett','manage\kekhaigia\kkdvch\KkGiaDvChCtController@delete');

Route::get('xetduyetkkgiadvcahue','manage\kekhaigia\kkdvch\KkGiaDvChXdController@index');
Route::post('xetduyetkkgiadvcahue/tralai','manage\kekhaigia\kkdvch\KkGiaDvChXdController@tralai');
Route::get('xetduyetkkgiadvcahue/ttnhanhs','manage\kekhaigia\kkdvch\KkGiaDvChXdController@ttnhanhs');
Route::post('xetduyetkkgiadvcahue/nhanhs','manage\kekhaigia\kkdvch\KkGiaDvChXdController@nhanhs');
Route::post('xetduyetkkgiadvcahue/chuyenxd','manage\kekhaigia\kkdvch\KkGiaDvChXdController@chuyenxd');
Route::post('xetduyetkkgiadvcahue/congbo','manage\kekhaigia\kkdvch\KkGiaDvChXdController@congbo');
//Ajax xd
Route::get('/ttdnkkdvch','manage\kekhaigia\kkdvch\KkGiaDvChXdController@ttdnkkdvch');

Route::get('timkiemkkgiadvcahue','manage\kekhaigia\kkdvch\KkGiaDvChXdController@search');

Route::get('baocaokekhaidvcahue','manage\kekhaigia\kkdvch\KkGiaDvChBcController@index');
Route::post('baocaokekhaidvcahue/bc1','manage\kekhaigia\kkdvch\KkGiaDvChBcController@bc1');
Route::post('baocaokekhaidvcahue/bc2','manage\kekhaigia\kkdvch\KkGiaDvChBcController@bc2');