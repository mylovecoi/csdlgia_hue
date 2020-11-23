<?php
Route::get('thongtindnetanol','manage\kekhaigia\kkgiaetanol\KkGiaEtanolController@ttdn');

Route::get('kekhaigiaetanol','manage\kekhaigia\kkgiaetanol\KkGiaEtanolController@index');
Route::get('kekhaigiaetanol/create','manage\kekhaigia\kkgiaetanol\KkGiaEtanolController@create');
Route::post('kekhaigiaetanol/store','manage\kekhaigia\kkgiaetanol\KkGiaEtanolController@store');
Route::get('kekhaigiaetanol/edit','manage\kekhaigia\kkgiaetanol\KkGiaEtanolController@edit');
Route::get('kekhaigiaetanol/prints','manage\kekhaigia\kkgiaetanol\KkGiaEtanolController@show');
Route::get('kekhaigiaetanol/get_sohs','manage\kekhaigia\kkgiaetanol\KkGiaEtanolController@showlydo');

Route::post('kekhaigiaetanol/chuyen','manage\kekhaigia\kkgiaetanol\KkGiaEtanolController@chuyen');
Route::get('/giaetanol/showlydo','manage\kekhaigia\kkgiaetanol\KkGiaEtanolController@showlydo');
Route::post('kekhaigiaetanol/delete','manage\kekhaigia\kkgiaetanol\KkGiaEtanolController@delete');

Route::get('kekhaigiaetanol/kiemtra','manage\kekhaigia\kkgiaetanol\KkGiaEtanolController@kiemtra');

Route::get('kekhaigiaetanol/nhanexcel','manage\kekhaigia\kkgiaetanol\KkGiaEtanolController@nhanexcel');
Route::post('kekhaigiaetanol/create_excel','manage\kekhaigia\kkgiaetanol\KkGiaEtanolController@create_excel');

Route::get('/giaetanolctdf/storett','manage\kekhaigia\kkgiaetanol\KkGiaEtanolCtDfController@store');
Route::get('/giaetanolctdf/edittt','manage\kekhaigia\kkgiaetanol\KkGiaEtanolCtDfController@edit');
Route::get('/giaetanolctdf/updatett','manage\kekhaigia\kkgiaetanol\KkGiaEtanolCtDfController@update');
Route::get('/giaetanolctdf/deletett','manage\kekhaigia\kkgiaetanol\KkGiaEtanolCtDfController@delete');
Route::get('/giaetanolctdf/kkgiahh','manage\kekhaigia\kkgiaetanol\KkGiaEtanolCtDfController@kkgia');
Route::get('/giaetanolctdf/upkkgia','manage\kekhaigia\kkgiaetanol\KkGiaEtanolCtDfController@upkkgia');
Route::get('/giaetanolctdf/kkgiahhlk','manage\kekhaigia\kkgiaetanol\KkGiaEtanolCtDfController@kkgialk');
Route::get('/giaetanolctdf/upkkgialk','manage\kekhaigia\kkgiaetanol\KkGiaEtanolCtDfController@upkkgialk');

Route::get('/giaetanolct/storett','manage\kekhaigia\kkgiaetanol\KkGiaEtanolCtController@store');
Route::get('/giaetanolct/edittt','manage\kekhaigia\kkgiaetanol\KkGiaEtanolCtController@edit');
Route::get('/giaetanolct/updatett','manage\kekhaigia\kkgiaetanol\KkGiaEtanolCtController@update');
Route::get('/giaetanolct/deletett','manage\kekhaigia\kkgiaetanol\KkGiaEtanolCtController@delete');
Route::get('/giaetanolct/kkgiahh','manage\kekhaigia\kkgiaetanol\KkGiaEtanolCtController@kkgia');
Route::get('/giaetanolct/upkkgia','manage\kekhaigia\kkgiaetanol\KkGiaEtanolCtController@upkkgia');

Route::get('xetduyetgiaetanol','manage\kekhaigia\kkgiaetanol\KkGiaEtanolXdController@index');
Route::post('xetduyetgiaetanol/tralai','manage\kekhaigia\kkgiaetanol\KkGiaEtanolXdController@tralai');
Route::get('xetduyetgiaetanol/ttnhanhs','manage\kekhaigia\kkgiaetanol\KkGiaEtanolXdController@ttnhanhs');
Route::post('xetduyetgiaetanol/nhanhs','manage\kekhaigia\kkgiaetanol\KkGiaEtanolXdController@nhanhs');
Route::post('xetduyetgiaetanol/chuyenxd','manage\kekhaigia\kkgiaetanol\KkGiaEtanolXdController@chuyenxd');
Route::post('xetduyetgiaetanol/congbo','manage\kekhaigia\kkgiaetanol\KkGiaEtanolXdController@congbo');

Route::get('timkiemgiaetanol','manage\kekhaigia\kkgiaetanol\KkGiaEtanolXdController@search');
Route::get('timkiemgiaetanol/printf','manage\kekhaigia\kkgiaetanol\KkGiaEtanolXdController@printf');

Route::get('/ttdnkketanol','manage\kekhaigia\kkgiaetanol\KkGiaEtanolXdController@ttdnkketanol');

Route::get('baocaokkgiaetanol','manage\kekhaigia\kkgiaetanol\KkGiaEtanolBcController@index');
Route::post('baocaokkgiaetanol/bc1','manage\kekhaigia\kkgiaetanol\KkGiaEtanolBcController@bc1');
Route::post('baocaokkgiaetanol/bc2','manage\kekhaigia\kkgiaetanol\KkGiaEtanolBcController@bc2');

Route::get('/giaetanolct/editpag','manage\kekhaigia\kkgiaetanol\KkGiaEtanolCtController@editpag');
Route::post('/giaetanolct/updatepag','manage\kekhaigia\kkgiaetanol\KkGiaEtanolCtController@updatepag');