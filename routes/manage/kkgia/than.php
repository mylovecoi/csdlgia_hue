<?php
Route::get('thongtindnthan','manage\kekhaigia\kkgiathan\KkGiaThanController@ttdn');

Route::get('kekhaigiathan','manage\kekhaigia\kkgiathan\KkGiaThanController@index');
Route::get('kekhaigiathan/create','manage\kekhaigia\kkgiathan\KkGiaThanController@create');
Route::post('kekhaigiathan/store','manage\kekhaigia\kkgiathan\KkGiaThanController@store');
Route::get('kekhaigiathan/edit','manage\kekhaigia\kkgiathan\KkGiaThanController@edit');
Route::get('kekhaigiathan/prints','manage\kekhaigia\kkgiathan\KkGiaThanController@show');
Route::get('kekhaigiathan/get_sohs','manage\kekhaigia\kkgiathan\KkGiaThanController@showlydo');

Route::post('kekhaigiathan/chuyen','manage\kekhaigia\kkgiathan\KkGiaThanController@chuyen');
Route::get('/giathan/showlydo','manage\kekhaigia\kkgiathan\KkGiaThanController@showlydo');
Route::post('kekhaigiathan/delete','manage\kekhaigia\kkgiathan\KkGiaThanController@delete');

Route::get('kekhaigiathan/kiemtra','manage\kekhaigia\kkgiathan\KkGiaThanController@kiemtra');

Route::get('kekhaigiathan/nhanexcel','manage\kekhaigia\kkgiathan\KkGiaThanController@nhanexcel');
Route::post('kekhaigiathan/create_excel','manage\kekhaigia\kkgiathan\KkGiaThanController@create_excel');

Route::get('/giathanctdf/storett','manage\kekhaigia\kkgiathan\KkGiaThanCtDfController@store');
Route::get('/giathanctdf/edittt','manage\kekhaigia\kkgiathan\KkGiaThanCtDfController@edit');
Route::get('/giathanctdf/updatett','manage\kekhaigia\kkgiathan\KkGiaThanCtDfController@update');
Route::get('/giathanctdf/deletett','manage\kekhaigia\kkgiathan\KkGiaThanCtDfController@delete');
Route::get('/giathanctdf/kkgiahh','manage\kekhaigia\kkgiathan\KkGiaThanCtDfController@kkgia');
Route::get('/giathanctdf/upkkgia','manage\kekhaigia\kkgiathan\KkGiaThanCtDfController@upkkgia');
Route::get('/giathanctdf/kkgiahhlk','manage\kekhaigia\kkgiathan\KkGiaThanCtDfController@kkgialk');
Route::get('/giathanctdf/upkkgialk','manage\kekhaigia\kkgiathan\KkGiaThanCtDfController@upkkgialk');

Route::get('/giathanct/storett','manage\kekhaigia\kkgiathan\KkGiaThanCtController@store');
Route::get('/giathanct/edittt','manage\kekhaigia\kkgiathan\KkGiaThanCtController@edit');
Route::get('/giathanct/updatett','manage\kekhaigia\kkgiathan\KkGiaThanCtController@update');
Route::get('/giathanct/deletett','manage\kekhaigia\kkgiathan\KkGiaThanCtController@delete');
Route::get('/giathanct/kkgiahh','manage\kekhaigia\kkgiathan\KkGiaThanCtController@kkgia');
Route::get('/giathanct/upkkgia','manage\kekhaigia\kkgiathan\KkGiaThanCtController@upkkgia');

Route::get('xetduyetgiathan','manage\kekhaigia\kkgiathan\KkGiaThanXdController@index');
Route::post('xetduyetgiathan/tralai','manage\kekhaigia\kkgiathan\KkGiaThanXdController@tralai');
Route::get('xetduyetgiathan/ttnhanhs','manage\kekhaigia\kkgiathan\KkGiaThanXdController@ttnhanhs');
Route::post('xetduyetgiathan/nhanhs','manage\kekhaigia\kkgiathan\KkGiaThanXdController@nhanhs');
Route::post('xetduyetgiathan/chuyenxd','manage\kekhaigia\kkgiathan\KkGiaThanXdController@chuyenxd');
Route::post('xetduyetgiathan/congbo','manage\kekhaigia\kkgiathan\KkGiaThanXdController@congbo');

Route::get('timkiemgiathan','manage\kekhaigia\kkgiathan\KkGiaThanXdController@search');
Route::get('timkiemgiathan/printf','manage\kekhaigia\kkgiathan\KkGiaThanXdController@printf');

Route::get('/ttdnkkthan','manage\kekhaigia\kkgiathan\KkGiaThanXdController@ttdnkkthan');

Route::get('baocaokkgiathan','manage\kekhaigia\kkgiathan\KkGiaThanBcController@index');
Route::post('baocaokkgiathan/bc1','manage\kekhaigia\kkgiathan\KkGiaThanBcController@bc1');
Route::post('baocaokkgiathan/bc2','manage\kekhaigia\kkgiathan\KkGiaThanBcController@bc2');

Route::get('/giathanct/editpag','manage\kekhaigia\kkgiathan\KkGiaThanCtController@editpag');
Route::post('/giathanct/updatepag','manage\kekhaigia\kkgiathan\KkGiaThanCtController@updatepag');