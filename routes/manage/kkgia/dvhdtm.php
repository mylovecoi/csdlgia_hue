<?php
Route::get('thongtindnkkgiadvhdtm','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmController@ttdn');
Route::resource('thongtinkkdvhoatdongthuongmai','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmController');
Route::post('thongtinkkdvhoatdongthuongmai/delete','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmController@delete');
Route::post('thongtinkkdvhoatdongthuongmai/chuyen','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmController@chuyen');

Route::get('kkdvhdtm/kiemtra','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmController@kiemtra');
Route::get('kkdvhdtm/showlydo','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmController@showlydo');

Route::get('/kkgiadvhdtmctdf/storett','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmCtDfController@store');
Route::get('/kkgiadvhdtmctdf/edittt','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmCtDfController@edit');
Route::get('/kkgiadvhdtmctdf/updatett','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmCtDfController@update');
Route::get('/kkgiadvhdtmctdf/deletett','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmCtDfController@delete');

Route::get('/kkgiadvhdtmct/storett','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmCtController@store');
Route::get('/kkgiadvhdtmct/edittt','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmCtController@edit');
Route::get('/kkgiadvhdtmct/updatett','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmCtController@update');
Route::get('/kkgiadvhdtmct/deletett','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmCtController@delete');

Route::get('xetduyetkkgiadvhdtm','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmXdController@index');
Route::post('xetduyetkkgiadvhdtm/tralai','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmXdController@tralai');
Route::get('ttdndvhdtm','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmXdController@ttdn');
Route::get('/xetduyetkkgiadvhdtm/ttnhanhs','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmXdController@ttnhanhs');
Route::post('/xetduyetkkgiadvhdtm/nhanhs','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmXdController@nhanhs');

Route::get('timkiemgiadvhdtm','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmXdController@search');


Route::get('baocaokkgiadvhdtm','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmBcController@index');
Route::post('baocaokkgiadvhdtm/bc1','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmBcController@bc1');
Route::post('baocaokkgiadvhdtm/bc2','manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmBcController@bc2');





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

Route::get('/giadvhdtmct/storett','manage\kekhaigia\kkdvhdtmck\KkGiaKcbTnCtDfController@store');
Route::get('/giadvhdtmct/edittt','manage\kekhaigia\kkdvhdtmck\KkGiaKcbTnCtDfController@edit');
Route::get('/giadvhdtmct/updatett','manage\kekhaigia\kkdvhdtmck\KkGiaKcbTnCtDfController@update');
Route::get('/giadvhdtmct/deletett','manage\kekhaigia\kkdvhdtmck\KkGiaKcbTnCtDfController@delete');

Route::get('xetduyetkkgiadvhdtm','manage\kekhaigia\kkdvhdtmck\KkGiaKcbTnXdController@index');
Route::post('xetduyetkkgiadvhdtm/tralai','manage\kekhaigia\kkdvhdtmck\KkGiaKcbTnXdController@tralai');
Route::get('xetduyetkkgiadvhdtm/ttnhanhs','manage\kekhaigia\kkdvhdtmck\KkGiaKcbTnXdController@ttnhanhs');
Route::post('xetduyetkkgiadvhdtm/nhanhs','manage\kekhaigia\kkdvhdtmck\KkGiaKcbTnXdController@nhanhs');
Route::post('xetduyetkkgiadvhdtm/chuyenxd','manage\kekhaigia\kkdvhdtmck\KkGiaKcbTnXdController@chuyenxd');
Route::post('xetduyetkkgiadvhdtm/congbo','manage\kekhaigia\kkdvhdtmck\KkGiaKcbTnXdController@congbo');
//Ajax xd
Route::get('/ttdndvhdtm','manage\kekhaigia\kkdvhdtmck\KkGiaKcbTnXdController@ttdndvhdtm');

Route::get('timkiemgiadvhdtm','manage\kekhaigia\kkdvhdtmck\KkGiaKcbTnXdController@search');
Route::get('timkiemgiadvhdtm/printf','manage\kekhaigia\kkdvhdtmck\KkGiaKcbTnXdController@printf');

Route::get('baocaokkgiadvhdtm','manage\kekhaigia\kkdvhdtmck\KkGiaKcbTnBcController@index');
Route::post('baocaokkgiadvhdtm/bc1','manage\kekhaigia\kkdvhdtmck\KkGiaKcbTnBcController@bc1');
Route::post('baocaokkgiadvhdtm/bc2','manage\kekhaigia\kkdvhdtmck\KkGiaKcbTnBcController@bc2');
?>