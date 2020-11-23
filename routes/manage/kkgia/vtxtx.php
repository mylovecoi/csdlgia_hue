<?php
Route::get('thongtindnvtxtx','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxController@ttdn');
/*Route::resource('kekhaigiavantaixetaxi','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxController');*/
Route::get('kekhaigiavantaixetaxi','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxController@index');
Route::get('kekhaigiavantaixetaxi/create','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxController@create');
Route::post('kekhaigiavantaixetaxi/store','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxController@store');
Route::get('kekhaigiavantaixetaxi/edit','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxController@edit');
Route::get('kekhaigiavantaixetaxi/prints','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxController@show');
Route::get('kekhaigiavantaixetaxi/get_sohs','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxController@showlydo');

Route::post('kekhaigiavantaixetaxi/chuyen','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxController@chuyen');
Route::get('/kkvtxtx/showlydo','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxController@showlydo');
Route::post('kekhaigiavantaixetaxi/delete','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxController@delete');
/*Route::get('kekhaigiavantaixetaxi/prints','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxController@prints');*/

Route::get('/kekhaigiavantaixetaxi/kiemtra','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxController@kiemtra');

Route::get('kekhaigiavantaixetaxi/nhanexcel','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxController@nhanexcel');
Route::post('kekhaigiavantaixetaxi/create_excel','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxController@create_excel');

Route::get('/giavtxtxctdf/storett','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxCtDfController@store');
Route::get('/giavtxtxctdf/edittt','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxCtDfController@edit');
Route::get('/giavtxtxctdf/updatett','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxCtDfController@update');
Route::get('/giavtxtxctdf/deletett','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxCtDfController@delete');
Route::get('/giavtxtxctdf/kkgiahh','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxCtDfController@kkgia');
Route::get('/giavtxtxctdf/upkkgia','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxCtDfController@upkkgia');
Route::get('/giavtxtxctdf/kkgiahhlk','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxCtDfController@kkgialk');
Route::get('/giavtxtxctdf/upkkgialk','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxCtDfController@upkkgialk');
//End Ajax create

//Ajax edit
Route::get('/giavtxtxct/storett','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxCtController@store');
Route::get('/giavtxtxct/edittt','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxCtController@edit');
Route::get('/giavtxtxct/updatett','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxCtController@update');
Route::get('/giavtxtxct/deletett','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxCtController@delete');
Route::get('/giavtxtxct/kkgiahh','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxCtController@kkgia');
Route::get('/giavtxtxct/upkkgia','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxCtController@upkkgia');
//End Ajax edit

//Xét duyệt kk
Route::get('xetduyetkekhaigiavtxtx','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxXdController@index');
Route::post('xetduyetkekhaigiavtxtx/tralai','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxXdController@tralai');
Route::get('xetduyetkekhaigiavtxtx/ttnhanhs','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxXdController@ttnhanhs');
Route::post('xetduyetkekhaigiavtxtx/nhanhs','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxXdController@nhanhs');
Route::post('xetduyetkekhaigiavtxtx/chuyenxd','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxXdController@chuyenxd');
Route::post('xetduyetkekhaigiavtxtx/congbo','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxXdController@congbo');
//End xét duyệt kk

Route::get('timkiemgiavantaixetaxi','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxXdController@search');
Route::get('timkiemgiavantaixetaxi/printf','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxXdController@printf');

//Ajax
Route::get('/ttdnkkvtxtx','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxXdController@ttdnkkvtxtx');

Route::get('baocaogiavantaixetaxi','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxBcController@index');
Route::post('baocaogiavantaixetaxi/bc1','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxBcController@bc1');
Route::post('baocaogiavantaixetaxi/bc2','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxBcController@bc2');

Route::get('/giavtxtxct/editpag','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxCtController@editpag');
Route::post('/giavtxtxct/updatepag','manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxCtController@updatepag');


?>