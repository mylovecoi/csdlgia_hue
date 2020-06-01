<?php
Route::get('thongtindntacn','manage\kekhaigia\kkgiatacn\KkGiaTaCnController@ttdn');

Route::get('kekhaigiatacn','manage\kekhaigia\kkgiatacn\KkGiaTaCnController@index');
Route::get('kekhaigiatacn/create','manage\kekhaigia\kkgiatacn\KkGiaTaCnController@create');
Route::post('kekhaigiatacn/store','manage\kekhaigia\kkgiatacn\KkGiaTaCnController@store');
Route::get('kekhaigiatacn/edit','manage\kekhaigia\kkgiatacn\KkGiaTaCnController@edit');
Route::get('kekhaigiatacn/prints','manage\kekhaigia\kkgiatacn\KkGiaTaCnController@show');
Route::get('kekhaigiatacn/get_sohs','manage\kekhaigia\kkgiatacn\KkGiaTaCnController@showlydo');

Route::post('kekhaigiatacn/chuyen','manage\kekhaigia\kkgiatacn\KkGiaTaCnController@chuyen');
Route::get('/giatacn/showlydo','manage\kekhaigia\kkgiatacn\KkGiaTaCnController@showlydo');
Route::post('kekhaigiatacn/delete','manage\kekhaigia\kkgiatacn\KkGiaTaCnController@delete');

Route::get('kekhaigiatacn/kiemtra','manage\kekhaigia\kkgiatacn\KkGiaTaCnController@kiemtra');

Route::get('/giatacnctdf/storett','manage\kekhaigia\kkgiatacn\KkGiaTaCnCtDfController@store');
Route::get('/giatacnctdf/edittt','manage\kekhaigia\kkgiatacn\KkGiaTaCnCtDfController@edit');
Route::get('/giatacnctdf/updatett','manage\kekhaigia\kkgiatacn\KkGiaTaCnCtDfController@update');
Route::get('/giatacnctdf/deletett','manage\kekhaigia\kkgiatacn\KkGiaTaCnCtDfController@delete');
Route::get('/giatacnctdf/kkgiahh','manage\kekhaigia\kkgiatacn\KkGiaTaCnCtDfController@kkgia');
Route::get('/giatacnctdf/upkkgia','manage\kekhaigia\kkgiatacn\KkGiaTaCnCtDfController@upkkgia');
Route::get('/giatacnctdf/kkgiahhlk','manage\kekhaigia\kkgiatacn\KkGiaTaCnCtDfController@kkgialk');
Route::get('/giatacnctdf/upkkgialk','manage\kekhaigia\kkgiatacn\KkGiaTaCnCtDfController@upkkgialk');

Route::get('/giatacnct/storett','manage\kekhaigia\kkgiatacn\KkGiaTaCnCtController@store');
Route::get('/giatacnct/edittt','manage\kekhaigia\kkgiatacn\KkGiaTaCnCtController@edit');
Route::get('/giatacnct/updatett','manage\kekhaigia\kkgiatacn\KkGiaTaCnCtController@update');
Route::get('/giatacnct/deletett','manage\kekhaigia\kkgiatacn\KkGiaTaCnCtController@delete');
Route::get('/giatacnct/kkgiahh','manage\kekhaigia\kkgiatacn\KkGiaTaCnCtController@kkgia');
Route::get('/giatacnct/upkkgia','manage\kekhaigia\kkgiatacn\KkGiaTaCnCtController@upkkgia');

Route::get('xetduyetgiatacn','manage\kekhaigia\kkgiatacn\KkGiaTaCnXdController@index');
Route::post('xetduyetgiatacn/tralai','manage\kekhaigia\kkgiatacn\KkGiaTaCnXdController@tralai');
Route::get('xetduyetgiatacn/ttnhanhs','manage\kekhaigia\kkgiatacn\KkGiaTaCnXdController@ttnhanhs');
Route::post('xetduyetgiatacn/nhanhs','manage\kekhaigia\kkgiatacn\KkGiaTaCnXdController@nhanhs');
Route::post('xetduyetgiatacn/chuyenxd','manage\kekhaigia\kkgiatacn\KkGiaTaCnXdController@chuyenxd');
Route::post('xetduyetgiatacn/congbo','manage\kekhaigia\kkgiatacn\KkGiaTaCnXdController@congbo');

Route::get('timkiemgiatacn','manage\kekhaigia\kkgiatacn\KkGiaTaCnXdController@search');

Route::get('/ttdnkktacn','manage\kekhaigia\kkgiatacn\KkGiaTaCnXdController@ttdnkktacn');

Route::get('baocaokkgiatacn','manage\kekhaigia\kkgiatacn\KkGiaTaCnBcController@index');
Route::post('baocaokkgiatacn/bc1','manage\kekhaigia\kkgiatacn\KkGiaTaCnBcController@bc1');
Route::post('baocaokkgiatacn/bc2','manage\kekhaigia\kkgiatacn\KkGiaTaCnBcController@bc2');

Route::get('/giatacnct/editpag','manage\kekhaigia\kkgiatacn\KkGiaTaCnCtController@editpag');
Route::post('/giatacnct/updatepag','manage\kekhaigia\kkgiatacn\KkGiaTaCnCtController@updatepag');


?>