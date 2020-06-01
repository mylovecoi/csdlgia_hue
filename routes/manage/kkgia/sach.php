<?php
Route::get('thongtindnsach','manage\kekhaigia\kkgiasach\KkGiaSachController@ttdn');

Route::get('kekhaigiasach','manage\kekhaigia\kkgiasach\KkGiaSachController@index');
Route::get('kekhaigiasach/create','manage\kekhaigia\kkgiasach\KkGiaSachController@create');
Route::post('kekhaigiasach/store','manage\kekhaigia\kkgiasach\KkGiaSachController@store');
Route::get('kekhaigiasach/edit','manage\kekhaigia\kkgiasach\KkGiaSachController@edit');
Route::get('kekhaigiasach/prints','manage\kekhaigia\kkgiasach\KkGiaSachController@show');
Route::get('kekhaigiasach/get_sohs','manage\kekhaigia\kkgiasach\KkGiaSachController@showlydo');

Route::post('kekhaigiasach/chuyen','manage\kekhaigia\kkgiasach\KkGiaSachController@chuyen');
Route::get('/giasach/showlydo','manage\kekhaigia\kkgiasach\KkGiaSachController@showlydo');
Route::post('kekhaigiasach/delete','manage\kekhaigia\kkgiasach\KkGiaSachController@delete');

Route::get('kekhaigiasach/kiemtra','manage\kekhaigia\kkgiasach\KkGiaSachController@kiemtra');

Route::get('/giasachctdf/storett','manage\kekhaigia\kkgiasach\KkGiaSachCtDfController@store');
Route::get('/giasachctdf/edittt','manage\kekhaigia\kkgiasach\KkGiaSachCtDfController@edit');
Route::get('/giasachctdf/updatett','manage\kekhaigia\kkgiasach\KkGiaSachCtDfController@update');
Route::get('/giasachctdf/deletett','manage\kekhaigia\kkgiasach\KkGiaSachCtDfController@delete');
Route::get('/giasachctdf/kkgiahh','manage\kekhaigia\kkgiasach\KkGiaSachCtDfController@kkgia');
Route::get('/giasachctdf/upkkgia','manage\kekhaigia\kkgiasach\KkGiaSachCtDfController@upkkgia');
Route::get('/giasachctdf/kkgiahhlk','manage\kekhaigia\kkgiasach\KkGiaSachCtDfController@kkgialk');
Route::get('/giasachctdf/upkkgialk','manage\kekhaigia\kkgiasach\KkGiaSachCtDfController@upkkgialk');

Route::get('/giasachct/storett','manage\kekhaigia\kkgiasach\KkGiaSachCtController@store');
Route::get('/giasachct/edittt','manage\kekhaigia\kkgiasach\KkGiaSachCtController@edit');
Route::get('/giasachct/updatett','manage\kekhaigia\kkgiasach\KkGiaSachCtController@update');
Route::get('/giasachct/deletett','manage\kekhaigia\kkgiasach\KkGiaSachCtController@delete');
Route::get('/giasachct/kkgiahh','manage\kekhaigia\kkgiasach\KkGiaSachCtController@kkgia');
Route::get('/giasachct/upkkgia','manage\kekhaigia\kkgiasach\KkGiaSachCtController@upkkgia');

Route::get('xetduyetgiasach','manage\kekhaigia\kkgiasach\KkGiaSachXdController@index');
Route::post('xetduyetgiasach/tralai','manage\kekhaigia\kkgiasach\KkGiaSachXdController@tralai');
Route::get('xetduyetgiasach/ttnhanhs','manage\kekhaigia\kkgiasach\KkGiaSachXdController@ttnhanhs');
Route::post('xetduyetgiasach/nhanhs','manage\kekhaigia\kkgiasach\KkGiaSachXdController@nhanhs');
Route::post('xetduyetgiasach/chuyenxd','manage\kekhaigia\kkgiasach\KkGiaSachXdController@chuyenxd');
Route::post('xetduyetgiasach/congbo','manage\kekhaigia\kkgiasach\KkGiaSachXdController@congbo');

Route::get('timkiemgiasach','manage\kekhaigia\kkgiasach\KkGiaSachXdController@search');

Route::get('/ttdnkksach','manage\kekhaigia\kkgiasach\KkGiaSachXdController@ttdnkksach');

Route::get('baocaokkgiasach','manage\kekhaigia\kkgiasach\KkGiaSachBcController@index');
Route::post('baocaokkgiasach/bc1','manage\kekhaigia\kkgiasach\KkGiaSachBcController@bc1');
Route::post('baocaokkgiasach/bc2','manage\kekhaigia\kkgiasach\KkGiaSachBcController@bc2');

Route::get('/giasachct/editpag','manage\kekhaigia\kkgiasach\KkGiaSachCtController@editpag');
Route::post('/giasachct/updatepag','manage\kekhaigia\kkgiasach\KkGiaSachCtController@updatepag');
