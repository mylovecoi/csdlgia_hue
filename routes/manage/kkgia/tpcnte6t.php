<?php
Route::get('kekhaigiatpcnte6t','manage\kekhaigia\kkgiatpcnte6t\KkGsController@index');
Route::get('kekhaigiatpcnte6t/create','manage\kekhaigia\kkgiatpcnte6t\KkGsController@create');
Route::post('kekhaigiatpcnte6t/store','manage\kekhaigia\kkgiatpcnte6t\KkGsController@store');
Route::get('kekhaigiatpcnte6t/edit','manage\kekhaigia\kkgiatpcnte6t\KkGsController@edit');
Route::get('kekhaigiatpcnte6t/prints','manage\kekhaigia\kkgiatpcnte6t\KkGsController@show');

Route::get('kekhaigiatpcnte6t/kiemtra','manage\kekhaigia\kkgiatpcnte6t\KkGsController@kiemtra');
Route::post('kekhaigiatpcnte6t/chuyen','manage\kekhaigia\kkgiatpcnte6t\KkGsController@chuyen');
Route::get('kekhaigiatpcnte6t/get_sohs','manage\kekhaigia\kkgiatpcnte6t\KkGsController@showlydo');
Route::post('kekhaigiatpcnte6t/delete','manage\kekhaigia\kkgiatpcnte6t\KkGsController@delete');

Route::get('/kktpcnte6t/showlydo','manage\kekhaigia\kkgiatpcnte6t\KkGsController@showlydo');

Route::get('/giatpcnte6tct/storett','manage\kekhaigia\kkgiatpcnte6t\KkGsCtController@store');
Route::get('/giatpcnte6tct/edittt','manage\kekhaigia\kkgiatpcnte6t\KkGsCtController@edit');
Route::get('/giatpcnte6tct/updatett','manage\kekhaigia\kkgiatpcnte6t\KkGsCtController@update');
Route::get('/giatpcnte6tct/deletett','manage\kekhaigia\kkgiatpcnte6t\KkGsCtController@delete');

Route::get('xetduyetkkgiatpcnte6t','manage\kekhaigia\kkgiatpcnte6t\KkGsXdController@index');
Route::post('xetduyetkkgiatpcnte6t/tralai','manage\kekhaigia\kkgiatpcnte6t\KkGsXdController@tralai');
Route::get('xetduyetkkgiatpcnte6t/ttnhanhs','manage\kekhaigia\kkgiatpcnte6t\KkGsXdController@ttnhanhs');
Route::post('xetduyetkkgiatpcnte6t/nhanhs','manage\kekhaigia\kkgiatpcnte6t\KkGsXdController@nhanhs');
Route::post('xetduyetkkgiatpcnte6t/chuyenxd','manage\kekhaigia\kkgiatpcnte6t\KkGsXdController@chuyenxd');
Route::post('xetduyetkkgiatpcnte6t/congbo','manage\kekhaigia\kkgiatpcnte6t\KkGsXdController@congbo');

Route::get('timkiemkkkgiatpcnte6t','manage\kekhaigia\kkgiatpcnte6t\KkGsXdController@search');
Route::get('timkiemkkkgiatpcnte6t/printf','manage\kekhaigia\kkgiatpcnte6t\KkGsXdController@printf');

Route::get('/ttdnkktpcnte6t','manage\kekhaigia\kkgiatpcnte6t\KkGsXdController@ttdnkktpcnte6t');

Route::get('baocaokkgiatpcnte6t','manage\kekhaigia\kkgiatpcnte6t\KkGsBcController@index');
Route::post('baocaokkgiatpcnte6t/bc1','manage\kekhaigia\kkgiatpcnte6t\KkGsBcController@bc1');
Route::post('baocaokkgiatpcnte6t/bc2','manage\kekhaigia\kkgiatpcnte6t\KkGsBcController@bc2');