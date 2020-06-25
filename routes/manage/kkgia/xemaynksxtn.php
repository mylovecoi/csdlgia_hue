<?php
Route::get('kekhaigiaxemaynksx','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxController@index');
Route::get('kekhaigiaxemaynksx/create','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxController@create');
Route::post('kekhaigiaxemaynksx/store','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxController@store');
Route::get('kekhaigiaxemaynksx/edit','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxController@edit');
Route::get('kekhaigiaxemaynksx/prints','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxController@show');

Route::get('kekhaigiaxemaynksx/kiemtra','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxController@kiemtra');
Route::post('kekhaigiaxemaynksx/chuyen','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxController@chuyen');
Route::get('kekhaigiaxemaynksx/get_sohs','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxController@showlydo');
Route::post('kekhaigiaxemaynksx/delete','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxController@delete');

Route::get('/kkxmnksx/showlydo','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxController@showlydo');

Route::get('/giaxemaynksxct/storett','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxCtController@store');
Route::get('/giaxemaynksxct/edittt','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxCtController@edit');
Route::get('/giaxemaynksxct/updatett','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxCtController@update');
Route::get('/giaxemaynksxct/deletett','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxCtController@delete');

Route::get('xetduyetgiaxemaynksx','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxXdController@index');
Route::post('xetduyetgiaxemaynksx/tralai','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxXdController@tralai');
Route::get('xetduyetgiaxemaynksx/ttnhanhs','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxXdController@ttnhanhs');
Route::post('xetduyetgiaxemaynksx/nhanhs','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxXdController@nhanhs');
Route::post('xetduyetgiaxemaynksx/chuyenxd','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxXdController@chuyenxd');
Route::post('xetduyetgiaxemaynksx/congbo','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxXdController@congbo');

Route::get('timkiemgiaxemaynksx','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxXdController@search');
Route::get('timkiemgiaxemaynksx/printf','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxXdController@printf');

Route::get('/ttdnkkgiaxemaynksx','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxXdController@ttdnkkgiaxemaynksx');

Route::get('baocaokkgiaxemaynksx','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxBcController@index');
Route::post('baocaokkgiaxemaynksx/bc1','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxBcController@bc1');
Route::post('baocaokkgiaxemaynksx/bc2','manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxBcController@bc2');
