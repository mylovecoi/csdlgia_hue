<?php
Route::get('kekhaigiadvcang','manage\kekhaigia\kkgiadvcang\GiaDvCangController@index');
Route::get('kekhaigiadvcang/create','manage\kekhaigia\kkgiadvcang\GiaDvCangController@create');
Route::post('kekhaigiadvcang/store','manage\kekhaigia\kkgiadvcang\GiaDvCangController@store');
Route::get('kekhaigiadvcang/edit','manage\kekhaigia\kkgiadvcang\GiaDvCangController@edit');
Route::get('kekhaigiadvcang/prints','manage\kekhaigia\kkgiadvcang\GiaDvCangController@show');

Route::get('kekhaigiadvcang/kiemtra','manage\kekhaigia\kkgiadvcang\GiaDvCangController@kiemtra');
Route::post('kekhaigiadvcang/chuyen','manage\kekhaigia\kkgiadvcang\GiaDvCangController@chuyen');
Route::get('kekhaigiadvcang/get_sohs','manage\kekhaigia\kkgiadvcang\GiaDvCangController@showlydo');
Route::post('kekhaigiadvcang/delete','manage\kekhaigia\kkgiadvcang\GiaDvCangController@delete');

Route::get('/kkdvcang/showlydo','manage\kekhaigia\kkgiadvcang\GiaDvCangController@showlydo');

Route::get('/giadvcangct/storett','manage\kekhaigia\kkgiadvcang\GiaDvCangCtController@store');
Route::get('/giadvcangct/edittt','manage\kekhaigia\kkgiadvcang\GiaDvCangCtController@edit');
Route::get('/giadvcangct/updatett','manage\kekhaigia\kkgiadvcang\GiaDvCangCtController@update');
Route::get('/giadvcangct/deletett','manage\kekhaigia\kkgiadvcang\GiaDvCangCtController@delete');

Route::get('xetduyetgiadvcang','manage\kekhaigia\kkgiadvcang\GiaDvCangXdController@index');
Route::post('xetduyetgiadvcang/tralai','manage\kekhaigia\kkgiadvcang\GiaDvCangXdController@tralai');
Route::get('xetduyetgiadvcang/ttnhanhs','manage\kekhaigia\kkgiadvcang\GiaDvCangXdController@ttnhanhs');
Route::post('xetduyetgiadvcang/nhanhs','manage\kekhaigia\kkgiadvcang\GiaDvCangXdController@nhanhs');
Route::post('xetduyetgiadvcang/chuyenxd','manage\kekhaigia\kkgiadvcang\GiaDvCangXdController@chuyenxd');
Route::post('xetduyetgiadvcang/congbo','manage\kekhaigia\kkgiadvcang\GiaDvCangXdController@congbo');

Route::get('timkiemgiadvcang','manage\kekhaigia\kkgiadvcang\GiaDvCangXdController@search');
Route::get('timkiemgiadvcang/printf','manage\kekhaigia\kkgiadvcang\GiaDvCangXdController@printf');

Route::get('/ttdnkkgiadvcang','manage\kekhaigia\kkgiadvcang\GiaDvCangXdController@ttdnkkgiadvcang');

Route::get('baocaogiadvcang','manage\kekhaigia\kkgiadvcang\GiaDvCangBcController@index');
Route::post('baocaogiadvcang/bc1','manage\kekhaigia\kkgiadvcang\GiaDvCangBcController@bc1');
Route::post('baocaogiadvcang/bc2','manage\kekhaigia\kkgiadvcang\GiaDvCangBcController@bc2');