<?php

Route::get('kekhaigiakcbtn','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnController@index');
Route::get('kekhaigiakcbtn/create','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnController@create');
Route::post('kekhaigiakcbtn/store','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnController@store');
Route::get('kekhaigiakcbtn/edit','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnController@edit');
Route::get('kekhaigiakcbtn/prints','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnController@show');

Route::get('kekhaigiakcbtn/kiemtra','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnController@kiemtra');
Route::post('kekhaigiakcbtn/chuyen','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnController@chuyen');
Route::get('kekhaigiakcbtn/get_sohs','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnController@showlydo');
Route::post('kekhaigiakcbtn/delete','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnController@delete');

Route::get('/kkkcbtn/showlydo','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnController@showlydo');

Route::get('/giakcbtnct/storett','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnCtController@store');
Route::get('/giakcbtnct/edittt','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnCtController@edit');
Route::get('/giakcbtnct/updatett','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnCtController@update');
Route::get('/giakcbtnct/deletett','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnCtController@delete');

Route::get('xetduyetgiakcbtn','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnXdController@index');
Route::post('xetduyetgiakcbtn/tralai','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnXdController@tralai');
Route::get('xetduyetgiakcbtn/ttnhanhs','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnXdController@ttnhanhs');
Route::post('xetduyetgiakcbtn/nhanhs','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnXdController@nhanhs');
Route::post('xetduyetgiakcbtn/chuyenxd','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnXdController@chuyenxd');
Route::post('xetduyetgiakcbtn/congbo','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnXdController@congbo');
//Ajax xd
Route::get('/ttdnkcbtn','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnXdController@ttdnkcbtn');

Route::get('timkiemgiakcbtn','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnXdController@search');
Route::get('timkiemgiakcbtn/printf','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnXdController@printf');

Route::get('baocaogiakcbtn','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnBcController@index');
Route::post('baocaogiakcbtn/bc1','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnBcController@bc1');
Route::post('baocaogiakcbtn/bc2','manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnBcController@bc2');