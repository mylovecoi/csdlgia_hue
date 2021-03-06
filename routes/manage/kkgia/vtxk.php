<?php
Route::get('thongtindnvtxk','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkController@ttdn');
//Route::resource('kekhaigiavantaixekhach','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkController');
Route::get('kekhaigiavantaixekhach','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkController@index');
Route::get('kekhaigiavantaixekhach/create','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkController@create');
Route::post('kekhaigiavantaixekhach/store','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkController@store');
Route::get('kekhaigiavantaixekhach/edit','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkController@edit');
Route::get('kekhaigiavantaixekhach/prints','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkController@show');
Route::get('kekhaigiavantaixekhach/get_sohs','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkController@showlydo');

Route::post('kekhaigiavantaixekhach/chuyen','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkController@chuyen');
Route::get('/kkvtxk/showlydo','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkController@showlydo');
Route::post('kekhaigiavantaixekhach/delete','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkController@delete');
//Route::get('kekhaigiavantaixekhach/prints','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkController@prints');


//Ajax chuyen
Route::get('/kekhaigiavantaixekhach/kiemtra','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkController@kiemtra');
//End Ajax chuyển

Route::get('kekhaigiavantaixekhach/nhanexcel','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkController@nhanexcel');
Route::post('kekhaigiavantaixekhach/create_excel','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkController@create_excel');

Route::get('/giavtxkctdf/storett','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkCtDfController@store');
Route::get('/giavtxkctdf/edittt','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkCtDfController@edit');
Route::get('/giavtxkctdf/updatett','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkCtDfController@update');
Route::get('/giavtxkctdf/deletett','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkCtDfController@delete');
Route::get('/giavtxkctdf/kkgiahh','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkCtDfController@kkgia');
Route::get('/giavtxkctdf/upkkgia','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkCtDfController@upkkgia');
Route::get('/giavtxkctdf/kkgiahhlk','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkCtDfController@kkgialk');
Route::get('/giavtxkctdf/upkkgialk','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkCtDfController@upkkgialk');
//End Ajax create

//Ajax edit
Route::get('/giavtxkct/storett','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkCtController@store');
Route::get('/giavtxkct/edittt','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkCtController@edit');
Route::get('/giavtxkct/updatett','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkCtController@update');
Route::get('/giavtxkct/deletett','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkCtController@delete');
Route::get('/giavtxkct/kkgiahh','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkCtController@kkgia');
Route::get('/giavtxkct/upkkgia','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkCtController@upkkgia');
//Route::get('/giavtxkct/kkgiahhlk','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkCtController@kkgialk');
//Route::get('/giavtxkct/upkkgialk','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkCtController@upkkgialk');
//End Ajax edit

//Xét duyệt kk
Route::get('xetduyetkekhaigiavtxk','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkXdController@index');
Route::post('xetduyetkekhaigiavtxk/tralai','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkXdController@tralai');
Route::get('xetduyetkekhaigiavtxk/ttnhanhs','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkXdController@ttnhanhs');
Route::post('xetduyetkekhaigiavtxk/nhanhs','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkXdController@nhanhs');
Route::post('xetduyetkekhaigiavtxk/chuyenxd','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkXdController@chuyenxd');
Route::post('xetduyetkekhaigiavtxk/congbo','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkXdController@congbo');
//End xét duyệt kk TACN
Route::get('timkiemgiavantaixekhach','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkXdController@search');
Route::get('timkiemgiavantaixekhach/printf','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkXdController@printf');

//Ajax
Route::get('/ttdnkkvtxk','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkXdController@ttdnkkvtxk');

Route::get('baocaogiavantaixekhach','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkBcController@index');
Route::post('baocaogiavantaixekhach/bc1','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkBcController@bc1');
Route::post('baocaogiavantaixekhach/bc2','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkBcController@bc2');

Route::get('/giavtxkct/editpag','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkCtController@editpag');
Route::post('/giavtxkct/updatepag','manage\kekhaigia\kkdvvt\vtxk\KkGiaVtXkCtController@updatepag');
?>