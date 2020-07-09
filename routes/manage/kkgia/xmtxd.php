<?php
Route::get('thongtindnxmtxd','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdController@ttdn');

Route::get('kekhaigiaxmtxd','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdController@index');
Route::get('kekhaigiaxmtxd/create','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdController@create');
Route::post('kekhaigiaxmtxd/store','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdController@store');
Route::get('kekhaigiaxmtxd/edit','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdController@edit');
Route::get('kekhaigiaxmtxd/prints','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdController@show');
Route::get('kekhaigiaxmtxd/get_sohs','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdController@showlydo');

Route::post('kekhaigiaxmtxd/chuyen','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdController@chuyen');
Route::get('/giaxmtxd/showlydo','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdController@showlydo');
Route::post('kekhaigiaxmtxd/delete','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdController@delete');

Route::get('kekhaigiaxmtxd/kiemtra','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdController@kiemtra');

Route::get('/giaxmtxdctdf/storett','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdCtDfController@store');
Route::get('/giaxmtxdctdf/edittt','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdCtDfController@edit');
Route::get('/giaxmtxdctdf/updatett','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdCtDfController@update');
Route::get('/giaxmtxdctdf/deletett','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdCtDfController@delete');
Route::get('/giaxmtxdctdf/kkgiahh','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdCtDfController@kkgia');
Route::get('/giaxmtxdctdf/upkkgia','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdCtDfController@upkkgia');
Route::get('/giaxmtxdctdf/kkgiahhlk','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdCtDfController@kkgialk');
Route::get('/giaxmtxdctdf/upkkgialk','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdCtDfController@upkkgialk');

Route::get('/giaxmtxdct/storett','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdCtController@store');
Route::get('/giaxmtxdct/edittt','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdCtController@edit');
Route::get('/giaxmtxdct/updatett','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdCtController@update');
Route::get('/giaxmtxdct/deletett','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdCtController@delete');
Route::get('/giaxmtxdct/kkgiahh','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdCtController@kkgia');
Route::get('/giaxmtxdct/upkkgia','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdCtController@upkkgia');

Route::get('xetduyetgiaxmtxd','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdXdController@index');
Route::post('xetduyetgiaxmtxd/tralai','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdXdController@tralai');
Route::get('xetduyetgiaxmtxd/ttnhanhs','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdXdController@ttnhanhs');
Route::post('xetduyetgiaxmtxd/nhanhs','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdXdController@nhanhs');
Route::post('xetduyetgiaxmtxd/chuyenxd','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdXdController@chuyenxd');
Route::post('xetduyetgiaxmtxd/congbo','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdXdController@congbo');

Route::get('timkiemgiaxmtxd','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdXdController@search');
Route::get('timkiemgiaxmtxd/printf','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdXdController@printf');

Route::get('/ttdnkkxmtxd','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdXdController@ttdnkkxmtxd');

Route::get('baocaokkgiaxmtxd','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdBcController@index');
Route::post('baocaokkgiaxmtxd/bc1','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdBcController@bc1');
Route::post('baocaokkgiaxmtxd/bc2','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdBcController@bc2');

Route::get('/giaxmtxdct/editpag','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdCtController@editpag');
Route::post('/giaxmtxdct/updatepag','manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdCtController@updatepag');


?>