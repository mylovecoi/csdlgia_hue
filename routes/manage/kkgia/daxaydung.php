<?php
Route::get('kekhaigiadaxaydung','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungController@index');
Route::get('kekhaigiadaxaydung/create','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungController@create');
Route::post('kekhaigiadaxaydung/store','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungController@store');
Route::get('kekhaigiadaxaydung/edit','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungController@edit');
Route::get('kekhaigiadaxaydung/prints','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungController@show');

Route::get('kekhaigiadaxaydung/kiemtra','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungController@kiemtra');
Route::post('kekhaigiadaxaydung/chuyen','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungController@chuyen');
Route::get('kekhaigiadaxaydung/get_sohs','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungController@showlydo');
Route::post('kekhaigiadaxaydung/delete','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungController@delete');

Route::get('/kkdaxaydung/showlydo','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungController@showlydo');

Route::get('/giadaxaydungct/storett','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungCtController@store');
Route::get('/giadaxaydungct/edittt','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungCtController@edit');
Route::get('/giadaxaydungct/updatett','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungCtController@update');
Route::get('/giadaxaydungct/deletett','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungCtController@delete');

Route::get('xetduyetkkgiadaxaydung','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungXdController@index');
Route::post('xetduyetkkgiadaxaydung/tralai','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungXdController@tralai');
Route::get('xetduyetkkgiadaxaydung/ttnhanhs','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungXdController@ttnhanhs');
Route::post('xetduyetkkgiadaxaydung/nhanhs','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungXdController@nhanhs');
Route::post('xetduyetkkgiadaxaydung/chuyenxd','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungXdController@chuyenxd');
Route::post('xetduyetkkgiadaxaydung/congbo','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungXdController@congbo');
//Ajax xd
Route::get('/ttdnkkdaxaydung','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungXdController@ttdnkkdaxaydung');

Route::get('timkiemkkgiadaxaydung','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungXdController@search');
Route::get('timkiemkkgiadaxaydung/printf','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungXdController@printf');

Route::get('baocaokekhaidaxaydung','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungBcController@index');
Route::post('baocaokekhaidaxaydung/bc1','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungBcController@bc1');
Route::post('baocaokekhaidaxaydung/bc2','manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungBcController@bc2');