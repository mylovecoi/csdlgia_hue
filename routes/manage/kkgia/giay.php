<?php
Route::get('thongtindngiay','manage\kekhaigia\kkgiay\KkGiaGiayController@ttdn');

Route::get('kekhaigiagiay','manage\kekhaigia\kkgiay\KkGiaGiayController@index');
Route::get('kekhaigiagiay/create','manage\kekhaigia\kkgiay\KkGiaGiayController@create');
Route::post('kekhaigiagiay/store','manage\kekhaigia\kkgiay\KkGiaGiayController@store');
Route::get('kekhaigiagiay/edit','manage\kekhaigia\kkgiay\KkGiaGiayController@edit');
Route::get('kekhaigiagiay/prints','manage\kekhaigia\kkgiay\KkGiaGiayController@show');
Route::get('kekhaigiagiay/get_sohs','manage\kekhaigia\kkgiay\KkGiaGiayController@showlydo');

Route::post('kekhaigiagiay/chuyen','manage\kekhaigia\kkgiay\KkGiaGiayController@chuyen');
Route::get('/giagiay/showlydo','manage\kekhaigia\kkgiay\KkGiaGiayController@showlydo');
Route::post('kekhaigiagiay/delete','manage\kekhaigia\kkgiay\KkGiaGiayController@delete');

Route::get('kekhaigiagiay/kiemtra','manage\kekhaigia\kkgiay\KkGiaGiayController@kiemtra');

Route::get('/giagiayctdf/storett','manage\kekhaigia\kkgiay\KkGiaGiayCtDfController@store');
Route::get('/giagiayctdf/edittt','manage\kekhaigia\kkgiay\KkGiaGiayCtDfController@edit');
Route::get('/giagiayctdf/updatett','manage\kekhaigia\kkgiay\KkGiaGiayCtDfController@update');
Route::get('/giagiayctdf/deletett','manage\kekhaigia\kkgiay\KkGiaGiayCtDfController@delete');
Route::get('/giagiayctdf/kkgiahh','manage\kekhaigia\kkgiay\KkGiaGiayCtDfController@kkgia');
Route::get('/giagiayctdf/upkkgia','manage\kekhaigia\kkgiay\KkGiaGiayCtDfController@upkkgia');
Route::get('/giagiayctdf/kkgiahhlk','manage\kekhaigia\kkgiay\KkGiaGiayCtDfController@kkgialk');
Route::get('/giagiayctdf/upkkgialk','manage\kekhaigia\kkgiay\KkGiaGiayCtDfController@upkkgialk');

Route::get('/giagiayct/storett','manage\kekhaigia\kkgiay\KkGiaGiayCtController@store');
Route::get('/giagiayct/edittt','manage\kekhaigia\kkgiay\KkGiaGiayCtController@edit');
Route::get('/giagiayct/updatett','manage\kekhaigia\kkgiay\KkGiaGiayCtController@update');
Route::get('/giagiayct/deletett','manage\kekhaigia\kkgiay\KkGiaGiayCtController@delete');
Route::get('/giagiayct/kkgiahh','manage\kekhaigia\kkgiay\KkGiaGiayCtController@kkgia');
Route::get('/giagiayct/upkkgia','manage\kekhaigia\kkgiay\KkGiaGiayCtController@upkkgia');

Route::get('xetduyetgiagiay','manage\kekhaigia\kkgiay\KkGiaGiayXdController@index');
Route::post('xetduyetgiagiay/tralai','manage\kekhaigia\kkgiay\KkGiaGiayXdController@tralai');
Route::get('xetduyetgiagiay/ttnhanhs','manage\kekhaigia\kkgiay\KkGiaGiayXdController@ttnhanhs');
Route::post('xetduyetgiagiay/nhanhs','manage\kekhaigia\kkgiay\KkGiaGiayXdController@nhanhs');
Route::post('xetduyetgiagiay/chuyenxd','manage\kekhaigia\kkgiay\KkGiaGiayXdController@chuyenxd');
Route::post('xetduyetgiagiay/congbo','manage\kekhaigia\kkgiay\KkGiaGiayXdController@congbo');

Route::get('timkiemgiagiay','manage\kekhaigia\kkgiay\KkGiaGiayXdController@search');
Route::get('timkiemgiagiay/printf','manage\kekhaigia\kkgiay\KkGiaGiayXdController@printf');

Route::get('/ttdnkkgiay','manage\kekhaigia\kkgiay\KkGiaGiayXdController@ttdnkkgiay');

Route::get('baocaokkgiagiay','manage\kekhaigia\kkgiay\KkGiaGiayBcController@index');
Route::post('baocaokkgiagiay/bc1','manage\kekhaigia\kkgiay\KkGiaGiayBcController@bc1');
Route::post('baocaokkgiagiay/bc2','manage\kekhaigia\kkgiay\KkGiaGiayBcController@bc2');

Route::get('/giagiayct/editpag','manage\kekhaigia\kkgiay\KkGiaGiayCtController@editpag');
Route::post('/giagiayct/updatepag','manage\kekhaigia\kkgiay\KkGiaGiayCtController@updatepag');