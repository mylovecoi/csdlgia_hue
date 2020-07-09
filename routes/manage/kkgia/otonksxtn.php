<?php
Route::get('kekhaigiaotonksx','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxController@index');
Route::get('kekhaigiaotonksx/create','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxController@create');
Route::post('kekhaigiaotonksx/store','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxController@store');
Route::get('kekhaigiaotonksx/edit','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxController@edit');
Route::get('kekhaigiaotonksx/prints','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxController@show');

Route::get('kekhaigiaotonksx/kiemtra','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxController@kiemtra');
Route::post('kekhaigiaotonksx/chuyen','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxController@chuyen');
Route::get('kekhaigiaotonksx/get_sohs','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxController@showlydo');
Route::post('kekhaigiaotonksx/delete','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxController@delete');

Route::get('/kkotonksx/showlydo','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxController@showlydo');

Route::get('/giaotonksxct/storett','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxCtController@store');
Route::get('/giaotonksxct/edittt','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxCtController@edit');
Route::get('/giaotonksxct/updatett','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxCtController@update');
Route::get('/giaotonksxct/deletett','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxCtController@delete');

Route::get('xetduyetgiaotonksx','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxXdController@index');
Route::post('xetduyetgiaotonksx/tralai','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxXdController@tralai');
Route::get('xetduyetgiaotonksx/ttnhanhs','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxXdController@ttnhanhs');
Route::post('xetduyetgiaotonksx/nhanhs','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxXdController@nhanhs');
Route::post('xetduyetgiaotonksx/chuyenxd','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxXdController@chuyenxd');
Route::post('xetduyetgiaotonksx/congbo','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxXdController@congbo');

Route::get('timkiemgiaotonksx','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxXdController@search');
Route::get('timkiemgiaotonksx/printf','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxXdController@printf');

Route::get('/ttdnkkgiaotonksx','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxXdController@ttdnkkgiaotonksx');

Route::get('baocaokkgiaotonksx','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxBcController@index');
Route::post('baocaokkgiaotonksx/bc1','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxBcController@bc1');
Route::post('baocaokkgiaotonksx/bc2','manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxBcController@bc2');
