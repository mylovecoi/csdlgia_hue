<?php

Route::get('kekhaigiadvhdtm','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmController@index');
Route::get('kekhaigiadvhdtm/create','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmController@create');
Route::post('kekhaigiadvhdtm/store','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmController@store');
Route::get('kekhaigiadvhdtm/edit','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmController@edit');
Route::get('kekhaigiadvhdtm/prints','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmController@show');

Route::get('kekhaigiadvhdtm/kiemtra','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmController@kiemtra');
Route::post('kekhaigiadvhdtm/chuyen','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmController@chuyen');
Route::get('kekhaigiadvhdtm/get_sohs','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmController@showlydo');
Route::post('kekhaigiadvhdtm/delete','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmController@delete');

Route::get('/kkdvhdtm/showlydo','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmController@showlydo');

Route::get('/giadvhdtmct/storett','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmCtController@store');
Route::get('/giadvhdtmct/edittt','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmCtController@edit');
Route::get('/giadvhdtmct/updatett','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmCtController@update');
Route::get('/giadvhdtmct/deletett','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmCtController@delete');

Route::get('xetduyetkkgiadvhdtm','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmXdController@index');
Route::post('xetduyetkkgiadvhdtm/tralai','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmXdController@tralai');
Route::get('xetduyetkkgiadvhdtm/ttnhanhs','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmXdController@ttnhanhs');
Route::post('xetduyetkkgiadvhdtm/nhanhs','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmXdController@nhanhs');
Route::post('xetduyetkkgiadvhdtm/chuyenxd','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmXdController@chuyenxd');
Route::post('xetduyetkkgiadvhdtm/congbo','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmXdController@congbo');
//Ajax xd
Route::get('/ttdndvhdtm','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmXdController@ttdndvhdtm');

Route::get('timkiemgiadvhdtm','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmXdController@search');
Route::get('timkiemgiadvhdtm/printf','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmXdController@printf');

Route::get('baocaokkgiadvhdtm','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmBcController@index');
Route::post('baocaokkgiadvhdtm/bc1','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmBcController@bc1');
Route::post('baocaokkgiadvhdtm/bc2','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmBcController@bc2');
?>