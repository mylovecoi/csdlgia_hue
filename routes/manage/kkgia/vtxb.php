<?php
Route::get('thongtindnvtxb','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbController@ttdn');
/*Route::resource('kekhaivantaixebuyt','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbController');*/
Route::get('kekhaivantaixebuyt','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbController@index');
Route::get('kekhaivantaixebuyt/create','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbController@create');
Route::post('kekhaivantaixebuyt/store','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbController@store');
Route::get('kekhaivantaixebuyt/edit','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbController@edit');
Route::get('kekhaivantaixebuyt/prints','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbController@show');
Route::get('kekhaivantaixebuyt/get_sohs','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbController@showlydo');

Route::post('kekhaivantaixebuyt/chuyen','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbController@chuyen');
Route::get('/kkvtxb/showlydo','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbController@showlydo');
Route::post('kekhaivantaixebuyt/delete','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbController@delete');
/*Route::get('kekhaivantaixebuyt/prints','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbController@prints');*/

Route::get('kekhaivantaixebuyt/kiemtra','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbController@kiemtra');

Route::get('kekhaivantaixebuyt/nhanexcel','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbController@nhanexcel');
Route::post('kekhaivantaixebuyt/create_excel','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbController@create_excel');


Route::get('/giavtxbctdf/storett','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbCtDfController@store');
Route::get('/giavtxbctdf/edittt','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbCtDfController@edit');
Route::get('/giavtxbctdf/updatett','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbCtDfController@update');
Route::get('/giavtxbctdf/deletett','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbCtDfController@destroy');
Route::get('/giavtxbctdf/kkgiahh','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbCtDfController@kkgia');
Route::get('/giavtxbctdf/upkkgia','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbCtDfController@upkkgia');
Route::get('/giavtxbctdf/kkgiahhlk','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbCtDfController@kkgialk');
Route::get('/giavtxbctdf/upkkgialk','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbCtDfController@upkkgialk');


Route::get('/giavtxbct/storett','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbCtController@store');
Route::get('/giavtxbct/edittt','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbCtController@edit');
Route::get('/giavtxbct/updatett','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbCtController@update');
Route::get('/giavtxbct/deletett','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbCtController@delete');
Route::get('/giavtxbct/kkgiahh','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbCtController@kkgia');
Route::get('/giavtxbct/upkkgia','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbCtController@upkkgia');

Route::get('xetduyetkekhaigiavtxb','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbXdController@index');
Route::post('xetduyetkekhaigiavtxb/tralai','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbXdController@tralai');
Route::get('xetduyetkekhaigiavtxb/ttnhanhs','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbXdController@ttnhanhs');
Route::post('xetduyetkekhaigiavtxb/nhanhs','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbXdController@nhanhs');
Route::post('xetduyetkekhaigiavtxb/chuyenxd','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbXdController@chuyenxd');
Route::post('xetduyetkekhaigiavtxb/congbo','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbXdController@congbo');

Route::get('timkiemgiavantaixebuyt','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbXdController@search');
Route::get('timkiemgiavantaixebuyt/printf','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbXdController@printf');

Route::get('/ttdnkkvtxb','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbXdController@ttdnkkvtxb');

Route::get('baocaogiavantaixebuyt','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbBcController@index');
Route::post('baocaogiavantaixebuyt/bc1','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbBcController@bc1');
Route::post('baocaogiavantaixebuyt/bc2','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbBcController@bc2');

Route::get('/giavtxbct/editpag','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbCtController@editpag');
Route::post('/giavtxbct/updatepag','manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbCtController@updatepag');