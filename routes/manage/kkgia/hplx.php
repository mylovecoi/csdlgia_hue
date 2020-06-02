<?php
Route::get('kekhaigiahplx','manage\kekhaigia\kkhplx\KkGiaHpLxController@index');
Route::get('kekhaigiahplx/create','manage\kekhaigia\kkhplx\KkGiaHpLxController@create');
Route::post('kekhaigiahplx/store','manage\kekhaigia\kkhplx\KkGiaHpLxController@store');
Route::get('kekhaigiahplx/edit','manage\kekhaigia\kkhplx\KkGiaHpLxController@edit');
Route::get('kekhaigiahplx/prints','manage\kekhaigia\kkhplx\KkGiaHpLxController@show');

Route::get('kekhaigiahplx/kiemtra','manage\kekhaigia\kkhplx\KkGiaHpLxController@kiemtra');
Route::post('kekhaigiahplx/chuyen','manage\kekhaigia\kkhplx\KkGiaHpLxController@chuyen');
Route::get('kekhaigiahplx/get_sohs','manage\kekhaigia\kkhplx\KkGiaHpLxController@showlydo');
Route::post('kekhaigiahplx/delete','manage\kekhaigia\kkhplx\KkGiaHpLxController@delete');

Route::get('/kkhplx/showlydo','manage\kekhaigia\kkhplx\KkGiaHpLxController@showlydo');

Route::get('/giahplxct/storett','manage\kekhaigia\kkhplx\KkGiaHpLxCtController@store');
Route::get('/giahplxct/edittt','manage\kekhaigia\kkhplx\KkGiaHpLxCtController@edit');
Route::get('/giahplxct/updatett','manage\kekhaigia\kkhplx\KkGiaHpLxCtController@update');
Route::get('/giahplxct/deletett','manage\kekhaigia\kkhplx\KkGiaHpLxCtController@destroy');

Route::get('xetduyetkkgiahplx','manage\kekhaigia\kkhplx\KkGiaHpLxXdController@index');
Route::post('xetduyetkkgiahplx/tralai','manage\kekhaigia\kkhplx\KkGiaHpLxXdController@tralai');
Route::get('xetduyetkkgiahplx/ttnhanhs','manage\kekhaigia\kkhplx\KkGiaHpLxXdController@ttnhanhs');
Route::post('xetduyetkkgiahplx/nhanhs','manage\kekhaigia\kkhplx\KkGiaHpLxXdController@nhanhs');
Route::post('xetduyetkkgiahplx/chuyenxd','manage\kekhaigia\kkhplx\KkGiaHpLxXdController@chuyenxd');
Route::post('xetduyetkkgiahplx/congbo','manage\kekhaigia\kkhplx\KkGiaHpLxXdController@congbo');
//Ajax xd
Route::get('/ttdnkkhplx','manage\kekhaigia\kkhplx\KkGiaHpLxXdController@ttdnkkhplx');

Route::get('timkiemkkgiahplx','manage\kekhaigia\kkhplx\KkGiaHpLxXdController@search');

Route::get('baocaokekhaihplx','manage\kekhaigia\kkhplx\KkGiaHpLxBcController@index');
Route::post('baocaokekhaihplx/bc1','manage\kekhaigia\kkhplx\KkGiaHpLxBcController@bc1');
Route::post('baocaokekhaihplx/bc2','manage\kekhaigia\kkhplx\KkGiaHpLxBcController@bc2');